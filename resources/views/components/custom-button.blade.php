@props(['value'])

<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center border border-transparent rounded-md transition ease-in-out duration-150']) }}>
    {{ $value ?? $slot }}
</button>
