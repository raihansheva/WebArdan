<?php

namespace App\Filament\Resources;

use Filament\Forms;
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
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ScheduleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ScheduleResource\RelationManagers;

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
                                $program = Program::find($state);
                                if ($program) {
                                    $set('jam_program', $program->jam_program);
                                    $set('deskripsi', $program->deskripsi_program);
                                }
                            }),
                        TextInput::make('jam_program')
                            ->label('Jam Program')
                            ->required()
                            ->readOnly()
                            ->default(''),
                        DatePicker::make('hari')->label('Hari :'),
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
                TextColumn::make('program.judul_program'),
                TextColumn::make('jam_program'),
                TextColumn::make('hari'),
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
