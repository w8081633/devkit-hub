<!-- ================= 9. 短链接工具界面 ================= -->
<div x-show="currentTool === 'shorturl'" x-cloak class="space-y-4 max-w-3xl mx-auto">
    <button @click="currentTool = 'home'" class="text-indigo-600 hover:underline flex items-center gap-1">← 返回首页</button>
    <h2 class="text-2xl font-bold">🔗 极简短链接生成器</h2>
    <div x-data="shortUrlTool()" class="bg-white p-6 rounded-xl border space-y-4">
        <div class="flex gap-2">
            <input type="url" x-model="longUrl" class="flex-1 p-2 border rounded-md" placeholder="https://example.com">
            <button @click="generateShort()" class="bg-indigo-600 text-white px-6 py-2 rounded-md">缩短网址</button>
        </div>
        <div x-show="result" class="p-4 bg-green-50 border border-green-200 rounded-lg space-y-3" x-cloak>
            <p class="text-sm font-medium text-green-800">🎉 生成成功！</p>
            <div class="flex gap-2 items-center">
                <input type="text" x-model="result" readonly class="flex-1 p-2 bg-white border rounded font-mono text-indigo-600 font-bold text-center">
                <button @click="navigator.clipboard.writeText(result); alert('复制成功！')" class="bg-gray-800 text-white px-4 py-2 rounded text-sm">复制</button>
            </div>
        </div>
    </div>
</div>