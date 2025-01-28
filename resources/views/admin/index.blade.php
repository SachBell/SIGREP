@section('title', 'Panel de Control')
<x-dashboard-layout>
    <div class="mx-4">
        <div class="flex">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tigth">
                {{ __('Bienvenido de nuevo ' . auth()->user()->name) }}
            </h2>
        </div>
    </div>
</x-dashboard-layout>
