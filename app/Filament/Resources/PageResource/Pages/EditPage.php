<?php

declare(strict_types=1);

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Common\BaseEditRecord;
use App\Filament\Resources\PageResource;

class EditPage extends BaseEditRecord
{
    protected static string $resource = PageResource::class;
}
