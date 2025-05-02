<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Filament\Clusters\NewsCluster;
use App\Models\NewsCategory as TreePageModel;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use SolutionForest\FilamentTree\Pages\TreePage as BasePage;

class NewsCategory extends BasePage
{
    use HasPageShield;

    protected static string $model = TreePageModel::class;

    protected static ?string $cluster = NewsCluster::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static int $maxDepth = 3;

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
        ];
    }

    protected function hasDeleteAction(): bool
    {
        return true;
    }

    protected function hasEditAction(): bool
    {
        return true;
    }

    protected function hasViewAction(): bool
    {
        return false;
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    public static function canAccess(array $parameters = []): bool
    {
        /** @var ?\App\Models\Admin $admin */
        $admin = Filament::auth()->user();

        return $admin->hasRole('super-admin') || $admin->can(static::getPermissionName());
    }
}
