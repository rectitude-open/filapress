<?php

declare(strict_types=1);

namespace App\Filament\Resources\BanResource\Pages;

use App\Filament\Resources\BanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBans extends ListRecords
{
    protected static string $resource = BanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
