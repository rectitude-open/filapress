<?php

declare(strict_types=1);

namespace App\Filament\Resources\NewsResource\Pages;

use RectitudeOpen\FilaPressCore\Filament\Common\BaseCreateRecord;
use App\Filament\Resources\NewsResource;

class CreateNews extends BaseCreateRecord
{
    protected static string $resource = NewsResource::class;
}
