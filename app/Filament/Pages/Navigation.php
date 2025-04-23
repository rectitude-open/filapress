<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Models\Navigation as TreePageModel;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\Model;
use SolutionForest\FilamentTree\Pages\TreePage as BasePage;

class Navigation extends BasePage
{
    protected static string $model = TreePageModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?int $navigationSort = 99;

    public static function getNavigationLabel(): string
    {
        return __('menu.nav_item.navigation');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.content');
    }

    protected static int $maxDepth = 2;

    protected function getActions(): array
    {
        return [
            $this->getCreateAction()->icon('heroicon-o-plus'),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->label(__('Title'))
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            TextInput::make('url')
                ->label(__('URL'))
                ->maxLength(255)
                ->dehydrateStateUsing(fn ($state) => $state ? $state : '')
                ->columnSpanFull(),
            ToggleButtons::make('is_active')
                ->options([
                    1 => 'Active',
                    0 => 'Inactive',
                ])
                ->default(1)
                ->colors([
                    1 => 'success',
                    0 => 'warning',
                ])
                ->icons([
                    1 => 'heroicon-o-check-circle',
                    0 => 'heroicon-o-x-circle',
                ])
                ->inline(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    /**
     * @param  \App\Models\Navigation|null  $record
     */
    public function getTreeRecordTitle(?Model $record = null): string
    {
        if (! $record) {
            return '';
        }

        $title = $record->title ?? '';
        $url = $record->url ? ' - '.$record->url : '';
        $badge = $record->is_active ? '' : '[Inactive] ';

        return "$badge$title$url";
    }

    protected function getTreeActions(): array
    {
        return [
            $this->getEditAction(),
            $this->getDeleteAction(),
        ];
    }
}
