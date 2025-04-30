<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Filament\Pages\SystemSettings\Forms\ApplicationForm;
use App\Filament\Pages\SystemSettings\Forms\MailForm;
use App\Settings\SystemSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Facades\Filament;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use App\Filament\Pages\SystemSettings\Forms\SecurityForm;

class SystemSettingsPage extends SettingsPage
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $title = 'System';

    protected static ?string $slug = 'settings/application';

    protected static ?string $navigationGroup = 'Settings';

    protected static string $settings = SystemSettings::class;

    public function mount(): void
    {
        parent::mount();
    }

    public function form(Form $form): Form
    {
        $arrTabs = [];

        $arrTabs[] = Tabs\Tab::make('System Tab')
            ->label('System')
            ->icon('heroicon-o-tv')
            ->schema(ApplicationForm::get());

        $arrTabs[] = Tabs\Tab::make('Mail Tab')
            ->label('Mail')
            ->icon('heroicon-o-envelope')
            ->schema(MailForm::get());

        $arrTabs[] = Tabs\Tab::make('Security Tab')
            ->label('Security')
            ->icon('heroicon-o-shield-check')
            ->schema(SecurityForm::get());

        return $form
            ->columns(1)
            ->schema([
                Tabs::make('Tabs')
                    ->tabs($arrTabs)
                    ->activeTab(1),
            ]);
    }

    public static function canAccess(array $parameters = []): bool
    {
        return Filament::auth()->user()->hasRole('super-admin') || Filament::auth()->user()->can(static::getPermissionName());
    }
}
