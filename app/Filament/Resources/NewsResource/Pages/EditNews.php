<?php

declare(strict_types=1);

namespace App\Filament\Resources\NewsResource\Pages;

use RectitudeOpen\FilaPressCore\Filament\Common\BaseEditRecord;
use App\Filament\Resources\NewsResource;

class EditNews extends BaseEditRecord
{
    protected static string $resource = NewsResource::class;
}
