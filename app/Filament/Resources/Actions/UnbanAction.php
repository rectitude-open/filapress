<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Mchev\Banhammer\IP;

class UnbanAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'unban';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('Unban'));

        $this->icon('heroicon-o-x-circle');

        $this->color('danger');

        $this->requiresConfirmation();

        $this->action(function (): void {
            $this->process(function (array $data, Model $record, Table $table) {
                if ($record->bannable_type && $record->bannable_id) {
                    $model = $record->bannable_type::find($record->bannable_id);
                    if ($model && method_exists($model, 'unban')) {
                        $model->unban();
                    }
                } else {
                    IP::unban($record->ip);
                }
            });

            $this->success();
        });
    }
}
