<?php

namespace App\Filament\Resources;

use App\Models\Kategori;
use Filament\Forms;
use Filament\Tables;
use App\Models\Chart;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ChartResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ChartResource\RelationManagers;

class ChartResource extends Resource
{
    protected static ?string $model = Chart::class;

    protected static ?string $navigationGroup = 'Chart';

    protected static ?string $navigationLabel = 'Chart';

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')->label('Name :'),
                        TextInput::make('link_audio')->label('Link Audio :'),
                        Select::make('kategori_id')
                            ->label('Kategori')
                            ->options(Kategori::all()->pluck('nama_kategori', 'id')) // Mengambil data kategori
                            ->required(), 
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('link_audio'),
                TextColumn::make('kategori.nama_kategori'),
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
            'index' => Pages\ListCharts::route('/'),
            'create' => Pages\CreateChart::route('/create'),
            'edit' => Pages\EditChart::route('/{record}/edit'),
        ];
    }
}
