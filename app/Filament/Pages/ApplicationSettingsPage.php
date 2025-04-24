<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Filament\Pages\ApplicationSettings\Forms\ApplicationForm;
use App\Filament\Pages\ApplicationSettings\Forms\MailForm;
use App\Settings\ApplicationSettings;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ApplicationSettingsPage extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $title = 'Application Settings';

    protected static ?string $slug = 'settings/application';

    protected static ?string $navigationGroup = 'Settings';

    protected static string $settings = ApplicationSettings::class;

    public function mount(): void
    {
        parent::mount();
    }

    public function form(Form $form): Form
    {
        $arrTabs = [];

        $arrTabs[] = Tabs\Tab::make('Application Tab')
            ->label('Application')
            ->icon('heroicon-o-tv')
            ->schema(ApplicationForm::get());

        $arrTabs[] = Tabs\Tab::make('Mail Tab')
            ->label('Mail')
            ->icon('heroicon-o-tv')
            ->schema(MailForm::get());

        return $form
            ->columns(1)
            ->schema([
                Tabs::make('Tabs')
                    ->tabs($arrTabs)
                    ->activeTab(1),
            ]);
    }
}
