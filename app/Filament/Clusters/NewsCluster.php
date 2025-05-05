<?php

declare(strict_types=1);

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class NewsCluster extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 20;

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.content');
    }
}
