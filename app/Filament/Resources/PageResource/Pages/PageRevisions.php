<?php

declare(strict_types=1);

namespace App\Filament\Resources\PageResource\Pages;

use RectitudeOpen\FilaPressCore\Filament\Common\BaseRevisionsPage;
use App\Filament\Resources\PageResource;

class PageRevisions extends BaseRevisionsPage
{
    protected static string $resource = PageResource::class;
}
