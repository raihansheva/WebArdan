<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Chart;
use App\Models\Kategori;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ChartResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ChartResource\RelationManagers;
use Filament\Actions\ActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;

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
                        Select::make('kategori_id')
                            ->label('Kategori :')
                            ->options(Kategori::all()->pluck('nama_kategori', 'id')) // Mengambil data kategori
                            ->required(),
                    ])
                    ->columns(1),
                Card::make()
                    ->schema([
                        Repeater::make('songs')
                            ->label('Pilih Lagu :')
                            ->schema([
                                TextInput::make('name')->label('Nama Lagu : ')->required(),
                                FileUpload::make('link_audio')
                                    ->label('Audio File : ')
                                    ->preserveFilenames()
                                    ->directory('audioChart')
                                    ->acceptedFileTypes(['audio/mpeg'])
                                    ->required(),
                            ])->columns(2)
                            ->defaultItems(1)
                            ->minItems(1)
                            ->required(),
                    ])
                    ->columns(1),
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
                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Artis')
                    ->sortable(),
                TextColumn::make('link_audio')
                    ->label('File Audio')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('search')
                    ->form([
                        Forms\Components\TextInput::make('query')
                            ->label('Search :')
                            ->placeholder('Search'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['query'] ?? null,
                                fn($query, $searchTerm) =>
                                $query->where(function ($query) use ($searchTerm) {
                                    $lowerSearchTerm = strtolower($searchTerm); // Ubah input pencarian menjadi lowercase
                                    $query->whereRaw('LOWER(name) LIKE ?', ["%{$lowerSearchTerm}%"])
                                        ->orWhereHas(
                                            'kategori',
                                            fn($query) =>
                                            $query->whereRaw('LOWER(nama_kategori) LIKE ?', ["%{$lowerSearchTerm}%"])
                                        );
                                })
                            );
                    }),
                Tables\Filters\SelectFilter::make('kategori_id')
                    ->label('Kategori :')
                    ->options(Kategori::all()->pluck('nama_kategori', 'id'))
            ], layout: FiltersLayout::AboveContent)
            ->headerActions([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Edit Chart')
                    ->modalButton('Simpan'),
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
