<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BannerPodcast;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BannerPodcastResource\Pages;
use App\Filament\Resources\BannerPodcastResource\RelationManagers;

class BannerPodcastResource extends Resource
{
    protected static ?string $model = BannerPodcast::class;

    protected static ?string $navigationGroup = 'Podcast';

    protected static ?string $navigationLabel = 'Banner Podcast';

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title_banner_podcast')->label('Title Banner Podcast :'),
                        FileUpload::make('banner_podcast')
                            ->label('Banner Podcast :')
                            ->image()
                            ->directory('uploads/banner_podcast')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=1476,height=500']) // Ubah format ke array
                            ->validationAttribute('Stream Image')
                            ->helperText('The image must be 1476x500 pixels.')
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
                TextColumn::make('title_banner_podcast')->searchable()->sortable(),
                ImageColumn::make('banner_podcast'),
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
            'index' => Pages\ListBannerPodcasts::route('/'),
            'create' => Pages\CreateBannerPodcast::route('/create'),
            'edit' => Pages\EditBannerPodcast::route('/{record}/edit'),
        ];
    }
}
