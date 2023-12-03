<?php

namespace App\Filament\Resources\ComponentResource\Pages;

use App\Filament\Resources\ComponentResource;
use App\Filament\Resources\ComponentResource\Widgets\ComponentStatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComponents extends ListRecords
{
    protected static string $resource = ComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Crear componente'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ComponentStatsOverview::class,
        ];
    }


}
