<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Models\Contracts\FilamentUser;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as BaseLogin;
use MarcoGermani87\FilamentCaptcha\Forms\Components\CaptchaField;
use Mchev\Banhammer\IP;
use Spatie\Activitylog\ActivityLogger;
use Spatie\Activitylog\ActivityLogStatus;
use Spatie\Activitylog\Models\Activity;

class Login extends BaseLogin
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => 'superadmin@test.com',
            'password' => 'superadmin',
        ]);
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(3);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        $ip = request()->ip();

        if (IP::isBanned($ip)) {
            $this->getBannedNotification()?->send();

            return null;
        } else {
            $failCount = Activity::query()
                ->where('event', 'LoginFailed')
                ->where('properties->ip', $ip)
                ->where('created_at', '>=', now()->subHour()->toDateTimeString())
                ->count();

            if ($failCount >= 5) {
                IP::ban(
                    $ip,
                    [
                        'user_agent' => request()->header('user-agent'),
                    ],
                    now()->addHour()->toDateTimeString()
                );
                $this->getBannedNotification()?->send();

                return null;
            }
        }

        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->logFailedAttempt($data, $ip);
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        if (
            ($user instanceof FilamentUser) &&
            (! $user->canAccessPanel(Filament::getCurrentPanel()))
        ) {
            Filament::auth()->logout();

            $this->throwFailureValidationException();
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }

    protected function getBannedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Login Failed')
            ->body('You have reached the maximum number of login attempts. Please try again in 1 hour.')
            ->danger();
    }

    protected function logFailedAttempt(array $data, $ip): void
    {
        $description = $data['email'].' failed to login';
        app(ActivityLogger::class)
            ->useLog(config('filament-logger.access.log_name'))
            ->setLogStatus(app(ActivityLogStatus::class))
            ->withProperties(['ip' => $ip, 'user_agent' => request()->userAgent()])
            ->event('LoginFailed')
            ->log($description);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                // CaptchaField::make('captcha'),
                $this->getRememberFormComponent(),
            ]);
    }
}
