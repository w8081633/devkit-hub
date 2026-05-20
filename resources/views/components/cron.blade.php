<!-- ================= 8. Cron 工具界面 ================= -->
<div x-show="currentTool === 'cron'" x-cloak class="space-y-4 max-w-3xl mx-auto">
    <button @click="currentTool = 'home'" class="text-indigo-600 hover:underline flex items-center gap-1">← 返回首页</button>
    <h2 class="text-2xl font-bold">⚙️ Cron 表达式智能解析</h2>
    <div x-data="cronTool()" class="bg-white p-6 rounded-xl border space-y-4">
        <div class="flex gap-2">
            <input type="text" x-model="expression" class="flex-1 p-2 border rounded-md font-mono">
            <button @click="parseCron()" class="bg-indigo-600 text-white px-6 py-2 rounded-md">解析</button>
        </div>
        <div x-show="error" class="text-red-500 text-sm" x-text="error" x-cloak></div>
        <div x-show="description" class="p-3 bg-indigo-50 rounded-lg text-sm" x-text="'💡 核心含义：' + description" x-cloak></div>
        <div x-show="nextRuns.length > 0" x-cloak>
            <ul class="space-y-1 bg-gray-50 p-4 rounded-lg font-mono text-sm">
                <template x-for="(time, index) in nextRuns" :key="index">
                    <li x-text="(index+1) + '. ' + time"></li>
                </template>
            </ul>
        </div>
    </div>
</div>