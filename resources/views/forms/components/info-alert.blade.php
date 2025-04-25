@php
    $bgVar = match ($field->type) {
        'info' => '--primary-50',
        'warning' => '--warning-50',
        'danger' => '--danger-50',
        'success' => '--success-50',
        default => '--gray-50',
    };
    $borderVar = match ($field->type) {
        'info' => '--primary-200',
        'warning' => '--warning-200',
        'danger' => '--danger-200',
        'success' => '--success-200',
        default => '--gray-200',
    };
    $textVar = match ($field->type) {
        'info' => '--primary-700',
        'warning' => '--warning-700',
        'danger' => '--danger-700',
        'success' => '--success-700',
        default => '--gray-700',
    };
@endphp

<div style="
        padding: 1rem;
        border-radius: 0.5rem;
        border: 1px solid rgb(var({{ $borderVar }}, 238,238,238));
        background: rgb(var({{ $bgVar }}, 250,250,250));
        color: rgb(var({{ $textVar }}, 51,51,51));
        {{ $field->style }}
    "
    class="{{ $field->class }}">
    <span style="font-size: 0.875rem; font-weight: 500;">{{ $field->message }}</span>
</div>
