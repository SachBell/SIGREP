@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-select ps-3 pe-3 p-2']) !!}>
    {{ $slot }}
</select>
