<!-- ================= 1. 工具导航首页 ================= -->
<div x-show="currentTool === 'home'" class="space-y-6">
    <div class="text-center py-6">
        <h2 class="text-3xl font-extrabold text-gray-950">好用、干净的开发者工具</h2>
        <p class="mt-2 text-gray-600">纯净无广告，用完即走，全面提升你的搬砖效率。</p>
        <p class="mt-2 text-gray-400 text-sm">Made by <a href="https://github.com/w8081633/devkit-hub" target="_blank" class="text-indigo-500 hover:underline">wangzhen-fanhanyu</a></p>
    </div>

    <!-- 工具卡片网格 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- 卡片 1: 时间戳 -->
        <div @click="currentTool = 'timestamp'" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-indigo-500 cursor-pointer transition flex flex-col justify-between">
            <div>
                <div class="text-2xl mb-2">🕒</div>
                <h3 class="text-lg font-bold">TimeStamp 时间戳互转</h3>
                <p class="text-gray-500 text-sm mt-1">本地时间与 Unix 时间戳毫秒级互转，自带实时极客秒表。</p>
            </div>
        </div>

        <!-- 卡片 2: 编解码 -->
        <div @click="currentTool = 'crypto'" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-indigo-500 cursor-pointer transition flex flex-col justify-between">
            <div>
                <div class="text-2xl mb-2">🔏</div>
                <h3 class="text-lg font-bold">Base64 / MD5 编解码</h3>
                <p class="text-gray-500 text-sm mt-1">一键对文本进行 Base64 编解码，或生成 MD5、SHA256 哈希签名。</p>
            </div>
        </div>

        <!-- 卡片 3: JWT -->
        <div @click="currentTool = 'jwt'" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-indigo-500 cursor-pointer transition flex flex-col justify-between">
            <div>
                <div class="text-2xl mb-2">📄</div>
                <h3 class="text-lg font-bold">JWT 智能解析器</h3>
                <p class="text-gray-500 text-sm mt-1">结构化解码 JWT (JSON Web Token)，直观查看 Header 和 Payload 荷载。</p>
            </div>
        </div>

        <!-- 新增卡片 4: 二维码生成器 -->
        <div @click="currentTool = 'qrcode'" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-indigo-500 cursor-pointer transition flex flex-col justify-between">
            <div>
                <div class="text-2xl mb-2">🖼️</div>
                <h3 class="text-lg font-bold">QR Code 二维码生成器</h3>
                <p class="text-gray-500 text-sm mt-1">输入任意文本或网址，后端生成高清 SVG 二维码，支持调色。</p>
            </div>
        </div>

        <!-- 卡片 5: JSON -->
        <div @click="currentTool = 'json'" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-indigo-500 cursor-pointer transition flex flex-col justify-between">
            <div>
                <div class="text-2xl mb-2">📦</div>
                <h3 class="text-lg font-bold">JSON 美化 & 压缩</h3>
                <p class="text-gray-500 text-sm mt-1">格式化凌乱的 JSON 数据，或者将其压缩在一行。</p>
            </div>
        </div>

        <!-- 卡片 6: Password -->
        <div @click="currentTool = 'password'" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-indigo-500 cursor-pointer transition flex flex-col justify-between">
            <div>
                <div class="text-2xl mb-2">🔑</div>
                <h3 class="text-lg font-bold">随机密码生成器</h3>
                <p class="text-gray-500 text-sm mt-1">生成高强度的随机密码，自定义长度和数字。</p>
            </div>
        </div>

        <!-- 卡片 7: Cron -->
        <div @click="currentTool = 'cron'" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-indigo-500 cursor-pointer transition flex flex-col justify-between">
            <div>
                <div class="text-2xl mb-2">⚙️</div>
                <h3 class="text-lg font-bold">Cron 表达式解析</h3>
                <p class="text-gray-500 text-sm mt-1">解析 Linux Cron 表达式，预测未来 5 次精准执行时间。</p>
            </div>
        </div>

        <!-- 卡片 8: ShortURL -->
        <div @click="currentTool = 'shorturl'" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-indigo-500 cursor-pointer transition flex flex-col justify-between">
            <div>
                <div class="text-2xl mb-2">🔗</div>
                <h3 class="text-lg font-bold">极简短链接生成</h3>
                <p class="text-gray-500 text-sm mt-1">将冗长的网址缩短，自带极简的高级点击访问统计。</p>
            </div>
        </div>
    </div>
</div>