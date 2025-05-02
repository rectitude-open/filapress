<?php

declare(strict_types=1);

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;

    public function getTitle(): string
    {
        return trans('filament-users::user.resource.title.create');
    }
}
