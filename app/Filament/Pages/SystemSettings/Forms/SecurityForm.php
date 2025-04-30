<?php

declare(strict_types=1);

namespace App\Filament\Pages\SystemSettings\Forms;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class SecurityForm
{
    public static function get()
    {
        return [
            TextInput::make('login_attempts_rate_limit')
                ->label('Login Attempts Rate Limit')
                ->numeric(),
            TextInput::make('login_attempts_lockout_window')
                ->label('Login Attempts Lockout Window')
                ->numeric()
                ->helperText('in minutes'),
            TextInput::make('login_attempts_lockout_attempts')
                ->label('Login Attempts Lockout Attempts')
                ->numeric()
                ->helperText('max attempts before lockout'),
            TextInput::make('login_attempts_lockout_duration')
                ->label('Login Attempts Lockout Duration')
                ->numeric()
                ->helperText('in minutes'),
            Toggle::make('enable_login_captcha')
                ->label('Enable Login Captcha')
                ->inline(false),
        ];
    }
}
