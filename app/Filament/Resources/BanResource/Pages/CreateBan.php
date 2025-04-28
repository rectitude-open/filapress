<?php

declare(strict_types=1);

namespace App\Filament\Resources\BanResource\Pages;

use App\Filament\Resources\BanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBan extends CreateRecord
{
    protected static string $resource = BanResource::class;
}
