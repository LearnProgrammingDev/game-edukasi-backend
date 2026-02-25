<?php

namespace App\Filament\Admin\Resources\NodeConnections\Tables;

use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NodeConnectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sourceNode.order')
                    ->label('No.')
                    ->sortable(),
                TextColumn::make('sourceNode.title')
                    ->label('Node Asal')
                    ->searchable(),
                TextColumn::make('targetNode.title')
                    ->label('Node Tujuan')
                    ->searchable(),
            ])
            ->defaultSort('sourceNode.order')
            ->actions([
                DeleteAction::make(),
            ]);
    }
}
