<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Config';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('key')
                            ->label('Config Key')
                            ->disabled()
                            ->required(),
                        TextInput::make('value')
                            ->label('Config Value'),
                        FileUpload::make('value')  // Untuk input file logo
                            ->label('Site Logo')
                            ->visible(fn($record) => $record?->key === 'site_logo') // Hanya tampil jika key adalah 'site_logo'
                            ->disk('public') // Tentukan disk untuk menyimpan file ke public
                            ->directory('logo') // Tentukan subfolder untuk menyimpan logo
                            ->image() // Pastikan hanya file gambar yang diizinkan
                            ->preserveFilenames()
                            ->required(fn($record) => $record?->key === 'site_logo'),
                        FileUpload::make('value')  // Untuk input file logo
                            ->label('Site icon')
                            ->visible(fn($record) => $record?->key === 'site_icon') // Hanya tampil jika key adalah 'site_logo'
                            ->disk('public') // Tentukan disk untuk menyimpan file ke public
                            ->directory('icon') // Tentukan subfolder untuk menyimpan logo
                            ->image() // Pastikan hanya file gambar yang diizinkan
                            ->preserveFilenames()
                            ->required(fn($record) => $record?->key === 'site_icon'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->label('Key'),
                TextColumn::make('value')->label('Value'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
