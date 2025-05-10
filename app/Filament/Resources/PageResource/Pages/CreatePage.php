<?php

declare(strict_types=1);

namespace App\Filament\Resources\PageResource\Pages;

use RectitudeOpen\FilaPressCore\Filament\Common\BaseCreateRecord;
use App\Filament\Resources\PageResource;

class CreatePage extends BaseCreateRecord
{
    protected static string $resource = PageResource::class;
}
