<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->getCancelFormAction()
                ->icon('heroicon-o-arrow-left')
                ->label(__('action.back')),
            $this->getCreateFormAction()
                ->icon('heroicon-o-paper-airplane')
                ->label(__('action.publish'))
                ->formId('form'),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->icon('heroicon-o-paper-airplane')
                ->label(__('action.publish'))
                ->formId('form'),
            $this->getCancelFormAction()
                ->icon('heroicon-o-arrow-left')
                ->label(__('action.back')),
        ];
    }
}
