@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label fs-4 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
