<?php

declare(strict_types=1);

namespace App\Filament\Clusters\NewsCluster\Resources\NewsTagResource\Pages;

use App\Filament\Clusters\NewsCluster\Resources\NewsTagResource;
use Filament\Resources\Pages\ListRecords;

class ListNewsTags extends ListRecords
{
    protected static string $resource = NewsTagResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
