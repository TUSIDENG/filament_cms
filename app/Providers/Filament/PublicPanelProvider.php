<?php

namespace App\Providers\Filament;

use App\Filament\PublicResources\Dashboard\Pages\Welcome;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PublicPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('public')
            ->path('public')
            ->colors([
                'primary' => Color::Blue,
            ])
            // 只发现需要对外展示的资源
            // 可以在这里指定具体的资源，或者创建单独的目录
            ->discoverResources(in: app_path('Filament/PublicResources'), for: 'App\Filament\PublicResources')
            ->discoverPages(in: app_path('Filament/PublicPages'), for: 'App\Filament\PublicPages')
            ->pages([
                Welcome::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            // 不需要认证中间件
            ->authMiddleware([]);
    }
}
