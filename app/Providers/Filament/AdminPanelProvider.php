<?php

namespace App\Providers\Filament;

use App\Settings\ApplicationSettings;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\FontProviders\LocalFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\Livewire\Notifications;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Livewire\Livewire;
use TomatoPHP\FilamentMediaManager\FilamentMediaManagerPlugin;
use TomatoPHP\FilamentUsers\FilamentUsersPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/assets/admin-'.config('admin.path').'/livewire/livewire.js', $handle);
        });

        Notifications::alignment(Alignment::Center);
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin-'.config('admin.path'))
            ->path('admin-'.config('admin.path'))
            ->login()
            ->brandName(ApplicationSettings::getSiteName())
            ->brandLogo(ApplicationSettings::getLogoUrl())
            ->favicon(ApplicationSettings::getFaviconUrl())
            ->navigationGroups([
                NavigationGroup::make()
                    ->label(__('menu.nav_group.content'))
                    ->collapsed(),
                NavigationGroup::make()
                    ->label(__('menu.nav_group.security'))
                    ->collapsed(),
                NavigationGroup::make()
                    ->label(__('menu.nav_group.settings'))
                    ->collapsed(),
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->font(
                'Inter',
                url: asset('/assets/admin-'.config('admin.path').'/css/fonts.css'),
                provider: LocalFontProvider::class,
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                SetTheme::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                FilamentMediaManagerPlugin::make(),
                FilamentUsersPlugin::make(),
                ThemesPlugin::make(),
            ])
            ->resources([
                config('filament-logger.activity_resource'),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
