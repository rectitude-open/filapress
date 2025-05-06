<?php

declare(strict_types=1);

namespace App\Filament\Clusters\NewsCluster\Resources\NewsTagResource\Pages;

use App\Filament\Clusters\NewsCluster\Resources\NewsTagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewsTag extends EditRecord
{
    protected static string $resource = NewsTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
