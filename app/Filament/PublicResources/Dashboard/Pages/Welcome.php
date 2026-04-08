<?php

namespace App\Filament\PublicResources\Dashboard\Pages;

use App\Filament\PublicResources\Dashboard\DashboardResource;
use Filament\Resources\Pages\Page;

class Welcome extends Page
{
    protected static string $resource = DashboardResource::class;

    protected string $view = 'filament.public.pages.welcome';

    protected function getViewData(): array
    {
        return [
            'clientIp' => $this->getClientIp(),
        ];
    }

    private function getClientIp()
    {
        $ipAddress = request()->ip();
        
        // 检查是否有代理 IP
        if (request()->hasHeader('X-Forwarded-For')) {
            $ips = explode(',', request()->header('X-Forwarded-For'));
            $ipAddress = trim($ips[0]);
        } elseif (request()->hasHeader('X-Real-IP')) {
            $ipAddress = request()->header('X-Real-IP');
        }
        
        return $ipAddress;
    }
}
