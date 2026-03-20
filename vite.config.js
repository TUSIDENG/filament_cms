import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // 核心优化1：指定 Laravel 服务端域名（覆盖默认 localhost）
            url: 'http://laravel.test',
            // 可选：指定 Vite 开发服务器端口（避免冲突）
            port: 5173,
        }),
        tailwindcss(),
    ],
    // 核心优化2：确保网络访问和热更新绑定 laravel.test
    server: {
        host: '0.0.0.0', // 允许所有IP访问（容器内必配）
        port: 5173, // 和上面 port 保持一致
        hmr: {
            host: 'laravel.test', // 热更新域名对齐服务端
            protocol: 'http', // 非HTTPS环境指定http
            port: 5173,
        },
        // 允许跨域（解决容器内访问跨域问题）
        cors: true,
        // 配置代理（可选，解决API请求跨域）
        proxy: {
            '/api': {
                target: 'http://laravel.test',
                changeOrigin: true,
            },
        },
    },
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
        // 可选：生产环境静态资源路径（确保和域名对齐）
        assetsDir: 'assets',
        base: '/', // 根路径，适配 laravel.test
    },
    // 可选：优化依赖预构建（加速启动）
    optimizeDeps: {
        include: ['alpinejs', '@ryangjchandler/alpine-clipboard'],
    },
});