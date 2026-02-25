<?php

namespace App\Filament\Admin\Resources\Nodes;

use App\Filament\Admin\Resources\Nodes\Pages\CreateNode;
use App\Filament\Admin\Resources\Nodes\Pages\EditNode;
use App\Filament\Admin\Resources\Nodes\Pages\ListNodes;
use App\Filament\Admin\Resources\Nodes\Schemas\NodeForm;
use App\Filament\Admin\Resources\Nodes\Tables\NodesTable;
use App\Models\Node;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class NodeResource extends Resource
{
    protected static ?string $model = Node::class;

    public static function getNavigationIcon(): string { return 'heroicon-o-map'; }
    public static function getNavigationLabel(): string { return 'Node / Materi'; }
    public static function getNavigationGroup(): ?string { return 'Manajemen Roadmap'; }
    public static function getNavigationSort(): ?int { return 1; }

    public static function form(Schema $schema): Schema
    {
        return NodeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NodesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListNodes::route('/'),
            'create' => CreateNode::route('/create'),
            'edit'   => EditNode::route('/{record}/edit'),
        ];
    }
}