<?php

declare(strict_types=1);

namespace App\Settings;

use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\Settings;

class ApplicationSettings extends Settings
{
    public string $site_name;

    public ?string $site_title;

    public ?string $site_description;

    public ?string $site_logo;

    public ?string $site_favicon;

    public static function group(): string
    {
        return 'admin';
    }

    public static function getSiteName(): string
    {
        $instance = app(self::class);

        return $instance->site_name ?: config('app.name');
    }

    public static function getLogoUrl(): ?string
    {
        $instance = app(self::class);
        if (! $instance->site_logo) {
            return null;
        }

        return Storage::url($instance->site_logo);
    }

    public static function getFaviconUrl(): ?string
    {
        $instance = app(self::class);
        if (! $instance->site_favicon) {
            return null;
        }

        return Storage::url($instance->site_favicon);
    }
}
