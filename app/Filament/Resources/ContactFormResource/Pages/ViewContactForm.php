<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactFormResource\Pages;

use App\Filament\Resources\ContactFormResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Js;

class ViewContactForm extends ViewRecord
{
    protected static string $resource = ContactFormResource::class;

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
