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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
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
                TextColumn::make('nama_event'),
                ImageColumn::make('image_event'),
                TextColumn::make('deskripsi_pendek'),
                TextColumn::make('deskripsi_event')
                    ->formatStateUsing(function ($state) {
                        return strip_tags($state); // Menghapus tag HTML
                    }),
                TextColumn::make('date_event')->searchable()->sortable(),
                TextColumn::make('time_countdown'),
                TextColumn::make('status')
                    ->color(fn($record) => match ($record->status) {
                        'soon' => 'warning',    // Merah untuk streaming
                        'upcoming' => 'danger',     // Oren untuk upcoming
                        'completed' => 'success',    // Hijau untuk completed
                        default => 'secondary',       // Warna default
                    }),
                TextColumn::make('slug'),
                TextColumn::make('meta_title'),
                TextColumn::make('meta_description'),
                TextColumn::make('meta_keywords'),
                TextColumn::make('ticket_url'),
                IconColumn::make('has_ticket')
                    ->label('Ada Tiket?')
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
