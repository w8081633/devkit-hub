<!-- ================= 2. 时间戳互转工具 ================= -->
<div x-show="currentTool === 'timestamp'" x-cloak class="space-y-4 max-w-4xl mx-auto" x-data="timestampTool()" x-init="startClock()">
    <button @click="currentTool = 'home'" class="text-indigo-600 hover:underline flex items-center gap-1">← 返回首页</button>
    <h2 class="text-2xl font-bold">🕒 TimeStamp 时间戳互转</h2>

    <div class="bg-gray-900 text-emerald-400 p-4 rounded-xl font-mono flex flex-wrap justify-between items-center shadow-inner gap-2">
        <div>🖥️ 当前时间 (Local)：<span x-text="nowString"></span></div>
        <div>⏱️ Unix时间戳：<span class="font-bold text-xl text-white" x-text="nowTs"></span> 秒</div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end border-b pb-6">
            <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">输入 Unix 时间戳</label>
                <input type="text" x-model="inputTs" class="w-full p-2 border rounded-md font-mono" placeholder="如: 1779262200">
            </div>
            <div>
                <button @click="tsToDate()" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 text-sm">转换成时间 ➔</button>
            </div>
            <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-500 mb-1">当地可读时间</label>
                <input type="text" x-model="outputDate" readonly class="w-full p-2 bg-gray-50 border rounded-md font-mono text-indigo-600 font-bold">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">输入可读时间 (YYYY-MM-DD HH:mm:ss)</label>
                <input type="text" x-model="inputDate" class="w-full p-2 border rounded-md font-mono" placeholder="如: 2026-05-20 15:30:00">
            </div>
            <div>
                <button @click="dateToTs()" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 text-sm">转换成时间戳 ➔</button>
            </div>
            <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-500 mb-1">Unix 时间戳 (秒)</label>
                <input type="text" x-model="outputTs" readonly class="w-full p-2 bg-gray-50 border rounded-md font-mono text-indigo-600 font-bold">
            </div>
        </div>
    </div>
</div>