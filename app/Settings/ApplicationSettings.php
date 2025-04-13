<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ApplicationSettings extends Settings
{
    public string $site_name;
    public string $site_title;
    public string $site_description;
    public string | null $site_logo;
    public string | null $site_favicon;

    public static function group(): string
    {
        return 'admin';
    }
}
