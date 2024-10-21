<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use function Laravel\Prompts\textarea;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\EventResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventResource\RelationManagers;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationLabel = 'Event';

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        FileUpload::make('image_event')
                        ->label('Image Event :')
                        ->image()
                        ->directory('uploads/images_event')
                        ->disk('public')
                        ->preserveFilenames(),
                        Textarea::make('deskripsi_event')
                        ->label('Deksripsi Event :')
                        ->rows(5)
                        ->required(),
                        DatePicker::make('date_event')->label('Date Event :')->required(),
                        DateTimePicker::make('time_countdown')->label('Time Countdown :')->required(),
                    ])

                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_event'),
                TextColumn::make('deskripsi_event'),
                TextColumn::make('date_event'),
                TextColumn::make('time_countdown'),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
