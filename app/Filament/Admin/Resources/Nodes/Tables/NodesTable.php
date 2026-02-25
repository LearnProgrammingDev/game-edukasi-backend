<?php

namespace App\Filament\Admin\Resources\Nodes\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class NodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label('No.')
                    ->sortable()
                    ->width(60),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'materi'      => 'success',
                        'kuis'        => 'warning',
                        'percabangan' => 'primary',
                        default       => 'gray',
                    }),
                TextColumn::make('exp_reward')
                    ->label('EXP')
                    ->suffix(' EXP')
                    ->sortable(),
                TextColumn::make('quizzes_count')
                    ->label('Jumlah Soal')
                    ->counts('quizzes'),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'materi'      => 'Materi',
                        'kuis'        => 'Kuis',
                        'percabangan' => 'Percabangan',
                    ]),
            ])
            ->recordAction(EditAction::class)
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
        // BulkActions dihapus — tidak ada di Filament v5 Tables
    }
}
