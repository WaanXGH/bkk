<?php

namespace App\Filament\Resources\LokerResource\Pages;

use App\Filament\Resources\LokerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLokers extends ListRecords
{
    protected static string $resource = LokerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
