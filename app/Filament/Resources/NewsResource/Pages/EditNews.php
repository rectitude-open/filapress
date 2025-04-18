<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use App\Filament\Common\BaseEditRecord;

class EditNews extends BaseEditRecord
{
    protected static string $resource = NewsResource::class;
}
