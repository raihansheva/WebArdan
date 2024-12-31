<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use function Laravel\Prompts\textarea;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\EventResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventResource\RelationManagers;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationLabel = 'Event';

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_event')
                            ->label('Nama Event:')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                                $set('slug', Str::slug($state));
                                $set('meta_title', $state);
                            })
                            ->maxLength(100)
                            ->required(),
                        FileUpload::make('image_event')
                            ->label('Image Event :')
                            ->image()
                            ->directory('uploads/images_event')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=864,height=500']) // Ubah format ke array
                            ->validationAttribute('Image Event')
                            ->helperText('The image must be 864x500 pixels.'),
                        DatePicker::make('date_event')->label('Date Event :')->required(),
                        DateTimePicker::make('time_countdown')->label('Time Countdown :')->required(),
                        Select::make('status')
                            ->label('Status Event :')
                            ->options([
                                'soon' => 'Soon',
                                'upcoming' => 'Upcoming',
                                'completed' => 'Completed',
                            ]),
                        Textarea::make('deskripsi_pendek')
                            ->label('Deskripsi Singkat :')
                            ->required(),
                        RichEditor::make('deskripsi_event')
                            ->label('Deksripsi Event :')
                            ->columnSpan(2),
                        TextInput::make('slug')
                            ->label('Slug :')
                            ->readOnly() // Menonaktifkan input manual karena slug dibuat otomatis
                            ->required(),
                        Toggle::make('has_ticket')
                            ->label('Ada Ticket?')
                            ->helperText('Aktifkan jika acara memiliki tiket.')
                            ->reactive()
                            ->required()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                // Reset nilai ticket_url saat toggle berubah
                                if (!$get('has_ticket')) {
                                    $set('ticket_url', null); // Kosongkan nilai jika toggle tidak aktif
                                }
                            }),
                        // Input ticket_url yang hanya muncul jika has_ticket dicentang
                        TextInput::make('ticket_url')
                            ->label('Link Ticket :')
                            ->placeholder('Masukan link pembelian tiket')
                            ->visible(fn(callable $get) => $get('has_ticket')) // Muncul hanya jika has_ticket == true
                            ->required(fn(callable $get) => $get('has_ticket')), // Wajib diisi hanya jika has_ticket == true
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
                                        // Jika "Publish Sekarang" dicentang, kosongkan "tanggal_publikasi"
                                        if ($state) {
                                            $set('tanggal_publikasi', null);
                                        }
                                    }),

                                DatePicker::make('tanggal_publikasi')
                                    ->label('Publish By Tanggal :')
                                    ->format('Y-m-d')
                                    ->visible(fn($get) => !$get('publish_now')) // Muncul hanya jika "Publish Sekarang" tidak dicentang
                                    ->required(fn($get) => !$get('publish_now')), // Wajib diisi jika "Publish Sekarang" tidak dicentang
                            ]),
                    ])->columnSpan(2),
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
                TextColumn::make('nama_event')->sortable(),
                ImageColumn::make('image_event'),
                TextColumn::make('deskripsi_pendek')->sortable(),
                TextColumn::make('deskripsi_event')
                    ->formatStateUsing(function ($state) {
                        return strip_tags($state); // Menghapus tag HTML
                    })->sortable(),
                TextColumn::make('date_event')->sortable(),
                IconColumn::make('publish_now') // Menggunakan IconColumn
                    ->boolean() // Secara otomatis mendukung true/false atau 1/0
                    ->trueIcon('heroicon-o-check-circle') // Ikon untuk nilai true
                    ->falseIcon('heroicon-o-x-circle')   // Ikon untuk nilai false
                    ->trueColor('success') // Warna ikon untuk true (hijau)
                    ->falseColor('danger'),
                TextColumn::make('tanggal_publikasi')->sortable(),
                TextColumn::make('time_countdown'),
                TextColumn::make('status')
                    ->color(fn($record) => match ($record->status) {
                        'soon' => 'warning',    // Merah untuk streaming
                        'upcoming' => 'danger',     // Oren untuk upcoming
                        'completed' => 'success',    // Hijau untuk completed
                        default => 'secondary',       // Warna default
                    }),
                TextColumn::make('slug'),
                TextColumn::make('meta_title')->sortable(),
                TextColumn::make('meta_description')->sortable(),
                TextColumn::make('meta_keywords')->sortable(),
                TextColumn::make('ticket_url'),
                IconColumn::make('has_ticket')
                    ->label('Ada Tiket?')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                Filter::make('nama_event')
                    ->form([
                        TextInput::make('nama_event')
                            ->label('Search : ')
                            ->placeholder('search')
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['nama_event'], function ($q, $namaEvent) {
                            $q->where('nama_event', 'like', '%' . $namaEvent . '%');
                        });
                    }),

                Filter::make('date_event')
                    ->form([
                        DatePicker::make('date_event')
                            ->label('Tanggal Event :')
                            ->placeholder('Pilih tanggal event...')
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['date_event'], function ($q, $dateEvent) {
                            $q->whereDate('date_event', $dateEvent);
                        });
                    }),

                Filter::make('tanggal_publikasi')
                    ->form([
                        DatePicker::make('tanggal_publikasi')
                            ->label('Tanggal Publikasi :')
                            ->placeholder('Pilih tanggal publikasi...')
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['tanggal_publikasi'], function ($q, $tanggalPublikasi) {
                            $q->whereDate('tanggal_publikasi', $tanggalPublikasi);
                        });
                    }),
                Filter::make('status')
                    ->form([
                        Select::make('status')
                            ->label('Status Event :')
                            ->placeholder('Pilih status...')
                            ->options([
                                'soon' => 'Soon',
                                'upcoming' => 'Upcoming',
                                'completed' => 'Completed',
                            ])
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['status'], function ($q, $status) {
                            $q->where('status', $status);
                        });
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
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
