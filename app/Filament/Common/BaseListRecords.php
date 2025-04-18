<?php

namespace App\Filament\Common;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class BaseListRecords extends ListRecords
{
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }
}
