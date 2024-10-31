<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Artis;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ArtisResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArtisResource\RelationManagers;

class ArtisResource extends Resource
{
    protected static ?string $model = Artis::class;

    protected static ?string $navigationGroup = 'Chart';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama'),
                        Textarea::make('bio'),
                        FileUpload::make('image_artis')
                            ->label('Artis Image :')
                            ->image()
                            ->directory('uploads/images_artis')
                            ->disk('public')
                            ->preserveFilenames(),
                            // ->rules(['required', 'image', 'dimensions:width=1350,height=250'])
                            // ->helperText('The image must be 1350x250 pixels.')
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable()->sortable(),
                TextColumn::make('bio'),
                ImageColumn::make('image_artis'),
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
            'index' => Pages\ListArtis::route('/'),
            'create' => Pages\CreateArtis::route('/create'),
            'edit' => Pages\EditArtis::route('/{record}/edit'),
        ];
    }
}
