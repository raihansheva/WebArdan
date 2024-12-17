<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BannerYoutube;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BannerYoutubeResource\Pages;
use App\Filament\Resources\BannerYoutubeResource\RelationManagers;

class BannerYoutubeResource extends Resource
{
    protected static ?string $model = BannerYoutube::class;

    protected static ?string $navigationGroup = 'Youtube';

    protected static ?string $navigationLabel = 'Banner Youtube';

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title_banner_youtube')->label('Title Banner Youtube :'),
                        FileUpload::make('banner_youtube')
                            ->label('Banner Youtube :')
                            ->image()
                            ->directory('uploads/images_youtube')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=1350,height=300']) // Ubah format ke array
                            ->validationAttribute('Youtube Image')
                            ->helperText('The image must be 1350x300 pixels.')
                    ])
                    ->columns(2),
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
                TextColumn::make('title_banner_youtube')->searchable()->sortable(),
                ImageColumn::make('banner_youtube'),
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
            'index' => Pages\ListBannerYoutubes::route('/'),
            'create' => Pages\CreateBannerYoutube::route('/create'),
            'edit' => Pages\EditBannerYoutube::route('/{record}/edit'),
        ];
    }
}
