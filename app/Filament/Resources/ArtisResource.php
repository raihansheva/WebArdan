<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtisResource\Pages;
use App\Models\Artis;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class ArtisResource extends Resource
{
    protected static ?string $model = Artis::class;

    protected static ?string $navigationGroup = 'Info';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama')->label('Nama Artis :'),
                        Select::make('kategori_info')
                            ->label('Kategori Info :')
                            ->options([
                                'info_artis' => 'Info Artis', // key => value
                            ])
                            ->required(),
                        FileUpload::make('image_artis')
                            ->label('Artis Image :')
                            ->image()
                            ->directory('uploads/images_artis')
                            ->disk('public')
                            ->preserveFilenames(),
                        TextInput::make('judul_berita')
                            ->label('Judul Berita')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, string $state, Set $set) {
                                $set('slug', Str::slug($state));
                                $set('meta_title', $state);
                            })
                            ->required(),
                        TextInput::make('slug')
                            ->label('Slug :')
                            ->readOnly() // Menonaktifkan input manual karena slug dibuat otomatis
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
                Card::make()
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Title Info :')
                            ->placeholder('Masukan meta title') // Menambahkan placeholder untuk panduan input
                            ->maxLength(100)
                            ->required(),
                        Textarea::make('meta_description')
                            ->label('Description Info :')
                            ->placeholder('Masukan meta description')
                            ->required(),
                        TextInput::make('meta_keywords')
                            ->label('Keyword :')
                            ->placeholder('Masukan meta keyword')
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
                TextColumn::make('nama')->searchable()->sortable(),
                TextColumn::make('kategori_info'),
                ImageColumn::make('image_artis'),
                TextColumn::make('judul_berita'),
                TextColumn::make('slug'),
                TextColumn::make('ringkasan_berita'),
                TextColumn::make('konten_berita')
                    ->formatStateUsing(function ($state) {
                        return strip_tags($state); // Menghapus tag HTML
                    }),
                IconColumn::make('publish_sekarang') // Menggunakan IconColumn
                    ->boolean() // Secara otomatis mendukung true/false atau 1/0
                    ->trueIcon('heroicon-o-check-circle') // Ikon untuk nilai true
                    ->falseIcon('heroicon-o-x-circle')   // Ikon untuk nilai false
                    ->trueColor('success') // Warna ikon untuk true (hijau)
                    ->falseColor('danger'),
                TextColumn::make('tanggal_dibuat'),
                TextColumn::make('tanggal_publikasi'),
                TextColumn::make('meta_title'),
                TextColumn::make('meta_description'),
                TextColumn::make('meta_keywords'),
            ])
            ->filters([
                Filter::make('published')
                    ->query(fn(Builder $query) => $query->where('publish_sekarang', true)
                        ->orWhere(function (Builder $query) {
                            $query->whereNotNull('tanggal_publikasi')
                                ->where('tanggal_publikasi', '<=', now());
                        }))
                    ->label('Published'),
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

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['publish_sekarang']) {
            $data['tanggal_publikasi'] = now(); // Jika publish sekarang, isi tanggal_publikasi dengan waktu saat ini
        }

        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['publish_sekarang']) {
            $data['tanggal_publikasi'] = now(); // Memastikan logika sama saat data diupdate
        }

        return $data;
    }
}
