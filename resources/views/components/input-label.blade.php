@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label block fs-4 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
