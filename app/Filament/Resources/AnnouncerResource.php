<?php

namespace App\Filament\Resources;

use Filament\Forms;
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
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AnnouncerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AnnouncerResource\RelationManagers;

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
                        TextInput::make('name_announcer')->label('Name Announcer :')->required(),
                        FileUpload::make('image_announcer')
                            ->label('Announcer Image')
                            ->image()
                            ->directory('uploads/images_announcer')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=254,height=300']) // Ubah format ke array
                            ->validationAttribute('Image Announcer')
                            ->helperText('The image must be 254x300 pixels.'),
                        TextInput::make('link_instagram')->label('Link Instagram :'),
                        TextInput::make('link_facebook')->label('Link Facebook :'),
                        TextInput::make('link_twitter')->label('Link Twitter :'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_announcer')->searchable()->sortable(),
                ImageColumn::make('image_announcer'),
                TextColumn::make('link_instagram'),
                TextColumn::make('link_facebook'),
                TextColumn::make('link_twitter'),
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
