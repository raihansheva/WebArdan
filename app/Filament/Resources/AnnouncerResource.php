<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Announcer;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\AnnouncerResource\Pages;

class AnnouncerResource extends Resource
{
    protected static ?string $model = Announcer::class;

    protected static ?string $navigationGroup = "Menu";

    protected static ?string $navigationLabel = 'Announcer';

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function form(Form $form): Form
    {
        return $form
    ->schema([
        Card::make()
            ->schema([
                TextInput::make('name_announcer')->label('Name Announcer :')
                ->columnSpan(2)
                ->required(),
                TextInput::make('link_instagram')->label('Link Instagram :')
                ->columnSpan(2),
                TextInput::make('link_tiktok')->label('Link TikTok :')
                ->columnSpan(2),
                TextInput::make('link_twitter')->label('Link Twitter :')
                ->columnSpan(2),
                FileUpload::make('image_announcer')
                    ->label('Announcer Image')
                    ->image()
                    ->directory('uploads/images_announcer')
                    ->disk('public')
                    ->preserveFilenames()
                    ->rules(['required', 'image', 'dimensions:width=254,height=300'])
                    ->validationAttribute('Image Announcer')
                    ->helperText('The image must be 254x300 pixels.')
                    ->columnSpan(2),
                // RichEditor di bagian paling bawah dan lebar penuh
                RichEditor::make('bio')
                    ->label('Bio :')
                    ->required()
                    ->columnSpan(2), // Membuat RichEditor lebar penuh (full width)
            ])
            ->columns(1), // Menentukan bahwa form menggunakan 2 kolom
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
                TextColumn::make('name_announcer')->searchable()->sortable(),
                ImageColumn::make('image_announcer'),
                TextColumn::make('link_instagram'),
                TextColumn::make('link_tiktok'),
                TextColumn::make('link_twitter'),
                TextColumn::make('bio')->label('Bio')
                ->formatStateUsing(function ($state) {
                    return strip_tags($state); // Menghapus tag HTML
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
            'index' => Pages\ListAnnouncers::route('/'),
            'create' => Pages\CreateAnnouncer::route('/create'),
            'edit' => Pages\EditAnnouncer::route('/{record}/edit'),
        ];
    }
}
