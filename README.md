# DevKit Hub 🛠️

> 独立开发者工具箱 — 基于 Laravel 13 的一站式在线工具集
> 作者：[wangzhen-fanhanyu](https://github.com/w8081633/devkit-hub)

DevKit Hub 是一个轻量级的 Web 工具箱，为开发者提供日常开发中常用的在线工具，所有功能集成在单页面中，纯净无广告，用完即走。

---

## 特性

- ⚡ **单页应用体验** — 基于 Alpine.js 的 SPA 式切换，零页面刷新
- 🎨 **现代 UI** — 使用 Tailwind CSS，响应式设计，适配桌面与移动端
- 🔒 **前端+后端混合** — 敏感操作由 Laravel 后端处理，安全性高
- 🧩 **模块化架构** — 视图组件化，基于 Laravel Blade `@include` 拆分管理

## 技术栈

| 技术 | 用途 |
|------|------|
| **Laravel 13** | PHP 后端框架 |
| **Alpine.js 3.x** | 前端交互逻辑与 SPA 式页面切换 |
| **Tailwind CSS** | 样式框架 |
| **Simple QR Code** | 后端生成 SVG 二维码 |
| **Cron Expression** | Cron 表达式解析与时间预测 |
| **CryptoJS** | 前端 MD5/SHA256 哈希计算 |

## 工具清单

| 工具 | 描述 |
|------|------|
| 🕒 **TimeStamp 时间戳互转** | Unix 时间戳与可读时间双向转换，附带实时秒表 |
| 🔏 **Base64 / MD5 编解码** | 文本 Base64 编解码、MD5/SHA256 哈希计算 |
| 📄 **JWT 智能解析器** | 解码并格式化展示 JWT 的 Header 和 Payload |
| 🖼️ **QR Code 二维码生成器** | 输入文本/网址，后端生成可下载的 SVG 二维码，支持自定义颜色 |
| 📦 **JSON 美化 & 压缩** | JSON 数据格式化和压缩 |
| 🔑 **随机密码生成器** | 生成高强度随机密码，支持长度和数字选项 |
| ⚙️ **Cron 表达式解析** | 解析 Linux Cron 表达式，预测未来执行时间 |
| 🔗 **极简短链接生成** | 长网址转短链接 |

## 快速开始

### 环境要求

- PHP >= 8.3
- Composer
- Node.js & NPM

### 安装

```bash
# 克隆项目
git clone <repository-url>
cd devkit-hub

# 使用项目自带的 setup 命令安装
composer setup

# 或者手动安装
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

### 启动开发服务器

```bash
composer dev
```

或分别启动：

```bash
# Terminal 1: Laravel 服务
php artisan serve

# Terminal 2: Vite 前端构建
npm run dev
```

打开浏览器访问 `http://localhost:8000` 即可使用。

### 运行测试

```bash
composer test
```

## 项目结构

```
resources/views/
├── welcome.blade.php          # 入口视图，通过 @include 加载所有组件
└── components/
    ├── header.blade.php       # 导航栏
    ├── home.blade.php         # 首页工具卡片网格 ⭐
    ├── timestamp.blade.php    # 时间戳互转工具
    ├── crypto.blade.php       # Base64/MD5 编解码
    ├── jwt.blade.php          # JWT 解析器
    ├── qrcode.blade.php       # 二维码生成器
    ├── json.blade.php         # JSON 美化/压缩
    ├── password.blade.php     # 密码生成器
    ├── cron.blade.php         # Cron 表达式解析
    ├── shorturl.blade.php     # 短链接生成
    ├── scripts.blade.php      # Alpine.js 统一逻辑函数
    └── footer.blade.php       # 页脚
```

## 截图

> ![图片说明文字](public/images/image.png)

## License

本项目基于 MIT 许可证开源。