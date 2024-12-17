<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\FeedInstagram;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FeedInstagramResource\Pages;
use App\Filament\Resources\FeedInstagramResource\RelationManagers;

class FeedInstagramResource extends Resource
{
    protected static ?string $model = FeedInstagram::class;

    protected static ?string $navigationGroup = 'Instagram';

    protected static ?string $navigationLabel = 'Feed Instagram';
    protected static ?string $navigationIcon = 'heroicon-o-camera';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('instagram_link')
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('row_number')
                    ->label('No')
                    ->getStateUsing(static function ($rowLoop) {
                        return $rowLoop->iteration;
                    }),
                TextColumn::make('instagram_link'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListFeedInstagrams::route('/'),
            'create' => Pages\CreateFeedInstagram::route('/create'),
            'edit' => Pages\EditFeedInstagram::route('/{record}/edit'),
        ];
    }
}
