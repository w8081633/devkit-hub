<!-- ================= Alpine.js 统一逻辑组件 ================= -->
<script>
    // 定义二维码工具，并挂载到全局，实现跨工具联动
    function qrCodeTool() {
        return {
            text: 'https://github.com',
            color: '#000000',
            bg_color: '#ffffff',
            svgHtml: '<span class="text-gray-400 text-xs">暂无生成</span>',

            // ✨ 终极绝招：利用 Alpine.js 的监听机制
            // 只要 currentTool 变成 qrcode，就触发这个检查
            init() {
                this.$watch('$parent.currentTool', (value) => {
                    if (value === 'qrcode') {
                        // 尝试去网页里抓取刚刚生成的短链接框
                        let shortUrlInput = document.getElementById('generated-short-url');

                        if (shortUrlInput && shortUrlInput.value.trim() !== '') {
                            // 1. 强行覆盖当前的默认文字
                            this.text = shortUrlInput.value;
                            // 2. 自动触发后端生成
                            this.generateQr();
                        }
                    }
                });
            },

            async generateQr() {
                if (!this.text.trim()) return;
                try {
                    let response = await fetch('/ajax/generate-qrcode', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            text: this.text,
                            color: this.color,
                            bg_color: this.bg_color,
                            size: 200
                        })
                    });
                    let data = await response.json();
                    if (data.success) {
                        this.svgHtml = data.svg;
                    } else {
                        alert(data.message);
                    }
                } catch (e) {
                    alert('后端接口请求失败');
                }
            },
            downloadSvg() {
                let blob = new Blob([this.svgHtml], {
                    type: 'image/svg+xml'
                });
                let url = URL.createObjectURL(blob);
                let a = document.createElement('a');
                a.href = url;
                a.download = 'devkit-qrcode.svg';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            }
        }
    }
    // 全局实例化二维码对象，以便其他组件读取
    window.qrCodeToolInstance = qrCodeTool();

    // 统一联动业务函数：从短链接工具跳转并自动生成
    window.createQrFromShortUrl = function(shortUrl, shortUrlComponentScope) {
        window.qrCodeToolInstance.text = shortUrl; // 强行塞入值
        window.qrCodeToolInstance.generateQr(); // 触发请求
        // 改变主页面 Alpine 变量：实现跨页跳转
        document.querySelector('[x-data]').__x.$data.currentTool = 'qrcode';
    };

    function timestampTool() {
        return {
            nowString: '',
            nowTs: '',
            inputTs: Math.floor(Date.now() / 1000),
            outputDate: '',
            inputDate: '',
            outputTs: '',
            startClock() {
                let d = new Date();
                this.inputDate = d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0') + ' ' + String(d.getHours()).padStart(2, '0') + ':' + String(d.getMinutes()).padStart(2, '0') + ':' + String(d.getSeconds()).padStart(2, '0');
                setInterval(() => {
                    let now = new Date();
                    this.nowTs = Math.floor(now.getTime() / 1000);
                    this.nowString = now.toLocaleString();
                }, 1000);
            },
            tsToDate() {
                let date = new Date(parseInt(this.inputTs) * 1000);
                this.outputDate = isNaN(date.getTime()) ? '无效的时间戳' : date.toLocaleString();
            },
            dateToTs() {
                let ts = Date.parse(this.inputDate.replace(/-/g, '/'));
                this.outputTs = isNaN(ts) ? '时间格式错误' : Math.floor(ts / 1000);
            }
        }
    }

    function cryptoTool() {
        return {
            input: '',
            output: '',
            info: '',
            base64Encode() {
                try {
                    this.output = btoa(unescape(encodeURIComponent(this.input)));
                    this.info = '✨ Base64 编码成功';
                } catch (e) {
                    this.output = '失败';
                }
            },
            base64Decode() {
                try {
                    this.output = decodeURIComponent(escape(atob(this.input)));
                    this.info = '✨ Base64 解码成功';
                } catch (e) {
                    this.output = '失败';
                }
            },
            calcHash(type) {
                if (!this.input) return;
                this.output = type === 'md5' ? CryptoJS.MD5(this.input).toString() : CryptoJS.SHA256(this.input).toString();
                this.info = '⚡ 计算完毕';
            }
        }
    }

    function jwtTool() {
        return {
            token: '',
            headerJson: '',
            payloadJson: '',
            error: '',
            hasData: false,
            parseJwt() {
                this.error = '';
                this.hasData = false;
                if (!this.token.trim()) return;
                let parts = this.token.split('.');
                if (parts.length !== 3) {
                    this.error = '格式错误';
                    return;
                }
                try {
                    const base64UrlDecode = (str) => {
                        let base64 = str.replace(/-/g, '+').replace(/_/g, '/');
                        while (base64.length % 4) {
                            base64 += '=';
                        }
                        return decodeURIComponent(escape(atob(base64)));
                    };
                    this.headerJson = JSON.stringify(JSON.parse(base64UrlDecode(parts[0])), null, 4);
                    this.payloadJson = JSON.stringify(JSON.parse(base64UrlDecode(parts[1])), null, 4);
                    this.hasData = true;
                } catch (e) {
                    this.error = '解析失败';
                }
            }
        }
    }

    function jsonTool() {
        return {
            input: '',
            output: '',
            error: '',
            formatJson() {
                try {
                    this.error = '';
                    this.output = JSON.stringify(JSON.parse(this.input), null, 4);
                } catch (e) {
                    this.error = '无效格式';
                }
            },
            minifyJson() {
                try {
                    this.error = '';
                    this.output = JSON.stringify(JSON.parse(this.input));
                } catch (e) {
                    this.error = '无效格式';
                }
            }
        }
    }

    function passwordTool() {
        return {
            length: 16,
            includeNumbers: true,
            result: '',
            generatePassword() {
                let pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' + (this.includeNumbers ? '0123456789' : '');
                let res = '';
                for (let i = 0; i < this.length; i++) res += pool.charAt(Math.floor(Math.random() * pool.length));
                this.result = res;
            }
        }
    }

    function cronTool() {
        return {
            expression: '*/15 6-12 * * 1-5',
            description: '',
            nextRuns: [],
            error: '',
            async parseCron() {
                try {
                    let response = await fetch('/ajax/parse-cron', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            cron: this.expression
                        })
                    });
                    let data = await response.json();
                    if (data.success) {
                        this.description = data.description;
                        this.nextRuns = data.next_runs;
                    } else {
                        this.error = data.message;
                    }
                } catch (e) {
                    this.error = '错误';
                }
            }
        }
    }

    function shortUrlTool() {
        return {
            longUrl: '',
            result: '',
            async generateShort() {
                if (!this.longUrl) return;
                try {
                    let response = await fetch('/ajax/shorten-url', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            url: this.longUrl
                        })
                    });
                    let data = await response.json();
                    this.result = data.short_url;
                } catch (e) {
                    alert('错误');
                }
            }
        }
    }
</script>