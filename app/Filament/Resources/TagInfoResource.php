<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\TagInfo;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TagInfoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TagInfoResource\RelationManagers;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;

class TagInfoResource extends Resource
{
    protected static ?string $model = TagInfo::class;

    protected static ?string $navigationGroup = 'Info';

    protected static ?string $navigationLabel = 'Kategori Info';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_kategori')->label('Kategori Name:')
                            ->required(),
                        Toggle::make('is_visible')
                            ->label('Tampilkan di website?')
                            ->required(),
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
                TextColumn::make('nama_kategori'),
                IconColumn::make('is_visible')
                    ->label('Ditampilkan')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
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
            'index' => Pages\ListTagInfos::route('/'),
            'create' => Pages\CreateTagInfo::route('/create'),
            'edit' => Pages\EditTagInfo::route('/{record}/edit'),
        ];
    }
}
