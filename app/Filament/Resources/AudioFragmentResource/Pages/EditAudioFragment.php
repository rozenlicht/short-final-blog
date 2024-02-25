<?php

namespace App\Filament\Resources\AudioFragmentResource\Pages;

use App\Filament\Resources\AudioFragmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAudioFragment extends EditRecord
{
    protected static string $resource = AudioFragmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
