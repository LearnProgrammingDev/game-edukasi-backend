<?php

namespace App\Filament\Admin\Resources\NodeConnections\Schemas;

use App\Models\Node;
use Filament\Schemas\Components\Section; // ← fix
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class NodeConnectionForm
{
    public static function configure(Schema $schema): Schema
    {
        $nodeOptions = Node::orderBy('order')->pluck('title', 'id')->toArray();

        return $schema->components([
            Section::make('Buat Koneksi Antar Node')
                ->description('Node asal harus selesai dulu sebelum node tujuan terbuka.')
                ->schema([
                    Select::make('source_node_id')
                        ->label('Node Asal (Harus Diselesaikan)')
                        ->options($nodeOptions)
                        ->required()
                        ->searchable(),

                    Select::make('target_node_id')
                        ->label('Node Tujuan (Yang Akan Terbuka)')
                        ->options($nodeOptions)
                        ->required()
                        ->searchable(),
                ])->columns(2),
        ]);
    }
}
