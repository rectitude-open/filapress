<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Tapp\FilamentMailLog\Resources\MailLogResource as TappMailLogResource;

class MailLogResource extends TappMailLogResource
{
    public static function getNavigationLabel(): string
    {
        return __('menu.nav_item.mail_log');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.security');
    }
}
