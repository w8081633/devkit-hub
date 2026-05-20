<!-- ================= 7. 密码生成工具界面 ================= -->
<div x-show="currentTool === 'password'" x-cloak class="space-y-4">
    <button @click="currentTool = 'home'" class="text-indigo-600 hover:underline flex items-center gap-1">← 返回首页</button>
    <h2 class="text-2xl font-bold">🔑 随机密码生成器</h2>
    <div x-data="passwordTool()" class="max-w-md bg-white p-6 rounded-xl border">
        <label class="block text-sm font-medium text-gray-700">密码长度: <span x-text="length" class="text-indigo-600 font-bold"></span></label>
        <input type="range" min="8" max="32" x-model="length" class="w-full mt-1">
        <div class="flex items-center gap-2 mt-2">
            <input type="checkbox" id="numbers" x-model="includeNumbers">
            <label for="numbers" class="text-sm text-gray-700">包含数字 (0-9)</label>
        </div>
        <button @click="generatePassword()" class="w-full bg-indigo-600 text-white py-2 rounded-md mt-4">立即生成</button>
        <div class="mt-4 pt-4 border-t" x-show="result" x-cloak>
            <div class="flex gap-2">
                <input type="text" x-model="result" readonly class="flex-1 p-2 font-mono text-lg bg-gray-50 border rounded-md text-center">
                <button @click="navigator.clipboard.writeText(result); alert('密码已复制！')" class="bg-gray-800 text-white px-3 py-1 rounded text-sm">复制</button>
            </div>
        </div>
    </div>
</div>