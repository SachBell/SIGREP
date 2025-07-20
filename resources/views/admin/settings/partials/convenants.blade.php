<form action="" class="space-y-4" method="POST">
    @csrf
    @method('PUT')

    <div class="space-y-3">
        <div class="space-y-2">
            <h1 class="text-2xl font-semibold">Configuración de Convenios</h1>
            <p class="text-sm text-slate-400">
                Configuración general de convenios y como se comportan con las carreras duales y no duales.
            </p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <x-input-label :value="__('')" />
            </div>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="">
        <button type="submit"
            class="btn btn-sm h-auto py-1.5 bg-blue-800 text-white border border-none hover:bg-blue-900">Guardar</button>
    </div>
</form>
