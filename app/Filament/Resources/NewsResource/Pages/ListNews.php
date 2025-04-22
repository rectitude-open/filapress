<?php

declare(strict_types=1);

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Common\BaseListRecords;
use App\Filament\Resources\NewsResource;

class ListNews extends BaseListRecords
{
    protected static string $resource = NewsResource::class;
}
