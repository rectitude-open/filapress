<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Policies\ActivityPolicy;
use App\Policies\FolderPolicy;
use App\Policies\MailLogPolicy;
use App\Policies\MediaPolicy;
use App\Settings\ApplicationSettings;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\FontProviders\LocalFontProvider;
use Filament\Forms\Components\DateTimePicker;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Livewire\Livewire;
use MarcoGermani87\FilamentCaptcha\FilamentCaptcha;
use Spatie\Activitylog\Models\Activity;
use Tapp\FilamentMailLog\FilamentMailLogPlugin;
use Tapp\FilamentMailLog\Models\MailLog;
use TomatoPHP\FilamentMediaManager\FilamentMediaManagerPlugin;
use TomatoPHP\FilamentMediaManager\Models\Folder;
use TomatoPHP\FilamentMediaManager\Models\Media;
use TomatoPHP\FilamentUsers\FilamentUsersPlugin;
use RectitudeOpen\FilamentBanManager\FilamentBanManagerPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/admin-assets/'.config('admin.path').'/livewire/livewire.js', $handle);
        });

        Notifications::alignment(Alignment::Center);

        DateTimePicker::configureUsing(function (DateTimePicker $component): void {
            $component->format('Y-m-d H:i:s');
            $component->displayFormat('Y-m-d H:i:s');
        });

        TextColumn::configureUsing(function (TextColumn $component): void {
            if (in_array($component->getName(), ['created_at', 'updated_at', 'published_at', 'email_verified_at'])) {
                $component->dateTime('Y-m-d H:i:s');
            }
        });

        Gate::policy(MailLog::class, MailLogPolicy::class);
        Gate::policy(Activity::class, ActivityPolicy::class);
        Gate::policy(Folder::class, FolderPolicy::class);
        Gate::policy(Media::class, MediaPolicy::class);
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin-'.config('admin.path'))
            ->path('admin-'.config('admin.path'))
            ->login(Login::class)
            ->brandName(fn () => ApplicationSettings::getSiteName())
            ->brandLogo(fn () => ApplicationSettings::getLogoUrl())
            ->favicon(fn () => ApplicationSettings::getFaviconUrl())
            ->navigationGroups([
                NavigationGroup::make()
                    ->label(__('menu.nav_group.content')),
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
                url: asset('/admin-assets/'.config('admin.path').'/css/fonts.css'),
                provider: LocalFontProvider::class,
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
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
                FilamentCaptcha::make(),
                FilamentMailLogPlugin::make(),
                FilamentBanManagerPlugin::make()
            ])
            ->resources([
                config('filament-logger.activity_resource'),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
        // ->authGuard('admin');
        // ->assets([
        //     Css::make('common-form', resource_path('css/common/form.css')),
        // ]);
    }
}
