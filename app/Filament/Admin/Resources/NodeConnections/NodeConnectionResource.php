<?php

namespace App\Filament\Admin\Resources\NodeConnections;

use App\Filament\Admin\Resources\NodeConnections\Pages\CreateNodeConnection;
use App\Filament\Admin\Resources\NodeConnections\Pages\EditNodeConnection;
use App\Filament\Admin\Resources\NodeConnections\Pages\ListNodeConnections;
use App\Filament\Admin\Resources\NodeConnections\Schemas\NodeConnectionForm;
use App\Filament\Admin\Resources\NodeConnections\Tables\NodeConnectionsTable;
use App\Models\NodeConnection;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class NodeConnectionResource extends Resource
{
    protected static ?string $model = NodeConnection::class;

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-arrows-right-left';
    }
    public static function getNavigationLabel(): string
    {
        return 'Koneksi Node';
    }
    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Roadmap';
    }
    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public static function form(Schema $schema): Schema
    {
        return NodeConnectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NodeConnectionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListNodeConnections::route('/'),
            'create' => CreateNodeConnection::route('/create'),
            'edit'   => EditNodeConnection::route('/{record}/edit'),
        ];
    }
}
