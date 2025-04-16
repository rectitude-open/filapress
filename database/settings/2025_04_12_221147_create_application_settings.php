<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('admin.site_name', '');
        $this->migrator->add('admin.site_title', '');
        $this->migrator->add('admin.site_description', '');
        $this->migrator->add('admin.site_logo', '');
        $this->migrator->add('admin.site_favicon', '');
    }
};
