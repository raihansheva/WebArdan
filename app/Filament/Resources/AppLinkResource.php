<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\AppLink;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AppLinkResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AppLinkResource\RelationManagers;

class AppLinkResource extends Resource
{
    protected static ?string $model = AppLink::class;

    protected static ?string $navigationGroup = 'Footer';

    protected static ?string $navigationLabel = 'App Link';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('platform_name'),
                        TextInput::make('app_name'),
                        FileUpload::make('app_image')
                        ->label('BApp Image :')
                        ->image()
                        ->directory('uploads/images_app')
                        ->disk('public')
                        ->preserveFilenames(),
                        // ->rules(['required', 'image', 'dimensions:width=1476,height=350']) // Ubah format ke array
                        // ->validationAttribute('Banner Info')
                        // ->helperText('The image must be 1476x350 pixels.'),
                        TextInput::make('link_app'),
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
                TextColumn::make('platform_name')->searchable()->sortable(),
                TextColumn::make('app_name'),
                ImageColumn::make('app_image'),
                ImageColumn::make('link_app'),
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
            'index' => Pages\ListAppLinks::route('/'),
            'create' => Pages\CreateAppLink::route('/create'),
            'edit' => Pages\EditAppLink::route('/{record}/edit'),
        ];
    }
}
