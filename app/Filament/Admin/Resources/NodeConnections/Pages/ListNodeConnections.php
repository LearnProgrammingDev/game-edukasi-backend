<?php

namespace App\Filament\Admin\Resources\NodeConnections\Pages;

use App\Filament\Admin\Resources\NodeConnections\NodeConnectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNodeConnections extends ListRecords
{
    protected static string $resource = NodeConnectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
