<!-- ================= 6. JSON 工具界面 ================= -->
<div x-show="currentTool === 'json'" x-cloak class="space-y-4">
    <button @click="currentTool = 'home'" class="text-indigo-600 hover:underline flex items-center gap-1">← 返回首页</button>
    <h2 class="text-2xl font-bold">📦 JSON 美化 & 压缩</h2>
    <div x-data="jsonTool()" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <textarea x-model="input" class="w-full h-80 p-3 font-mono text-sm border rounded-lg bg-white" placeholder="在这里粘贴你的 JSON..."></textarea>
            <div class="mt-2 space-x-2">
                <button @click="formatJson()" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm">美化 (Format)</button>
                <button @click="minifyJson()" class="bg-gray-600 text-white px-4 py-2 rounded-md text-sm">压缩 (Minify)</button>
            </div>
        </div>
        <div>
            <textarea x-model="output" readonly class="w-full h-80 p-3 font-mono text-sm border rounded-lg bg-gray-100"></textarea>
            <p x-text="error" class="text-red-500 text-sm mt-2"></p>
        </div>
    </div>
</div>