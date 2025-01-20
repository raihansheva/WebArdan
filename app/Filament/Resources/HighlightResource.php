<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HighlightResource\Pages;
use App\Filament\Resources\HighlightResource\RelationManagers;
use App\Models\Highlight;
use App\Models\YoutubeHighlight;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HighlightResource extends Resource
{
    protected static ?string $model = YoutubeHighlight::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('link_video')
                            ->label('Link Video :')
                            ->required(),

                        Select::make('page')
                            ->label('Page :')
                            ->options([
                                'home' => 'Home',
                                'podcast' => 'Podcast',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('link_video'),
                TextColumn::make('page'),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHighlights::route('/'),
            'create' => Pages\CreateHighlight::route('/create'),
            'edit' => Pages\EditHighlight::route('/{record}/edit'),
        ];
    }
}
