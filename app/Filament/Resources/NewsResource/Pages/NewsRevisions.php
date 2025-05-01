<?php

declare(strict_types=1);

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Mansoor\FilamentVersionable\RevisionsPage;

class NewsRevisions extends RevisionsPage
{
    protected static string $resource = NewsResource::class;
}
