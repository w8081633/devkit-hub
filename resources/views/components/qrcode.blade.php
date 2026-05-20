<!-- ================= 5. QR Code 二维码生成器界面 ================= -->
<div x-show="currentTool === 'qrcode'" x-cloak class="space-y-4 max-w-4xl mx-auto" x-data="window.qrCodeToolInstance">
    <button @click="currentTool = 'home'" class="text-indigo-600 hover:underline flex items-center gap-1">← 返回首页</button>
    <h2 class="text-2xl font-bold">🖼️ QR Code 二维码智能生成器</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-white p-6 rounded-xl shadow-sm border">
        <!-- 左侧：参数调节 -->
        <div class="md:col-span-2 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">输入二维码内容 (文本或网址)</label>
                <textarea x-model="text" class="w-full h-24 p-2 border rounded-md font-mono text-sm focus:ring-2 focus:ring-indigo-500" placeholder="例如：https://github.com"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">前景色 (码色)</label>
                    <div class="flex gap-2 items-center">
                        <input type="color" x-model="color" class="w-8 h-8 rounded border cursor-pointer">
                        <input type="text" x-model="color" class="flex-1 p-1 border rounded text-xs font-mono uppercase">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">背景色</label>
                    <div class="flex gap-2 items-center">
                        <input type="color" x-model="bg_color" class="w-8 h-8 rounded border cursor-pointer">
                        <input type="text" x-model="bg_color" class="flex-1 p-1 border rounded text-xs font-mono uppercase">
                    </div>
                </div>
            </div>
            <div>
                <button @click="generateQr()" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 font-medium text-sm transition">生成高清 SVG 二维码</button>
            </div>
        </div>

        <!-- 右侧：实时渲染与下载 -->
        <div class="flex flex-col items-center justify-center bg-gray-50 border rounded-lg p-4 min-h-[250px]">
            <div x-html="svgHtml" class="bg-white p-2 border shadow-sm rounded">
                <!-- 这里将被注入原始 SVG 二维码 -->
            </div>
            <div x-show="svgHtml" class="mt-4 w-full" x-cloak>
                <button @click="downloadSvg()" class="w-full bg-gray-800 text-white py-1.5 rounded text-xs font-medium hover:bg-gray-900">下载 SVG 图片</button>
            </div>
        </div>
    </div>
</div>