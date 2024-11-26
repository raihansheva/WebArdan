<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Program;
use App\Models\Schedule;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use App\Filament\Resources\ScheduleResource\Pages;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationLabel = 'Schedule';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('program_id')
                            ->label('Program')
                            ->relationship('program', 'judul_program')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $program = Program::find($state); // Ambil data program berdasarkan ID
                                if ($program) {
                                    // Gabungkan jam_mulai dan jam_selesai
                                    $set('jam_mulai',$program->jam_mulai);
                                    $set('jam_selesai',$program->jam_selesai);
                                    $set('deskripsi', $program->deskripsi_program); // Isi deskripsi jika diperlukan
                                }
                            }),
                        // TextInput::make('jam_program')
                        //     ->label('Jam Program')
                        //     ->required()
                        //     ->readOnly()
                        //     ->default(''),
                        TimePicker::make('jam_mulai')
                            ->label('Jam Mulai :')
                            ->required()
                            ->readOnly(),
                        TimePicker::make('jam_selesai')
                            ->label('Jam Selesai :')
                            ->required()
                            ->rule('after:jam_mulai')
                            ->readOnly(),
                        Select::make('hari')
                            ->label('Hari :')
                            ->options([
                                'senin' => 'Senin',
                                'selasa' => 'Selasa',
                                'rabu' => 'Rabu',
                                'kamis' => 'Kamis',
                                'jumat' => 'Jumat',
                                'sabtu' => 'Sabtu',
                                'minggu' => 'Minggu',
                            ])
                            ->default('Upcoming'),
                        Textarea::make('deskripsi') // Pastikan field deskripsi ada
                            ->label('Deskripsi :')
                            ->required()
                            ->rows(5)
                            ->readonly(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('program.judul_program')->searchable()->sortable(),
                TextColumn::make('jam_program')->searchable()->sortable(),
                TextColumn::make('hari')->searchable(),
                TextColumn::make('deskripsi'),
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
