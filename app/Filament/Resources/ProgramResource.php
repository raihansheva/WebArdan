<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationLabel = 'Program';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('text_header')->label('Text Header :')->required(),
                        TextInput::make('judul_program')->label('Nama Program :')->required(),
                        FileUpload::make('image_program')
                            ->label('Program Image :')
                            ->image()
                            ->directory('uploads/images_program')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=322,height=280']) // Ubah format ke array
                            ->validationAttribute('Image Event')
                            ->helperText('The image must be 322x280 pixels.'),
                        TextInput::make('jam_program')->label('Jam Program :')->required(),
                        RichEditor::make('deskripsi_program')
                            ->label('Deskripsi Program :')
                            ->required()
                            ->columnSpan(2),

                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('text_header'),
                TextColumn::make('judul_program')->searchable()->sortable(),
                TextColumn::make('deskripsi_program')
                ->formatStateUsing(function ($state) {
                    return strip_tags($state); // Menghapus tag HTML
                }),
                TextColumn::make('jam_program')->searchable()->sortable(),
                ImageColumn::make('image_program'),
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
