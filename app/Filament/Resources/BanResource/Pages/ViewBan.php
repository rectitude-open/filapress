<?php

declare(strict_types=1);

namespace App\Filament\Resources\BanResource\Pages;

use App\Filament\Common\BaseViewRecord;
use App\Filament\Resources\BanResource;
use Filament\Actions\Action;
use Illuminate\Support\Js;

class ViewBan extends BaseViewRecord
{
    protected static string $resource = BanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('cancel')
                ->label(__('filament-panels::resources/pages/create-record.form.actions.cancel.label'))
                ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = '.Js::from($this->previousUrl ?? static::getResource()::getUrl()).')')
                ->color('gray')
                ->icon('heroicon-o-arrow-left')
                ->label(__('action.back')),
        ];
    }
}
