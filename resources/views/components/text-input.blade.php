@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'input py-2 px-3 h-auto border border-gray-300 focus:border-1 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm']) !!}>
