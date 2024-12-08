<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
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
use Filament\Forms\Components\TextInput;

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
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=864,height=500']) // Ubah format ke array
                            ->validationAttribute('Image Event')
                            ->helperText('The image must be 864x500 pixels.'),
                        DatePicker::make('date_event')->label('Date Event :')->required(),
                        DateTimePicker::make('time_countdown')->label('Time Countdown :')->required(),
                        Select::make('status')
                            ->label('Status Event :')
                            ->options([
                                'soon' => 'Soon',
                                'upcoming' => 'Upcoming',
                                'completed' => 'Completed',
                            ]),
                        RichEditor::make('deskripsi_event')
                            ->label('Deksripsi Event :')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('meta_title')
                            ->label('Title Info :')
                            ->placeholder('Masukan meta title') // Menambahkan placeholder untuk panduan input
                            ->maxLength(100)
                            ->required(),
                        Textarea::make('meta_description')
                            ->label('Description Info :')
                            ->placeholder('Masukan meta description')
                            ->required(),
                        TextInput::make('meta_keywords')
                            ->label('Keyword :')
                            ->placeholder('Masukan meta keyword')
                            ->required(),
                    ])

                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_event'),
                TextColumn::make('deskripsi_event')
                    ->formatStateUsing(function ($state) {
                        return strip_tags($state); // Menghapus tag HTML
                    }),
                TextColumn::make('date_event')->searchable()->sortable(),
                TextColumn::make('time_countdown'),
                TextColumn::make('status')
                    ->color(fn($record) => match ($record->status) {
                        'soon' => 'warning',    // Merah untuk streaming
                        'upcoming' => 'danger',     // Oren untuk upcoming
                        'completed' => 'success',    // Hijau untuk completed
                        default => 'secondary',       // Warna default
                    }),
                TextColumn::make('meta_title'),
                TextColumn::make('meta_description'),
                TextColumn::make('meta_keywords'),
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
