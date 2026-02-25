<?php

namespace App\Filament\Admin\Resources\NodeConnections\Pages;

use App\Filament\Admin\Resources\NodeConnections\NodeConnectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNodeConnection extends CreateRecord
{
    protected static string $resource = NodeConnectionResource::class;
}
