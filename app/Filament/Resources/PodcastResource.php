<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Podcast;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PodcastResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PodcastResource\RelationManagers;

class PodcastResource extends Resource
{
    protected static ?string $model = Podcast::class;

    protected static ?string $navigationGroup = "Menu";

    protected static ?string $navigationLabel = 'Podcast';

    protected static ?string $navigationIcon = 'heroicon-o-microphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('judul_podcast')->label('Judul Podcast :')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                                $set('slug', Str::slug($state));
                            })
                            ->required(),
                        TextInput::make('genre_podcast')->label('Genre Podcast :')->required(),
                        Textarea::make('deskripsi_podcast')->label('Deskripsi Podcast :')
                            ->rows(5)->required(),
                        TextInput::make('eps_podcast')->label('Eps Podcast :')->required(),
                        FileUpload::make('image_podcast')
                            ->label('Podcast Image :')
                            ->image()
                            ->directory('uploads/images_podcast')
                            ->disk('public')
                            ->preserveFilenames(),
                        FileUpload::make('file')
                            ->label('File Podcast :')
                            ->image()
                            ->directory('uploads/file_podcast')
                            ->disk('public')
                            ->preserveFilenames(),
                        DatePicker::make('date_podcast')->label('Date Podcast :')->required(),
                        TextInput::make('link_podcast')->label('Link Podcast :')->required(),
                        TextInput::make('slug')
                            ->label('Slug :')
                            ->readOnly() // Menonaktifkan input manual karena slug dibuat otomatis
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul_podcast'),
                TextColumn::make('genre_podcast'),
                TextColumn::make('deskripsi_podcast'),
                TextColumn::make('eps_podcast'),
                ImageColumn::make('image_podcast'),
                TextColumn::make('date_podcast'),
                TextColumn::make('link_podcast'),
                TextColumn::make('file'),
                TextColumn::make('slug'),
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
            'index' => Pages\ListPodcasts::route('/'),
            'create' => Pages\CreatePodcast::route('/create'),
            'edit' => Pages\EditPodcast::route('/{record}/edit'),
        ];
    }
}
