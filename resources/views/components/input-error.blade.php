@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'error-content']) }}>
        @foreach ((array) $messages as $message)
            <small class="text-wrap">{{ $message }}</small>
        @endforeach
    </div>
@endif
