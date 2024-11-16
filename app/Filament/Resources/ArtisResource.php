<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtisResource\Pages;
use App\Models\Artis;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArtisResource extends Resource
{
    protected static ?string $model = Artis::class;

    protected static ?string $navigationGroup = 'Chart';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama'),
                        Textarea::make('bio'),
                        FileUpload::make('image_artis')
                            ->label('Artis Image :')
                            ->image()
                            ->directory('uploads/images_artis')
                            ->disk('public')
                            ->preserveFilenames(),
                        TextInput::make('judul_berita')
                            ->label('Judul Berita')
                            ->required(),
                        Textarea::make('ringkasan_berita')
                            ->label('Ringkasan Berita :')
                            ->maxLength(200)
                            ->rows(4),
                        Checkbox::make('publish_sekarang')
                            ->label('Publish Sekarang')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $get, $set) {
                                // Jika publish_sekarang true, set tanggal_dibuat ke tanggal saat ini
                                if ($state) {
                                    $set('tanggal_dibuat', now('UTC')->toDateString()); // Set tanggal_dibuat ke tanggal sekarang
                                } else {
                                    // Jika publish_sekarang false, kosongkan tanggal_dibuat
                                    $set('tanggal_dibuat', null);
                                }
                            }),
                        DatePicker::make('tanggal_dibuat')
                            ->label('Tanggal Dibuat :')
                            ->format('Y-m-d'),
                        DatePicker::make('tanggal_publikasi')
                            ->label('Publish By Tanggal :')
                            ->format('Y-m-d')
                            ->visible(fn($get) => !$get('publish_sekarang')) // Hanya muncul jika "Publish Sekarang" tidak dicentang
                            ->required(fn($get) => !$get('publish_sekarang')),
                        RichEditor::make('konten_berita')
                            ->label('Konten Berita')
                            ->required()
                            ->columnSpan(2),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable()->sortable(),
                TextColumn::make('bio'),
                ImageColumn::make('image_artis'),
                TextColumn::make('judul_berita'),
                TextColumn::make('ringkasan_berita'),
                TextColumn::make('konten_berita'),
                TextColumn::make('publish_sekarang'),
                TextColumn::make('tanggal_dibuat'),
                TextColumn::make('tanggal_publikasi'),
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
            'index' => Pages\ListArtis::route('/'),
            'create' => Pages\CreateArtis::route('/create'),
            'edit' => Pages\EditArtis::route('/{record}/edit'),
        ];
    }
}
