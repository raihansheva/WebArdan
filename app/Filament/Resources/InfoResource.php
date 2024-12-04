<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfoResource\Pages;
use App\Models\Info;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

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
                            })
                            ->required(),
                        // Select::make('tag_info_id')
                        //     ->label('Tag Info')
                        //     ->relationship('tagInfo', 'nama_tag') // Menggunakan nama tag
                        //     ->required(),
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
                        Toggle::make('top_news')
                            ->label('Top News')
                            ->onColor('success') // Optional: Mengatur warna saat toggle aktif
                            ->offColor('danger') // Optional: Mengatur warna saat toggle tidak aktif
                            ->default(false), // Defa
                        RichEditor::make('deskripsi_info')
                            ->label('Deskripsi Info :')
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
                TextColumn::make('judul_info')->searchable(),
                TextColumn::make('tag_info')->label('Tag Info'),
                TextColumn::make('deskripsi_info')
                    ->formatStateUsing(function ($state) {
                        return strip_tags($state); // Menghapus tag HTML
                    }),
                ImageColumn::make('image_info'),
                TextColumn::make('date_info'),
                TextColumn::make('slug'),
                TextColumn::make('top_news')
                    ->label('Top News')
                    ->getStateUsing(function ($record) {
                        return $record->top_news ? 'Top-News' : '-';
                    }),
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
            'index' => Pages\ListInfos::route('/'),
            'create' => Pages\CreateInfo::route('/create'),
            'edit' => Pages\EditInfo::route('/{record}/edit'),
        ];
    }
}
