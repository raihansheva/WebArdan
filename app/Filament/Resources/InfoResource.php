<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfoResource\Pages;
use App\Models\Info;
use App\Models\Kategori;
use App\Models\TagInfo;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\TrixEditor;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Enums\FiltersLayout;

class InfoResource extends Resource
{
    protected static ?string $model = Info::class;

    protected static ?string $navigationGroup = 'Info';

    protected static ?string $navigationLabel = 'Info';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('judul_info')->label('Judul Info :')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                                $set('slug', Str::slug($state));
                                $set('meta_title', $state);
                            })
                            ->required(),
                        // Select::make('tag_info_id')
                        //     ->label('Tag Info')
                        //     ->relationship('tagInfo', 'nama_tag') // Menggunakan nama tag
                        //     ->required(),
                        Select::make('kategori_id')
                            ->label('Kategori Info :')
                            ->options(TagInfo::all()->pluck('nama_kategori', 'id')) // Mengambil data kategori
                            ->required(),
                        TagsInput::make('tag_info')
                            ->label('Tag Info')
                            ->required(),
                        FileUpload::make('image_info')
                            ->label('Info Image :')
                            ->directory('uploads/images_info')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=256,height=165']) // Ubah format ke array
                            ->validationAttribute('Image Event')
                            ->helperText('The image must be 256x165 pixels.'),
                        DatePicker::make('date_info')
                            ->label('Info Date :')
                            ->required()
                            ->displayFormat('Y-m-d') // Format tampilan tanggal
                            ->firstDayOfWeek(1), // Menentukan hari pertama minggu (1 = Senin)
                        TextInput::make('slug')
                            ->label('Slug :')
                            ->readOnly() // Menonaktifkan input manual karena slug dibuat otomatis
                            ->required(),
                        Grid::make(2) // Membuat Grid dengan 2 kolom
                            ->schema([
                                Toggle::make('top_news')
                                    ->label('Top News')
                                    ->onColor('success') // Optional: Mengatur warna saat toggle aktif
                                    ->offColor('danger') // Optional: Mengatur warna saat toggle tidak aktif
                                    ->default(false), // Default: tidak aktif
                                Toggle::make('trending')
                                    ->label('Trending')
                                    ->onColor('success') // Optional: Mengatur warna saat toggle aktif
                                    ->offColor('danger') // Optional: Mengatur warna saat toggle tidak aktif
                                    ->default(false), // Default: tidak aktif
                            ]),
                        RichEditor::make('deskripsi_info')
                            ->label('Deskripsi Info :')
                            ->fileAttachmentsDisk('public') // Menyimpan file di disk 'public'
                            ->fileAttachmentsDirectory('info') // File akan disimpan di folder 'info' dalam 'public'
                            ->fileAttachmentsVisibility('public')
                            ->required()
                            ->columnSpan(2),

                    ])
                    ->columns(2),
                Grid::make(2) // Tetapkan Grid memiliki 2 kolom
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Title Info :')
                                    ->placeholder('Masukan meta title')
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
                            ]),
                        Card::make()
                            ->schema([
                                Checkbox::make('publish_now')
                                    ->label('Publish Sekarang')
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, $get, $set) {
                                        // Jika publish_sekarang true, set tanggal_dibuat ke tanggal saat ini
                                        if ($state) {
                                            $set('date_podcast', now('UTC')->toDateString()); // Set tanggal_dibuat ke tanggal sekarang
                                        } else {
                                            // Jika publish_sekarang false, kosongkan tanggal_dibuat
                                            $set('date_podcast', null);
                                        }
                                    }),
                                DatePicker::make('tanggal_publikasi')
                                    ->label('Publish By Tanggal :')
                                    ->format('Y-m-d')
                                    ->visible(fn($get) => !$get('publish_now')) // Hanya muncul jika "Publish Sekarang" tidak dicentang
                                    ->required(fn($get) => !$get('publish_now')),
                            ]),
                    ])->columnSpan(3),
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
                TextColumn::make('judul_info')
                    ->sortable(),
                TextColumn::make('tagInfo.nama_kategori')
                    ->label('Kategori')
                    ->sortable(),
                TextColumn::make('tag_info')
                    ->label('Tag Info')
                    ->sortable(),
                TextColumn::make('deskripsi_info')
                    ->formatStateUsing(function ($state) {
                        return strip_tags($state); // Menghapus tag HTML
                    })
                    ->sortable(),
                ImageColumn::make('image_info'),
                TextColumn::make('date_info')
                    ->sortable(),
                IconColumn::make('publish_now') // Menggunakan IconColumn
                    ->boolean() // Secara otomatis mendukung true/false atau 1/0
                    ->trueIcon('heroicon-o-check-circle') // Ikon untuk nilai true
                    ->falseIcon('heroicon-o-x-circle')   // Ikon untuk nilai false
                    ->trueColor('success') // Warna ikon untuk true (hijau)
                    ->falseColor('danger'),
                TextColumn::make('tanggal_publikasi')->sortable(),
                TextColumn::make('slug')->sortable(),
                TextColumn::make('top_news')
                    ->label('Top News')
                    ->getStateUsing(function ($record) {
                        return $record->top_news ? 'Top-News' : '-';
                    }),
                TextColumn::make('trending')
                    ->label('Trending')
                    ->getStateUsing(function ($record) {
                        return $record->trending ? 'Trending' : '-';
                    }),
                TextColumn::make('meta_title')
                    ->sortable(),
                TextColumn::make('meta_description')
                    ->sortable(),
                TextColumn::make('meta_keywords')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('search')
                    ->form([
                        Forms\Components\TextInput::make('query')
                            ->label('Search :')
                            ->placeholder('search'),
                    ])
                    ->columnspan(1) // Mengambil semua kategori untuk opsi
                    ->query(function ($query, array $data) {
                        return $query->when($data['query'] ?? null, fn($query, $searchTerm) =>
                            $query->where(function ($query) use ($searchTerm) {
                                $query->whereRaw('LOWER(judul_info) LIKE ?', ['%' . strtolower($searchTerm) . '%']) // Mencari di judul_info
                                    ->orWhereHas('tagInfo', function ($query) use ($searchTerm) {
                                        $query->whereRaw('LOWER(nama_kategori) LIKE ?', ['%' . strtolower($searchTerm) . '%']); // Mencari di kategori
                                    })
                                    ->orWhereRaw('LOWER(tag_info) LIKE ?', ['%' . strtolower($searchTerm) . '%']); // Mencari di tag_info string
                            })
                        );
                    }),
                Tables\Filters\SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->options(TagInfo::all()->pluck('nama_kategori', 'id'))
                    ->columnspan(1), // Mengambil semua kategori untuk opsi
                // Filter tanggal
                // Filter untuk Tanggal Info
                Tables\Filters\Filter::make('date_info_filter')
                    ->form([
                        Forms\Components\DatePicker::make('date_info')
                            ->label('Tanggal Info :')
                            ->placeholder('Pilih Tanggal Info')
                            ->required(false), // Tidak wajib diisi
                    ])
                    ->columnspan(1)
                    ->query(function ($query, array $data) {
                        if (!empty($data['date_info'])) {
                            $query->whereDate('date_info', Carbon::parse($data['date_info'])->toDateString());
                        }
                        return $query;
                    }),

                // Filter untuk Tanggal Publikasi
                Tables\Filters\Filter::make('tanggal_publikasi_filter')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_publikasi')
                            ->label('Tanggal Publikasi :')
                            ->placeholder('Pilih Tanggal Publikasi')
                            ->required(false), // Tidak wajib diisi
                    ])
                    ->columnspan(1)
                    ->query(function ($query, array $data) {
                        if (!empty($data['tanggal_publikasi'])) {
                            $query->whereDate('tanggal_publikasi', Carbon::parse($data['tanggal_publikasi'])->toDateString());
                        }
                        return $query;
                    })

            ], layout: FiltersLayout::AboveContent)
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
            'index' => Pages\ListInfos::route('/'),
            'create' => Pages\CreateInfo::route('/create'),
            'edit' => Pages\EditInfo::route('/{record}/edit'),
        ];
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['publish_now']) {
            $data['tanggal_publikasi'] = now(); // Jika publish sekarang, isi tanggal_publikasi dengan waktu saat ini
        }

        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['publish_now']) {
            $data['tanggal_publikasi'] = now(); // Memastikan logika sama saat data diupdate
        }

        return $data;
    }
}
