<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\BannerInfo;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BannerInfoResource\Pages;
use App\Filament\Resources\BannerInfoResource\RelationManagers;

class BannerInfoResource extends Resource
{
    protected static ?string $model = BannerInfo::class;

    protected static ?string $navigationGroup = 'Info';

    protected static ?string $navigationLabel = 'Banner Info';

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title_banner_info')->label('Title Banner Info :'),
                        FileUpload::make('banner_info')
                            ->label('Banner Info :')
                            ->image()
                            ->directory('uploads/banner_info')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=1476,height=350']) // Ubah format ke array
                            ->validationAttribute('Banner Info')
                            ->helperText('The image must be 1476x350 pixels.')
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
                TextColumn::make('title_banner_info')->searchable()->sortable(),
                ImageColumn::make('banner_info'),
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
            'index' => Pages\ListBannerInfos::route('/'),
            'create' => Pages\CreateBannerInfo::route('/create'),
            'edit' => Pages\EditBannerInfo::route('/{record}/edit'),
        ];
    }
}
