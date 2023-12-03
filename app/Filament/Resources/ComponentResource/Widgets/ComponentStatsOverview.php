<?php

namespace App\Filament\Resources\ComponentResource\Widgets;

use App\Models\Component;
use App\Models\Department;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ComponentStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de componentes', Component::all()->count()),
            Stat::make('Total de departamentos', Department::all()->count()),
            Stat::make('Total de usuarios', User::all()->count()),
        ];
    }
}
