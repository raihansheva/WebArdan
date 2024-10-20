<?php

namespace App\Filament\Resources;

use Log;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Streaming;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StreamResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StreamResource\RelationManagers;

class StreamResource extends Resource
{
    protected static ?string $model = Streaming::class;

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $stream = Streaming::find($data['id']); // Ambil model yang akan diedit

        if (isset($data['image_stream'])) {
            // Jika ada gambar baru yang di-upload
            $stream->clearMediaCollection('images'); // Hapus gambar lama
            $stream->addMedia($data['image_stream'])
                ->toMediaCollection('images'); // Simpan gambar baru
        }

        return $data;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title_stream')->required(),
                        TextInput::make('stream_video_url')->required(),
                        TextInput::make('stream_audio_url')->required(),
                        FileUpload::make('image_stream')
                            ->label('Stream Image')
                            ->image()
                            ->directory('uploads/images')
                            ->disk('public')
                            ->preserveFilenames(),
                        Select::make('status')
                            ->label('Streaming-Status')
                            ->options([
                                'streaming' => 'Streaming',
                                'upcoming' => 'Upcoming',
                                'completed' => 'Completed',
                            ])
                            ->default('Upcoming'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title_stream'),
                TextColumn::make('stream_video_url'),
                TextColumn::make('stream_audio_url'),
                ImageColumn::make('image_stream'),
                TextColumn::make('status')
                    ->color(fn($record) => match ($record->status) {
                        'streaming' => 'danger',    // Merah untuk streaming
                        'upcoming' => 'warning',     // Oren untuk upcoming
                        'completed' => 'success',    // Hijau untuk completed
                        default => 'secondary',       // Warna default
                    }),

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
            'index' => Pages\ListStreams::route('/'),
            'create' => Pages\CreateStream::route('/create'),
            'edit' => Pages\EditStream::route('/{record}/edit'),
        ];
    }
}
