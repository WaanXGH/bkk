<?php

namespace App\Filament\Resources\RelasiResource\Pages;

use App\Filament\Resources\RelasiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelasis extends ListRecords
{
    protected static string $resource = RelasiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
