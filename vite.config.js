import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: false, // 关键：关闭 Laravel 页面自动刷新，避免 Livewire 冲突
            url: 'http://laravel.test',
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'laravel.test',
            protocol: 'http',
            port: 5173,
            clientPort: 5173,
        },
        watch: {
            // 避免过度监听导致的频繁重编译
            usePolling: false,
            ignored: ['**/vendor/**', '**/storage/**', '**/bootstrap/cache/**'],
        },
        cors: {
            origin: ['http://laravel.test', 'http://localhost'],
            credentials: true,
        },
    },
    build: {
        // 确保资源文件名包含内容哈希，避免缓存问题
        rollupOptions: {
            output: {
                entryFileNames: 'js/[name]-[hash].js',
                chunkFileNames: 'js/[name]-[hash].js',
                assetFileNames: (assetInfo) => {
                    const info = assetInfo.name.split('.');
                    const ext = info[info.length - 1];
                    if (ext === 'css') {
                        return 'css/[name]-[hash][extname]';
                    }
                    return 'assets/[name]-[hash][extname]';
                },
            },
        },
        // 确保生成 manifest.json
        manifest: true,
        // 输出目录
        outDir: 'public/build',
        // 清空输出目录
        emptyOutDir: true,
    },
});