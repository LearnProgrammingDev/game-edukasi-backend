<?php

namespace App\Filament\Admin\Resources\NodeConnections\Pages;

use App\Filament\Admin\Resources\NodeConnections\NodeConnectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNodeConnection extends EditRecord
{
    protected static string $resource = NodeConnectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
