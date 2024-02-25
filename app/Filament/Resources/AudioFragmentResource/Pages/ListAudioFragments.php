<?php

namespace App\Filament\Resources\AudioFragmentResource\Pages;

use App\Filament\Resources\AudioFragmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAudioFragments extends ListRecords
{
    protected static string $resource = AudioFragmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
