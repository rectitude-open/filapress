<?php

declare(strict_types=1);

namespace App\Filament\Common;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Facades\Filament;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Js;
use Illuminate\Support\Str;
use Mansoor\FilamentVersionable\RevisionsPage;

class BaseRevisionsPage extends RevisionsPage
{
    use HasPageShield;

    protected function getActions(): array
    {
        return [
            Action::make('cancel')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.cancel.label'))
                ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = '.Js::from($this->previousUrl ?? static::getResource()::getUrl()).')')
                ->icon('heroicon-o-arrow-left')
                ->label(__('action.back')),
        ];
    }

    public static function canAccess(array $parameters = []): bool
    {
        return Filament::auth()->user()->hasRole('super-admin') ||
                Filament::auth()->user()->can('revisions_'.Str::of(static::getResource())
                    ->afterLast('Resources\\')
                    ->before('Resource')
                    ->replace('\\', '')
                    ->snake());
    }
}
