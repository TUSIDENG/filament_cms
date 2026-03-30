<?php

namespace App\Filament\PublicResources\Users\Pages;

use App\Filament\PublicResources\Users\UserResource;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    // 公共页面不需要创建按钮
    protected function getHeaderActions(): array
    {
        return [];
    }
}
