<?php

declare(strict_types=1);

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdmins extends ListRecords
{
    protected static string $resource = AdminResource::class;

    public function getTitle(): string
    {
        return trans('filament-users::user.resource.title.list');
    }

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
