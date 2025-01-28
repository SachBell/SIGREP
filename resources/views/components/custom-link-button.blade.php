@props(['value', 'link'])

<a
    {{ $attributes->merge(['href' => $link, 'class' => 'inline-flex items-center border border-transparent rounded-md transition ease-in-out duration-150']) }}>
    {{ $value ?? $slot }}
</a>
