<?php

namespace App\Filament\Admin\Resources\Nodes\Pages;

use App\Filament\Admin\Resources\Nodes\NodeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNodes extends ListRecords
{
    protected static string $resource = NodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
