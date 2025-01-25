<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PopUpAdsResource\Pages;
use App\Filament\Resources\PopUpAdsResource\RelationManagers;
use App\Models\PopupAds;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PopUpAdsResource extends Resource
{
    protected static ?string $model = PopupAds::class;

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationLabel = 'PopUp Ads';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title'),
                        TextInput::make('link_ads'),
                        Select::make('image_ratio')
                            ->options([
                                'landscape' => 'Landscape',
                                'portrait' => 'Portrait',
                            ])
                            ->required()
                            ->label('Image Rasio')
                            ->reactive(),
                        FileUpload::make('images_ads')
                            ->label('Ads Image :')
                            ->image()
                            ->directory('uploads/images_ads')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(function (callable $get) {
                                $widthType = $get('image_rasio'); // Ambil nilai dari 'width_type'

                                // Validasi berdasarkan width_type
                                switch ($widthType) {
                                    case 'portrait':
                                        return [
                                            'required',
                                            'image',
                                            'dimensions::min_width=800,min_height=600',
                                            'dimensions::max_width=1080,max_height=1920'
                                        ];
                                    default: // Default untuk 'Full Width'
                                        return [
                                            'required',
                                            'image',
                                            'dimensions:max_width=1920,max_height=1800,'
                                        ];
                                }
                            })
                            ->validationAttribute('Banner Image')
                            ->helperText(function (callable $get) {
                                $widthType = $get('image_rasio'); // Ambil nilai dari 'width_type'

                                // Tampilkan pesan helper berdasarkan width_type
                                switch ($widthType) {
                                    case 'portrait':
                                        return 'The image must be minimun 800x600 pixels.';
                                    default: // Default untuk 'Full Width'
                                        return 'The image must be max 1920x1080 pixels.';
                                }
                            })
                            ->reactive() // Untuk memastikan helper text dan rules berubah saat width_type berubah
                            ->required(),
                        Select::make('page')
                            ->options([
                                'all' => 'All Page',
                                'home' => 'Home',
                                'info-news' => 'Info News',
                                'event' => 'Event',
                                'chart' => 'Chart',
                                'youtube' => 'Youtube',
                                'podcast' => 'Podcast',
                                'info-artis' => 'Info Artis',
                                'detail-program' => 'SinglePage Program',
                                'detail-event' => 'SinglePage Event',
                                'detail-info' => 'SinglePage Info',
                                'detail-podcast' => 'SinglePage Podcast',
                                'detail-artis' => 'SinglePage Artis',
                                'detail-taginfo' => 'SinglePage KategoriInfo',
                            ])
                            ->multiple()
                            ->required()
                            ->label('Page'),
                        Select::make('target_audience')
                            ->options([
                                'new_users' => 'Pengguna Baru',
                                'all_users' => 'Semua Pengguna',
                            ])
                            ->default('all_users')
                            ->label('Target Audiens')
                            ->required(),
                        Checkbox::make('close_with_icon')
                            ->label('Tutup dengan ikon')
                            ->default(true),
                        Checkbox::make('close_with_click_anywhere')
                            ->label('Tutup dengan klik di mana saja')
                            ->default(false),
                        Checkbox::make('has_button')
                            ->label('Tampilkan Button')
                            ->default(true),
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->placeholder('Pilih Tanggal Mulai')
                            ->format('Y-m-d'),
                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->placeholder('Pilih Tanggal Selesai')
                            ->format('Y-m-d')
                            ->rule('after:start_date'),
                        TimePicker::make('start_time')
                            ->label('Jam Mulai')
                            ->required()
                            ->format('H:i'),
                        TimePicker::make('end_time')
                            ->label('Jam Selesai')
                            ->required()
                            ->format('H:i')
                            ->rule('after:start_time'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title Ads'),
                TextColumn::make('link_ads')
                    ->label('Link Ads'),
                TextColumn::make('image_ratio')
                    ->label('Image Ratio'),
                ImageColumn::make('images_ads')
                    ->label('Image Ads'),
                TextColumn::make('page')
                    ->label('Page'),
                IconColumn::make('close_with_icon')
                    ->label('Tutup dengan icon')
                    ->boolean() // Secara otomatis menggunakan ikon `check` dan `x` untuk nilai boolean.
                    ->trueIcon('heroicon-o-check-circle') // Ikon untuk nilai true.
                    ->falseIcon('heroicon-o-x-circle')   // Ikon untuk nilai false.
                    ->trueColor('success') // Warna ikon untuk true.
                    ->falseColor('danger'), // Warna ikon untuk false.
                IconColumn::make('close_with_click_anywhere')
                    ->label('Tutup dengan klik dimana aja')
                    ->boolean() // Secara otomatis menggunakan ikon `check` dan `x` untuk nilai boolean.
                    ->trueIcon('heroicon-o-check-circle') // Ikon untuk nilai true.
                    ->falseIcon('heroicon-o-x-circle')   // Ikon untuk nilai false.
                    ->trueColor('success') // Warna ikon untuk true.
                    ->falseColor('danger'), // Warna ikon untuk false.
                IconColumn::make('has_button')
                    ->label('Gunakan Button')
                    ->boolean() // Secara otomatis menggunakan ikon `check` dan `x` untuk nilai boolean.
                    ->trueIcon('heroicon-o-check-circle') // Ikon untuk nilai true.
                    ->falseIcon('heroicon-o-x-circle')   // Ikon untuk nilai false.
                    ->trueColor('success') // Warna ikon untuk true.
                    ->falseColor('danger'), // Warna ikon untuk false.
                TextColumn::make('target_audience')
                    ->label('Targer User')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Tanggal Mulai')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Tanggal Selesai')
                    ->sortable(),
                TextColumn::make('start_time')
                    ->label('Jam Mulai')
                    ->sortable(),
                TextColumn::make('end_time')
                    ->label('Jam Selesai')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('title')
                    ->form([
                        TextInput::make('title')
                            ->label('Title :')
                            ->placeholder('Search title...'),
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['title'], function ($q, $title) {
                            $searchTerm = strtolower($title);
                            $q->whereRaw('LOWER(title) LIKE ?', ["%{$searchTerm}%"]);
                        });
                    }),
                Filter::make('start_date')
                    ->form([
                        DatePicker::make('start_date')
                            ->label('Start Date :'),
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['start_date'], function ($q, $startDate) {
                            $q->whereDate('start_date', '=', $startDate);
                        });
                    }),
                Filter::make('end_date')
                    ->form([
                        DatePicker::make('end_date')
                            ->label('End Date :'),
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['end_date'], function ($q, $endDate) {
                            $q->whereDate('end_date', '=', $endDate);
                        });
                    }),
                Filter::make('start_time')
                    ->form([
                        TimePicker::make('start_time')
                            ->label('Start Time :'),
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['start_time'], function ($q, $startTime) {
                            $q->whereTime('start_time', '=', $startTime);
                        });
                    }),
                Filter::make('end_time')
                    ->form([
                        TimePicker::make('end_time')
                            ->label('End Time :'),
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['end_time'], function ($q, $endTime) {
                            $q->whereTime('end_time', '=', $endTime);
                        });
                    }),

            ], layout: FiltersLayout::AboveContent)
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
            'index' => Pages\ListPopUpAds::route('/'),
            'create' => Pages\CreatePopUpAds::route('/create'),
            'edit' => Pages\EditPopUpAds::route('/{record}/edit'),
        ];
    }
}
