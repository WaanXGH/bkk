<?php

namespace App\Filament\Resources\LokerResource\Pages;

use App\Filament\Resources\LokerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLoker extends EditRecord
{
    protected static string $resource = LokerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
