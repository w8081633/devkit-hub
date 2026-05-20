<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cron\CronExpression;
use Carbon\Carbon;
use App\Models\ShortUrl;
use Illuminate\Support\Str;
use Exception;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ToolController extends Controller
{
    /**
     * 1. Cron 表达式解析
     */
    public function parseCron(Request $request)
    {
        $expression = $request->input('cron', '* * * * *');

        try {
            $cron = new CronExpression($expression);

            $nextRuns = [];
            $currentDate = Carbon::now();
            for ($i = 0; $i < 5; $i++) {
                $currentDate = Carbon::instance($cron->getNextRunDate($currentDate, $i === 0 ? 0 : 1));
                $nextRuns[] = $currentDate->isoFormat('YYYY-MM-DD HH:mm:ss (dddd)');
            }

            $description = $this->translateCronToChinese($expression);

            return response()->json([
                'success' => true,
                'description' => $description,
                'next_runs' => $nextRuns
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '格式有误，请检查 Cron 表达式是否标准'
            ], 422);
        }
    }

    /**
     * 2. 极简短链接生成 (就是这个方法！)
     */
    public function generateShortUrl(Request $request)
    {
        // 验证前端传过来的 URL 格式
        $request->validate([
            'url' => 'required|url'
        ]);

        $originalUrl = $request->input('url');

        // 检查这个长链接是不是已经生成过了，避免重复生成浪费数据库空间
        $existing = ShortUrl::where('original_url', $originalUrl)->first();
        if ($existing) {
            return response()->json([
                'short_url' => url('/s/' . $existing->code)
            ]);
        }

        // 生成一个不重复的 6 位随机字符串作为短码
        do {
            $code = Str::random(6);
        } while (ShortUrl::where('code', $code)->exists());

        // 存入数据库
        $shortUrl = ShortUrl::create([
            'code' => $code,
            'original_url' => $originalUrl
        ]);

        // 返回拼接好的完整网址给前端，例如：http://127.0.0.1:8000/s/aB3xD9
        return response()->json([
            'short_url' => url('/s/' . $shortUrl->code)
        ]);
    }

    /**
     * 3. 短网址重定向跳转与统计
     */
    public function redirectShortUrl($code)
    {
        // 根据 6 位短码查数据库，找不到直接报 404
        $shortUrl = ShortUrl::where('code', $code)->firstOrFail();

        // 访问量自增 1
        $shortUrl->increment('clicks');

        // 302 跳转到原本的长链接
        return redirect()->away($shortUrl->original_url);
    }

    /**
     * 辅助方法：简易 Cron 翻译器
     */
    private function translateCronToChinese($cron)
    {
        if ($cron === '* * * * *') return '每分钟执行一次';
        if ($cron === '0 * * * *') return '每小时的整点执行一次';
        if ($cron === '0 0 * * *') return '每天凌晨 00:00 执行一次';
        if ($cron === '0 0 * * 0') return '每周日凌晨 00:00 执行一次';
        if (preg_match('/^\*\/(\d+)\s+\*\s+\*\s+\*\s+\*$/', $cron, $matches)) {
            return "每隔 {$matches[1]} 分钟执行一次";
        }
        return '标准自定义定时任务（见下方预测时间）';
    }

    /**
     * 4. 动态生成 SVG 二维码
     */
    public function generateQrCode(Request $request)
    {
        // 验证参数
        $request->validate([
            'text' => 'required|string',
            'color' => 'nullable|string|size:7',      // 前景色，如 #4f46e5
            'bg_color' => 'nullable|string|size:7',   // 背景色，如 #ffffff
            'size' => 'nullable|integer|min:50|max:500'
        ]);

        $text = $request->input('text');
        $size = $request->input('size', 200);

        // 解析十六进制颜色为 RGB (例如 #4f46e5 -> 79, 70, 229)
        $colorHex = $request->input('color', '#000000');
        $bgHex = $request->input('bg_color', '#ffffff');

        list($r, $g, $b) = sscanf($colorHex, "#%02x%02x%02x");
        list($bg_r, $bg_g, $bg_b) = sscanf($bgHex, "#%02x%02x%02x");

        try {
            // 构建二维码构建器
            $qr = QrCode::format('svg')
                ->size($size)
                ->encoding('UTF-8')
                ->color($r, $g, $b)
                ->backgroundColor($bg_r, $bg_g, $bg_b)
                ->margin(1); // 边距

            // 【大厂玩法提示】如果你想在正中间加 Logo，可以解除下方注释（需确保 public 下有 logo.png）
            // $qr->merge('/public/logo.png', .3, true);

            $svgRaw = $qr->generate($text);

            return response()->json([
                'success' => true,
                'svg' => (string)$svgRaw
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '二维码生成失败: ' . $e->getMessage()
            ], 500);
        }
    }
}
