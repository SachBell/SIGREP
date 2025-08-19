@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'select py-2 px-3 h-auto border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm transition',
]) !!}>
    {{ $slot }}
</select>
