<!-- ================= 3. Base64 / MD5 编解码器 ================= -->
<div x-show="currentTool === 'crypto'" x-cloak class="space-y-4 max-w-5xl mx-auto" x-data="cryptoTool()">
    <button @click="currentTool = 'home'" class="text-indigo-600 hover:underline flex items-center gap-1">← 返回首页</button>
    <h2 class="text-2xl font-bold">🔏 Base64 / MD5 编解码及哈希工具</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">输入文本数据</label>
            <textarea x-model="input" class="w-full h-48 p-3 font-mono text-sm border rounded-lg focus:ring-2 focus:ring-indigo-500" placeholder="在这里输入你需要处理的字符串..."></textarea>
            <div class="flex flex-wrap gap-2 mt-4">
                <button @click="base64Encode()" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">Base64 编码</button>
                <button @click="base64Decode()" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 text-sm">Base64 解码</button>
                <button @click="calcHash('md5')" class="bg-slate-700 text-white px-4 py-2 rounded-md hover:bg-slate-800 text-sm">计算 MD5</button>
                <button @click="calcHash('sha256')" class="bg-slate-700 text-white px-4 py-2 rounded-md hover:bg-slate-800 text-sm">计算 SHA256</button>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">处理结果展示</label>
            <textarea x-model="output" readonly class="w-full h-48 p-3 font-mono text-sm border rounded-lg bg-gray-50 text-indigo-700 font-bold"></textarea>
            <div class="mt-2 flex justify-between items-center text-xs">
                <span x-text="info" class="text-emerald-600 font-medium"></span>
                <button x-show="output" @click="navigator.clipboard.writeText(output); alert('复制成功！')" class="bg-gray-800 text-white px-3 py-1 rounded hover:bg-gray-900">一键复制结果</button>
            </div>
        </div>
    </div>
</div>