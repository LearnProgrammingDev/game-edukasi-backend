<?php

namespace App\Filament\Admin\Resources\Nodes\Pages;

use App\Filament\Admin\Resources\Nodes\NodeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNode extends CreateRecord
{
    protected static string $resource = NodeResource::class;
}
