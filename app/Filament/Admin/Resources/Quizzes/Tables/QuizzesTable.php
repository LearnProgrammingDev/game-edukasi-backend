<?php

namespace App\Filament\Admin\Resources\Quizzes\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class QuizzesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('node.title')
                    ->label('Node')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'multiple_choice' => 'Pilihan Ganda',
                        'fill_blank'      => 'Isi Titik-titik',
                        'arrange_code'    => 'Susun Kode',
                        default           => $state,
                    })
                    ->color(fn($state) => match ($state) {
                        'multiple_choice' => 'success',
                        'fill_blank'      => 'warning',
                        'arrange_code'    => 'primary',
                        default           => 'gray',
                    }),
                TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->limit(60)
                    ->wrap(),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'multiple_choice' => 'Pilihan Ganda',
                        'fill_blank'      => 'Isi Titik-titik',
                        'arrange_code'    => 'Susun Kode',
                    ]),
                SelectFilter::make('node_id')
                    ->label('Filter Node')
                    ->relationship('node', 'title'),
            ])
            ->recordAction(EditAction::class)
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
