<?php

namespace App\Filament\PublicResources\Dashboard;

use App\Filament\PublicResources\Dashboard\Pages\Welcome;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

class DashboardResource extends Resource
{
    protected static ?string $model = null;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $navigationLabel = '首页';

    protected static string|UnitEnum|null $navigationGroup = '公共资源';

    public static function getPages(): array
    {
        return [
            'index' => Welcome::route('/'),
        ];
    }
}
