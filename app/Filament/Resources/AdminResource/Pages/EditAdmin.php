<?php

declare(strict_types=1);

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use App\Models\Admin;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

    public function mutateFormDataBeforeSave(array $data): array
    {
        $getAdmin = Admin::where('email', $data['email'])->first();
        if ($getAdmin) {
            if (empty($data['password'])) {
                $data['password'] = $getAdmin->password;
            }
        }

        return $data;
    }

    protected function getActions(): array
    {
        // ! config('filament-users.impersonate') ?: $ret[] = Impersonate::make()->record($this->getRecord());
        $ret[] = DeleteAction::make();

        return $ret;
    }
}
