<?php

declare(strict_types=1);

namespace App\Filament\Resources\NewsResource\Pages;

use RectitudeOpen\FilaPressCore\Filament\Common\BaseRevisionsPage;
use App\Filament\Resources\NewsResource;

class NewsRevisions extends BaseRevisionsPage
{
    protected static string $resource = NewsResource::class;
}
