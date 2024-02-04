<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlideshowResource\Pages;
use App\Filament\Resources\SlideshowResource\RelationManagers;
use App\Filament\Resources\SlideshowResource\RelationManagers\PhotoRelationManager;
use App\Models\Photo;
use App\Models\Slideshow;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class SlideshowResource extends Resource
{
    protected static ?string $model = Slideshow::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Repeater::make('slideshowPhotos')
                    ->relationship()
                    ->schema([
                        Select::make('photo_id')
                            ->label('Photo')
                            ->native(false)
                            ->allowHtml()
                            ->relationship('photo', 'caption')
                            ->getOptionLabelFromRecordUsing(fn (Photo $photo) => static::getCleanOptionString($photo))
                            ->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(2)
            ->schema([
                Infolists\Components\TextEntry::make('name'),
                Infolists\Components\TextEntry::make('embed_code'),
                Infolists\Components\RepeatableEntry::make('slideshowPhotos')
                    ->label('Photos')
                    ->columnSpan(2)
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('photo.path')
                            ->columnSpan(1)
                            ->label(fn ($record) => $record->photo->caption)
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSlideshows::route('/'),
            'create' => Pages\CreateSlideshow::route('/create'),
            'view' => Pages\ViewSlideshow::route('/{record}'),
            'edit' => Pages\EditSlideshow::route('/{record}/edit'),
        ];
    }

    public static function getCleanOptionString(Model $model): string
    {
        return view('filament.components.select-photo')
            ->with('caption', $model?->caption)
            ->with('path', $model?->path)
            ->render();
    }
}
