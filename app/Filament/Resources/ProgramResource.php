<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationLabel = 'Program';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('judul_program')->label('Nama Program :')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, string $state, Set $set) {
                                $set('slug', Str::slug($state));
                                $set('meta_title', $state);
                            })->required(),
                        Textarea::make('deskripsi_pendek')->label('Deskripsi Singkat :')->required(),
                        TextInput::make('slug')->label('Slug :')
                            ->readOnly()
                            ->required(),
                        FileUpload::make('image_program')
                            ->label('Program Image :')
                            ->image()
                            ->directory('uploads/images_program')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=322,height=313']) // Ubah format ke array
                            ->validationAttribute('Image Event')
                            ->helperText('The image must be 322x313 pixels.'),
                        TimePicker::make('jam_mulai')
                            ->label('Jam Mulai')
                            ->required()
                            ->format('H:i'),
                        TimePicker::make('jam_selesai')
                            ->label('Jam Selesai')
                            ->required()
                            ->format('H:i')
                            ->rule('after:jam_mulai'),
                        RichEditor::make('deskripsi_program')
                            ->label('Deskripsi Program :')
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
                TextColumn::make('judul_program')->searchable()->sortable(),
                TextColumn::make('deskripsi_pendek'),
                TextColumn::make('deskripsi_program')
                    ->formatStateUsing(function ($state) {
                        return strip_tags($state); // Menghapus tag HTML
                    }),
                TextColumn::make('slug'),
                TextColumn::make('jam_mulai')
                    ->label('Jam Mulai'),
                TextColumn::make('jam_selesai')
                    ->label('Jam Selesai'),
                ImageColumn::make('image_program'),
                IconColumn::make('publish_now') // Menggunakan IconColumn
                    ->boolean() // Secara otomatis mendukung true/false atau 1/0
                    ->trueIcon('heroicon-o-check-circle') // Ikon untuk nilai true
                    ->falseIcon('heroicon-o-x-circle')   // Ikon untuk nilai false
                    ->trueColor('success') // Warna ikon untuk true (hijau)
                    ->falseColor('danger'),
                TextColumn::make('tanggal_publikasi')->searchable()->sortable(),
                TextColumn::make('meta_title'),
                TextColumn::make('meta_description'),
                TextColumn::make('meta_keywords')
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
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
