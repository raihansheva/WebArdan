<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'User Setting';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('email')
                            ->email()
                            ->label('Email : ')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('password')
                            ->password()
                            ->required(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                            ->minLength(8)
                            ->same('passwordConfirmation')
                            ->dehydrated(fn($state) => filled($state)) // Hanya mengirimkan jika ada input
                            ->mutateDehydratedStateUsing(fn($state) => Hash::make($state)),
                        TextInput::make('passwordConfirmation')
                            ->password()
                            ->label('Password Confirmation : ')
                            ->required(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                            ->minLength(8)
                            ->dehydrated(false), // Tidak menyimpan data
                        Select::make('roles')
                            ->multiple()
                            ->relationship('roles', 'name')->preload(),
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
                TextColumn::make('name')->label('Name'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('roles.name')->label('Role'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
