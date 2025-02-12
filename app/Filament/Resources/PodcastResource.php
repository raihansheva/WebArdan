<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PodcastResource\Pages;
use App\Models\Podcast;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PodcastResource extends Resource
{
    protected static ?string $model = Podcast::class;

    protected static ?string $navigationGroup = 'Podcast';

    protected static ?string $navigationLabel = 'Podcast';

    protected static ?string $navigationIcon = 'heroicon-o-microphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Bagian utama
                Card::make()
                    ->schema([
                        TextInput::make('judul_podcast')->label('Judul Podcast :')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                                $set('slug', Str::slug($state));
                                $set('meta_title', $state);
                            })
                            ->required(),
                        TagsInput::make('genre_podcast')
                            ->label('Genre Podcast :')
                            ->required(),
                        FileUpload::make('image_podcast')
                            ->label('Podcast Image :')
                            ->image()
                            ->directory('uploads/images_podcast')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules([
                                'required',
                                'image',
                                'dimensions:max_width=1920,max_height=1080', // Atur maksimal width dan height di sini
                                'dimensions:min_width=800,min_height=450' // Atur maksimal width dan height di sini
                            ])
                            ->validationAttribute('Image Event')
                            ->helperText('The image must have min 800x450 pixel, max dimensions 1920x1080'),
                        // FileUpload::make('file')
                        //     ->label('Upload File') // Maksimal ukuran file (dalam KB)
                        //     ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav'])
                        //     ->directory('audioPodcast')
                        //     ->preserveFilenames(),
                        DatePicker::make('date_podcast')->label('Date Podcast :')->required(),
                        // TextInput::make('link_podcast')->label('Link Podcast :')->required(),
                        TextInput::make('slug')
                            ->label('Slug :')
                            ->readOnly()
                            ->required(),
                        Toggle::make('is_highlight')
                            ->label('Highlight')
                            ->onColor('success') // Optional: Mengatur warna saat toggle aktif
                            ->offColor('danger') // Optional: Mengatur warna saat toggle tidak aktif
                            ->default(false),
                        Toggle::make('is_episode')
                            ->label('Tambah episode?')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                if ($get('is_episode')) {
                                    $set('episode_number', null);
                                    $set('podcast_id', null);
                                } else {
                                    $set('episode_number', null);
                                    $set('podcast_id', null);
                                }
                            }),
                        TextInput::make('episode_number')
                            ->numeric()
                            ->nullable()
                            ->label('Nomor Episode')
                            ->visible(fn(callable $get) => $get('is_episode')),
                        Select::make('podcast_id')
                            ->label('Pilih Podcast')
                            ->relationship('podcasts', 'judul_podcast')
                            ->visible(fn(callable $get) => $get('is_episode'))
                            ->required(),
                        RichEditor::make('deskripsi_podcast')
                            ->label('Deskripsi Podcast :')
                            ->required()
                            ->columnSpan(2),
                    ])
                    ->columns(2), // Membuat Card utama memiliki 2 kolom

                // Bagian Grid kedua
                Grid::make(2) // Tetapkan Grid memiliki 2 kolom
                    ->schema([
                        Card::make('File / Link Video , File Audio')
                            ->schema([
                                TextInput::make('link_podcast')
                                    ->label('Link Podcast :')
                                    ->live()
                                    ->reactive()
                                    ->disabled(
                                        fn(Get $get, Set $set, $record) =>
                                        blank($record?->link_podcast) && (filled($get('link_youtube')) || filled($get('file_video')))
                                    )
                                    ->placeholder(
                                        fn(Get $get) =>
                                        filled($get('link_youtube')) ? 'Tidak bisa memasukkan URL karena sudah ada URL di Link Youtube'
                                            : (filled($get('file_video')) ? 'Tidak bisa memasukkan URL karena sudah ada File Video'
                                                : 'Masukkan Link Podcast')
                                    ),

                                FileUpload::make('file')
                                    ->label('Upload File Audio :')
                                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav'])
                                    ->directory('audioPodcast')
                                    ->preserveFilenames()
                                    ->reactive(),

                                TextInput::make('link_youtube')
                                    ->label('Link Youtube :')
                                    ->live()
                                    ->reactive()
                                    ->disabled(
                                        fn(Get $get, Set $set, $record) =>
                                        blank($record?->link_youtube) && (filled($get('link_podcast')) || filled($get('file_video')))
                                    )
                                    ->placeholder(
                                        fn(Get $get) =>
                                        filled($get('link_podcast')) ? 'Tidak bisa memasukkan URL karena sudah ada URL di Link Podcast'
                                            : (filled($get('file_video')) ? 'Tidak bisa memasukkan URL karena sudah ada File Video'
                                                : 'Masukkan Link Youtube')
                                    ),

                                FileUpload::make('file_video')
                                    ->label('Upload File Video :')
                                    ->acceptedFileTypes(['video/mp4'])
                                    ->directory('videoPodcast')
                                    ->preserveFilenames()
                                    ->live()
                                    ->reactive()
                                    ->nullable() // Memastikan bisa bernilai null
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        if (blank($state)) { // Jika dihapus (tekan "X")
                                            $set('file_video', null); // Set jadi null di form
                                        }
                                    })
                                    ->dehydrated(fn($state) => filled($state))
                                    ->hidden( // Gunakan hidden agar elemen hilang
                                        fn(Get $get) =>
                                        filled($get('link_podcast')) || filled($get('link_youtube'))
                                    ), // Hanya kirim jika ada file baru
                            ])->columns(2),

                    ])->columnSpan(2),

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
                TextColumn::make('judul_podcast')->sortable(),
                TextColumn::make('genre_podcast')->sortable(),
                TextColumn::make('deskripsi_podcast')
                    ->formatStateUsing(function ($state) {
                        return strip_tags($state); // Menghapus tag HTML
                    }),
                ImageColumn::make('image_podcast'),
                TextColumn::make('date_podcast')->sortable(),
                IconColumn::make('publish_now') // Menggunakan IconColumn
                    ->boolean() // Secara otomatis mendukung true/false atau 1/0
                    ->trueIcon('heroicon-o-check-circle') // Ikon untuk nilai true
                    ->falseIcon('heroicon-o-x-circle')   // Ikon untuk nilai false
                    ->trueColor('success') // Warna ikon untuk true (hijau)
                    ->falseColor('danger'),
                TextColumn::make('is_highlight')
                    ->label('Highlight')
                    ->getStateUsing(function ($record) {
                        return $record->trending ? 'Highlight' : '-';
                    }),
                TextColumn::make('tanggal_publikasi')->sortable(),
                TextColumn::make('link_podcast'),
                TextColumn::make('link_youtube'),
                TextColumn::make('file'),
                TextColumn::make('file_video'),
                TextColumn::make('slug'),
                IconColumn::make('is_episode')
                    ->label('Ada Episode?')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                // Menampilkan episode yang terkait
                TextColumn::make('episode_number'),
                TextColumn::make('meta_title')->sortable(),
                TextColumn::make('meta_description')->sortable(),
                TextColumn::make('meta_keywords')->sortable(),
            ])
            ->filters([
                // Filter gabungan untuk judul_podcast, genre_podcast, dan date_podcast
                Tables\Filters\Filter::make('search_filter')
                    ->form([
                        TextInput::make('search_input')
                            ->label('Search :')
                            ->placeholder('search')
                            ->required(false),
                    ])
                    ->query(function ($query, array $data) {
                        if (!empty($data['search_input'])) {
                            $searchTerm = strtolower($data['search_input']); // Ubah input pencarian menjadi lowercase
                            $query->where(function ($query) use ($searchTerm) {
                                $query->whereRaw('LOWER(judul_podcast) LIKE ?', ['%' . $searchTerm . '%'])
                                    ->orWhereRaw('LOWER(genre_podcast) LIKE ?', ['%' . $searchTerm . '%'])
                                    ->orWhereRaw('LOWER(date_podcast) LIKE ?', ['%' . $searchTerm . '%']); // Pencarian case-insensitive
                            });
                        }
                        return $query;
                    }),
                // Filter untuk date_podcast
                Tables\Filters\Filter::make('date_podcast_filter')
                    ->form([
                        DatePicker::make('date_podcast')
                            ->label('Tanggal Podcast :')
                            ->placeholder('Pilih Tanggal Podcast'),
                    ])
                    ->query(function ($query, array $data) {
                        if (!empty($data['date_podcast'])) {
                            $query->whereDate('date_podcast', Carbon::parse($data['date_podcast'])->toDateString());
                        }
                        return $query;
                    }),
                // Filter untuk tanggal_publikasi
                Tables\Filters\Filter::make('tanggal_publikasi_filter')
                    ->form([
                        DatePicker::make('tanggal_publikasi')
                            ->label('Tanggal Publikasi :')
                            ->placeholder('Pilih Tanggal Publikasi'),
                    ])
                    ->query(function ($query, array $data) {
                        if (!empty($data['tanggal_publikasi'])) {
                            $query->whereDate('tanggal_publikasi', Carbon::parse($data['tanggal_publikasi'])->toDateString());
                        }
                        return $query;
                    }),
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
            'index' => Pages\ListPodcasts::route('/'),
            'create' => Pages\CreatePodcast::route('/create'),
            'edit' => Pages\EditPodcast::route('/{record}/edit'),
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
