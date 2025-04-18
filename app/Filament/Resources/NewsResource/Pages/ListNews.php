<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use App\Filament\Common\BaseListRecords;

class ListNews extends BaseListRecords
{
    protected static string $resource = NewsResource::class;
}
