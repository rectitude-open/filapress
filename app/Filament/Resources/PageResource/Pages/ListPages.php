<?php

declare(strict_types=1);

namespace App\Filament\Resources\PageResource\Pages;

use RectitudeOpen\FilaPressCore\Filament\Common\BaseListRecords;
use App\Filament\Resources\PageResource;

class ListPages extends BaseListRecords
{
    protected static string $resource = PageResource::class;
}
