<!-- ================= 4. JWT 智能解析器 ================= -->
<div x-show="currentTool === 'jwt'" x-cloak class="space-y-4 max-w-5xl mx-auto" x-data="jwtTool()">
    <button @click="currentTool = 'home'" class="text-indigo-600 hover:underline flex items-center gap-1">← 返回首页</button>
    <h2 class="text-2xl font-bold">📄 JWT (JSON Web Token) 智能解析器</h2>
    <input type="text" x-model="token" @input="parseJwt()" class="w-full p-3 border rounded-lg font-mono text-sm focus:ring-2 focus:ring-indigo-500" placeholder="请粘贴你要解析的原始 JWT Token...">
    <div x-show="error" class="p-3 bg-red-50 text-red-600 rounded-lg text-sm font-mono" x-text="error" x-cloak></div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-show="hasData" x-cloak>
        <div class="bg-white border rounded-xl p-4 space-y-2">
            <span class="text-sm font-bold text-red-600">🛑 Part 1: Header (头部)</span>
            <pre class="bg-gray-50 p-3 rounded font-mono text-xs overflow-x-auto" x-text="headerJson"></pre>
        </div>
        <div class="bg-white border rounded-xl p-4 space-y-2">
            <span class="text-sm font-bold text-indigo-600">🔷 Part 2: Payload (负载数据)</span>
            <pre class="bg-gray-50 p-3 rounded font-mono text-xs overflow-x-auto" x-text="payloadJson"></pre>
        </div>
    </div>
</div>