<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use App\Models\Info;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InfoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InfoResource\RelationManagers;

class InfoResource extends Resource
{
    protected static ?string $model = Info::class;

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationLabel = 'Info';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('judul_info')->label('Judul Info :')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                                $set('slug', Str::slug($state));
                            })
                            ->required(),
                        TextInput::make('tag_info')->label('tag Info :')->required(),
                        Textarea::make('deskripsi_info')
                            ->label('Deskripsi Info :')
                            ->rows(5)
                            ->required(),
                        FileUpload::make('image_info')
                            ->label('Info Image :')
                            ->directory('uploads/images_info')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=256,height=165']) // Ubah format ke array
                            ->validationAttribute('Image Event')
                            ->helperText('The image must be 256x165 pixels.'),
                        DatePicker::make('date_info')
                            ->label('Info Date :')
                            ->required()
                            ->displayFormat('Y-m-d') // Format tampilan tanggal
                            ->firstDayOfWeek(1), // Menentukan hari pertama minggu (1 = Senin)
                        TextInput::make('slug')
                            ->label('Slug :')
                            ->readOnly() // Menonaktifkan input manual karena slug dibuat otomatis
                            ->required(),
                        Toggle::make('top_news')
                            ->label('Top News')
                            ->onColor('success')  // Optional: Mengatur warna saat toggle aktif
                            ->offColor('danger')  // Optional: Mengatur warna saat toggle tidak aktif
                            ->default(false),     // Defa
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul_info'),
                TextColumn::make('tag_info'),
                TextColumn::make('deskripsi_info'),
                ImageColumn::make('image_info'),
                TextColumn::make('date_info'),
                TextColumn::make('slug'),
                TextColumn::make('top_news')
                    ->label('Top News')
                    ->getStateUsing(function ($record) {
                        return $record->top_news ? 'Top-News' : '-';
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
            'index' => Pages\ListInfos::route('/'),
            'create' => Pages\CreateInfo::route('/create'),
            'edit' => Pages\EditInfo::route('/{record}/edit'),
        ];
    }
}
