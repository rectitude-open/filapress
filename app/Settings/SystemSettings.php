<?php

declare(strict_types=1);

namespace App\Settings;

use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\Settings;

class SystemSettings extends Settings
{
    public string $site_name;
    public ?string $site_title;
    public ?string $site_description;
    public ?string $site_logo;
    public ?string $site_favicon;
    public ?string $mail_from_email;
    public ?string $mail_from_name;
    public ?string $mail_host;
    public ?string $mail_port;
    public ?string $mail_username;
    public ?string $mail_password;
    public ?int $login_attempts_rate_limit;
    public ?int $login_attempts_lockout_window;
    public ?int $login_attempts_lockout_attempts;
    public ?int $login_attempts_lockout_duration;
    public ?bool $enable_login_captcha;

    public static function group(): string
    {
        return 'system';
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
