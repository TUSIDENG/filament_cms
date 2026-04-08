<x-filament-panels::page>
    <div class="flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 min-h-[60vh]">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    欢迎你！
                </h1>
                <p class="mt-2 text-xl text-gray-600 dark:text-gray-300">
                    客户当前 IP: <span class="font-mono bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">{{ $clientIp }}</span>
                </p>
                <div class="mt-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        这是公共资源的入口页面
                    </p>
                </div>
            </div>
            
            <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    可用资源
                </h2>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('filament.public.resources.users.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                            👥 用户列表
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-filament-panels::page>