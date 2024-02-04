<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogArticleResource\Pages;
use App\Filament\Resources\BlogArticleResource\RelationManagers;
use App\Models\BlogArticle;
use App\Models\Photo;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Cache;

class BlogArticleResource extends Resource
{
    protected static ?string $model = BlogArticle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->columnSpanFull()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtitle')
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('flight_date')->date()->time(false),

                Forms\Components\TextInput::make('flickr_url')
                    ->columnSpanFull()
                    ->url()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Select::make('photo_id')
                    ->relationship(name: 'photo', titleAttribute: 'caption'),
                Select::make('involved_icao')
                    ->multiple()
                    ->getSearchResultsUsing(fn (string $search): array => static::airportOptions()->filter(fn ($name, $icao) => str_contains(strtolower($name), strtolower($search)))->slice(0, 5)->toArray())
                    ->getOptionLabelUsing(fn ($value) => static::airportOptions()[$value])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('involved_icao')
                    ->formatStateUsing(
                        fn (string $state): string => collect(explode(', ', $state))->map(
                            fn ($airport) =>
                            static::airportOptions()[$airport]
                        )->join('<br>')
                    )
                    ->html()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogArticles::route('/'),
            'create' => Pages\CreateBlogArticle::route('/create'),
            'edit' => Pages\EditBlogArticle::route('/{record}/edit'),
        ];
    }

    public static function airportOptions()
    {

        return Cache::rememberForever('airportOptions', function () {
            $airports = collect(json_decode(file_get_contents(database_path('airports.json')), true));
            return $airports->mapWithKeys(function ($airport) {
                return [$airport['icao'] => $airport['name'] . ' (' . $airport['icao'] . ')'];
            });
        });
    }
}
