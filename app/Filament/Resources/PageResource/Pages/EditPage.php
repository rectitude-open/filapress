<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getSubmitFormAction()
                ->icon('heroicon-o-paper-airplane')
                ->label(__('action.save'))
                ->formId('form'),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSubmitFormAction()
                ->icon('heroicon-o-paper-airplane')
                ->label(__('action.save')),
        ];
    }
}
