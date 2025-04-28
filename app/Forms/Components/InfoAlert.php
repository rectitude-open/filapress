<?php

declare(strict_types=1);

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class InfoAlert extends Field
{
    public string $message = '';

    public string $type = 'default';

    public string $class = '';

    public string $style = '';

    protected string $view = 'forms.components.info-alert';

    protected function setUp(): void
    {
        $this->hiddenLabel();
        $this->dehydrated(false);
    }

    public function message(string $message)
    {
        $this->message = $message;

        return $this;
    }

    public function type(string $type)
    {
        $this->type = $type;

        return $this;
    }

    public function class(string $class)
    {
        $this->class = $class;

        return $this;
    }

    public function style(string $style)
    {
        $this->style = $style;

        return $this;
    }
}
