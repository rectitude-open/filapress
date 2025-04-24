<?php

declare(strict_types=1);

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('admin.site_name', 'FilaPress');
        $this->migrator->add('admin.site_title', '');
        $this->migrator->add('admin.site_description', '');
        $this->migrator->add('admin.site_logo', '');
        $this->migrator->add('admin.site_favicon', '');
        $this->migrator->add('admin.mail_from_email', '');
        $this->migrator->add('admin.mail_from_name', '');
        $this->migrator->add('admin.mail_host', '');
        $this->migrator->add('admin.mail_port', '465');
        $this->migrator->add('admin.mail_username', '');
        $this->migrator->add('admin.mail_password', '');
    }
};
