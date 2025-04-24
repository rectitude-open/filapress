<?php

declare(strict_types=1);

namespace App\Filament\Pages\ApplicationSettings\Forms;

use Filament\Forms\Components\TextInput;

class MailForm
{
    public static function get()
    {
        return [
            TextInput::make('mail_from_email')
                ->label('From Email')
                ->maxLength(255),
            TextInput::make('mail_from_name')
                ->label('From Name')
                ->maxLength(255),
            TextInput::make('mail_host')
                ->label('Host')
                ->maxLength(255),
            TextInput::make('mail_port')
                ->label('Port')
                ->numeric()
                ->maxLength(5),
            TextInput::make('mail_username')
                ->label('Username')
                ->maxLength(255),
            TextInput::make('mail_password')
                ->label('Password')
                ->password()
                ->maxLength(255),
        ];
    }
}
