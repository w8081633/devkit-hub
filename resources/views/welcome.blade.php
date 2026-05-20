<!DOCTYPE html>
<html lang="zh_CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevKit Hub - 独立开发者工具箱</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Crypto-js (用于前端计算 MD5/SHA256) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex flex-col">

    <!-- ===== 导航栏 ===== -->
    @include('components.header')

    <!-- 主体内容 -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 py-8" x-data="{ currentTool: 'home' }">

        <!-- ===== 首页（工具卡片网格） ===== -->
        @include('components.home')

        <!-- ===== 时间戳互转工具 ===== -->
        @include('components.timestamp')

        <!-- ===== Base64 / MD5 编解码器 ===== -->
        @include('components.crypto')

        <!-- ===== JWT 智能解析器 ===== -->
        @include('components.jwt')

        <!-- ===== QR Code 二维码生成器 ===== -->
        @include('components.qrcode')

        <!-- ===== JSON 美化 & 压缩 ===== -->
        @include('components.json')

        <!-- ===== 随机密码生成器 ===== -->
        @include('components.password')

        <!-- ===== Cron 表达式智能解析 ===== -->
        @include('components.cron')

        <!-- ===== 极简短链接生成器 ===== -->
        @include('components.shorturl')

    </main>

    <!-- ===== 页脚 ===== -->
    @include('components.footer')

    <!-- ===== Alpine.js 统一逻辑组件（所有工具函数） ===== -->
    @include('components.scripts')

</body>

</html>