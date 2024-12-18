<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\CopyRight;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CopyRightResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CopyRightResource\RelationManagers;

class CopyRightResource extends Resource
{
    protected static ?string $model = CopyRight::class;

    protected static ?string $navigationGroup = 'Footer';

    protected static ?string $navigationLabel = 'CopyRight';

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('text')
                            ->label('Copyright Text :')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('copyright_owners')
                            ->label('Copyright Owners :')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('link_company')
                            ->label('Company Link :')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('year')
                            ->label('Year :')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(date('Y')),
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
                TextColumn::make('text')
                    ->label('Copyright Text')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('copyright_owners')
                    ->label('Copyright Owners')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('link_company')
                    ->label('Company Link')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Year')
                    ->sortable(),
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
            'index' => Pages\ListCopyRights::route('/'),
            'create' => Pages\CreateCopyRight::route('/create'),
            'edit' => Pages\EditCopyRight::route('/{record}/edit'),
        ];
    }
}
