<?php

namespace App\Filament\Common;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

abstract class BaseEditRecord extends EditRecord
{
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),
            $this->getCancelFormAction()
                ->icon('heroicon-o-arrow-left')
                ->label(__('action.back')),
            $this->getSubmitFormAction()
                ->icon('heroicon-o-paper-airplane')
                ->label(__('action.save')),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSubmitFormAction()
                ->icon('heroicon-o-paper-airplane')
                ->label(__('action.save')),
            $this->getCancelFormAction()
                ->icon('heroicon-o-arrow-left')
                ->label(__('action.back')),
            Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),
        ];
    }
}
