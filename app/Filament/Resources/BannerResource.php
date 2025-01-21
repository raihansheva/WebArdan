<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Banner;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BannerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BannerResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationLabel = 'Banner';

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title_banner')->label('Title Banner :'),

                        Select::make('page')
                            ->options([
                                'all' => 'All Page',
                                'home' => 'Home',
                                'info_news' => 'Info News',
                                'event' => 'Event',
                                'chart' => 'Chart',
                                'youtube' => 'Youtube',
                                'podcast' => 'Podcast',
                                'info_artis' => 'Info Artis',
                                'singlepage_program' => 'SinglePage Program',
                                'singlepage_event' => 'SinglePage Event',
                                'singlepage_info' => 'SinglePage Info',
                                'singlepage_podcast' => 'SinglePage Podcast',
                                'singlepage_artis' => 'SinglePage Artis',
                                'singlepage_kategoriInfo' => 'SinglePage KategoriInfo',
                            ])
                            ->required()
                            ->label('Page')
                            ->reactive(),
                        Select::make('position')
                            ->options(function (callable $get) {
                                $page = $get('page'); // Ambil nilai page yang dipilih
                                switch ($page) {
                                    case 'all':
                                        return [
                                            'top' => 'Top',
                                        ];
                                    case 'home':
                                        return [
                                            'top' => 'Top',
                                            'middle' => 'Middle',
                                            'bottom_kategori' => 'Bottom Kategori',
                                            'bottom_podcast' => 'Bottom Podcast',
                                        ];
                                    case 'info_news':
                                        return [
                                            'bottom_topInfo' => 'bottom_topInfo',
                                            'middle' => 'middle',
                                        ];
                                    case 'event':
                                        return [
                                            'middle' => 'Middle',
                                        ];
                                    case 'youtube':
                                        return [
                                            'middle' => 'Middle',
                                        ];
                                    case 'podcast':
                                        return [
                                            'top' => 'Top',
                                            'bottom_topInfo' => 'Bottom TopInfo',
                                        ];
                                    case 'singlepage_info':
                                        return [
                                            'bottom_detail' => 'Bottom Detail Info',
                                            'middle' => 'Middle',
                                        ];
                                    case 'singlepage_event':
                                        return [
                                            'bottom_detail' => 'Bottom Detail Event',
                                            'middle' => 'Middle',
                                        ];
                                    case 'singlepage_program':
                                        return [
                                            'bottom_detailil' => 'Bottom Detail Program',
                                            'middle' => 'Middle',
                                        ];
                                    case 'singlepage_artis':
                                        return [
                                            'bottom_detail' => 'Bottom Detail artis',
                                            'middle' => 'Middle',
                                        ];
                                    case 'info_artis':
                                        return [
                                            'middle' => 'Middle',
                                        ];
                                    case 'kategori_info':
                                        return [
                                            'middle' => 'Middle',
                                        ];
                                    case 'chart':
                                        return [
                                            'bottom_topInfo' => 'Bottom Top Info',
                                        ];
                                    default:
                                        return [
                                            'default' => 'Default Position',
                                        ];
                                }
                            })
                            ->required()
                            ->label('Position')
                            ->reactive() // Reacts to changes
                            ->afterStateUpdated(function (callable $set, $state) {
                                // Update width_type based on position value
                                switch ($state) {
                                    case 'top':
                                        $set('width_type', 'Full Width');
                                        break;
                                    case 'bottom_detail':
                                        $set('width_type', 'Full Width Large');
                                        break;
                                    case 'middle':
                                        $set('width_type', 'Full Width');
                                        break;
                                    case 'bottom_topInfo':
                                        $set('width_type', 'Large');
                                        break;
                                    case 'bottom_podcast':
                                        $set('width_type', 'Full Width Small');
                                        break;
                                    case 'bottom_kategori':
                                        $set('width_type', 'Small');
                                        break;
                                    default:
                                        $set('width_type', 'Default Position');
                                }
                            }),

                        TextInput::make('width_type')
                            ->label('Width Type')
                            ->disabled()
                            ->reactive(), // Make the field readonly

                        FileUpload::make('image_banner')
                            ->label('Banner Image :')
                            ->image()
                            ->directory('uploads/images_banner')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(function (callable $get) {
                                $widthType = $get('width_type'); // Ambil nilai dari 'width_type'

                                // Validasi berdasarkan width_type
                                switch ($widthType) {
                                    case 'Full Width Large':
                                        return [
                                            'required',
                                            'image',
                                            'dimensions::min_width=1960,max_width=1080,min_height=100,max_height=120'
                                        ];
                                    case 'Full Width Small':
                                        return [
                                            'required',
                                            'image',
                                            'dimensions::min_width=1960,max_width=1080,min_height=100,max_height=120'
                                        ];
                                    case 'Large':
                                        return [
                                            'required',
                                            'image',
                                            'dimensions:min_width=1960,max_width=1080,min_height=100,max_height=120'
                                        ];
                                    case 'Small':
                                        return [
                                            'required',
                                            'image',
                                            'dimensions:min_width=1960,max_width=1080,min_height=100,max_height=120'
                                        ];
                                    default: // Default untuk 'Full Width'
                                        return [
                                            'required',
                                            'image',
                                            'dimensions:min_width=1960,max_width=1800,min_height=200,max_height=250'
                                        ];
                                }
                                
                            })
                            ->validationAttribute('Banner Image')
                            ->helperText(function (callable $get) {
                                $widthType = $get('width_type'); // Ambil nilai dari 'width_type'

                                // Tampilkan pesan helper berdasarkan width_type
                                switch ($widthType) {
                                    case 'Full Width Large':
                                        return 'The image must be exactly 801x120 pixels.';
                                    case 'Full Width Small':
                                        return 'The image must be exactly 720x120 pixels.';
                                    case 'Large':
                                        return 'The image must be exactly 422x120 pixels.';
                                    case 'Small':
                                        return 'The image must be exactly 364x120 pixels.';
                                    default: // Default untuk 'Full Width'
                                        return 'The image must be exactly 1350x250 pixels.';
                                }
                            })
                            ->reactive() // Untuk memastikan helper text dan rules berubah saat width_type berubah
                            ->required(), // FileUpload wajib diisi


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
                TextColumn::make('title_banner')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('image_banner'),
                TextColumn::make('page')
                    ->label('Page'),
                TextColumn::make('position')
                    ->label('Position'),
                TextColumn::make('width_type')
                    ->label('Width Type'),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
