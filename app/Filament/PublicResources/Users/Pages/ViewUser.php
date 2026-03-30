<?php

namespace App\Filament\PublicResources\Users\Pages;

use App\Filament\PublicResources\Users\UserResource;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    // 公共页面不需要编辑按钮
    protected function getHeaderActions(): array
    {
        return [];
    }
}
