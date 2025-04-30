<?php

declare(strict_types=1);

namespace App\Filament\Pages\SystemSettings\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ApplicationForm
{
    public static function get()
    {
        return [
            TextInput::make('site_name')
                ->label('Site Name')
                ->autofocus()
                ->required()
                ->columnSpanFull(),
            TextInput::make('site_title')
                ->label('Site Title')
                ->columnSpanFull(),
            Textarea::make('site_description')
                ->label('Site Description')
                ->columnSpanFull(),
            Grid::make()->schema([
                FileUpload::make('site_logo')
                    ->label('Site Logo')
                    ->image()
                    ->directory('assets')
                    ->visibility('public')
                    ->moveFiles()
                    ->imageEditor()
                    ->storeFileNamesIn('attachment_file_names'),
                FileUpload::make('site_favicon')
                    ->label('Site Favicon')
                    ->image()
                    ->directory('assets')
                    ->visibility('public')
                    ->moveFiles()
                    ->storeFileNamesIn('attachment_file_names')
                    ->acceptedFileTypes(['image/x-icon', 'image/vnd.microsoft.icon']),
            ]),
        ];
    }
}
