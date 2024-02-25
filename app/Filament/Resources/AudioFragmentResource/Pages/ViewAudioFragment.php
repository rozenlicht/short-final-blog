<?php

namespace App\Filament\Resources\AudioFragmentResource\Pages;

use App\Filament\Resources\AudioFragmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAudioFragment extends ViewRecord
{
    protected static string $resource = AudioFragmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
