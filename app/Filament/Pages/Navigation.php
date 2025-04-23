<?php

namespace App\Filament\Pages;

use App\Models\Navigation as TreePageModel;
use SolutionForest\FilamentTree\Pages\TreePage as BasePage;
use Filament\Forms\Components\TextInput;

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

    // CUSTOMIZE ICON OF EACH RECORD, CAN DELETE
    // public function getTreeRecordIcon(?\Illuminate\Database\Eloquent\Model $record = null): ?string
    // {
    //     return null;
    // }
}
