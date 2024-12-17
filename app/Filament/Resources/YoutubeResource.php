<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Youtube;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\YoutubeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\YoutubeResource\RelationManagers;

class YoutubeResource extends Resource
{
    protected static ?string $model = Youtube::class;

    protected static ?string $navigationGroup = 'Youtube';

    protected static ?string $navigationLabel = 'Youtube';

    protected static ?string $navigationIcon = 'heroicon-o-play-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_playlist')->label('Nama Playlist :'),    
                        TextInput::make('link_youtube')->label('Link Youtube :'),    
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
                TextColumn::make('nama_playlist'),
                TextColumn::make('link_youtube'),
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
            'index' => Pages\ListYoutubes::route('/'),
            'create' => Pages\CreateYoutube::route('/create'),
            'edit' => Pages\EditYoutube::route('/{record}/edit'),
        ];
    }
}
