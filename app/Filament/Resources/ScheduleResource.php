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
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;

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
                                    $set('jam_mulai', $program->jam_mulai);
                                    $set('jam_selesai', $program->jam_selesai);
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
                            ->format('H:i')
                            ->readOnly(),
                        TimePicker::make('jam_selesai')
                            ->label('Jam Selesai :')
                            ->required()
                            ->format('H:i')
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
                TextColumn::make('row_number')
                    ->label('No')
                    ->getStateUsing(static function ($rowLoop) {
                        return $rowLoop->iteration;
                    }),
                TextColumn::make('program.judul_program')->sortable(),
                TextColumn::make('jam_mulai')->sortable(),
                TextColumn::make('jam_selesai')->sortable(),
                TextColumn::make('hari'),
                TextColumn::make('deskripsi'),
            ])
            ->filters([
                Filter::make('judul_program')
                    ->form([
                        TextInput::make('judul_program')
                            ->label('Search :')
                            ->placeholder('search')
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['judul_program'], function ($q, $judulProgram) {
                            $q->whereHas('program', function ($query) use ($judulProgram) {
                                $query->where('judul_program', 'like', '%' . $judulProgram . '%');
                            });
                        });
                    }),
                Filter::make('jam_mulai')
                    ->form([
                        TimePicker::make('jam_mulai')
                            ->label('Jam Mulai :')
                            ->placeholder('Pilih jam mulai...')
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['jam_mulai'], function ($q, $jamMulai) {
                            $q->where('jam_mulai', $jamMulai);
                        });
                    }),

                Filter::make('jam_selesai')
                    ->form([
                        TimePicker::make('jam_selesai')
                            ->label('Jam Selesai :')
                            ->placeholder('Pilih jam selesai...')
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['jam_selesai'], function ($q, $jamSelesai) {
                            $q->where('jam_selesai', $jamSelesai);
                        });
                    }),
                Filter::make('hari')
                    ->form([
                        Select::make('hari')
                            ->label('Hari')
                            ->placeholder('Pilih hari...')
                            ->options([
                                'Senin' => 'Senin',
                                'Selasa' => 'Selasa',
                                'Rabu' => 'Rabu',
                                'Kamis' => 'Kamis',
                                'Jumat' => 'Jumat',
                                'Sabtu' => 'Sabtu',
                                'Minggu' => 'Minggu',
                            ])
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['hari'], function ($q, $hari) {
                            $q->where('hari', $hari);
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
