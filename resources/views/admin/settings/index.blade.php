@section('title', 'Configuración')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Configuraciones Generales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="h-full p-4 sm:p-8">
            <div class="flex flex-col lg:flex-row gap-5">
                <nav class="tabs tabs-bordered lg:tabs-vertical" aria-label="Tabs" role="tablist" data-tabs-vertical="false"
                    aria-orientation="horzontal">
                    <button type="button" class="tab active-tab:tab-active active" id="tabs-horizontal-item-1"
                        data-tab="#tabs-horizontal-1" aria-controls="tabs-horizontal-1" role="tab" aria-selected="true">
                        <span class="icon-[tabler--settings] size-5 me-2"></span>
                        <span class="font-medium">General</span>
                    </button>
                    <button type="button" class="tab active-tab:tab-active" id="tabs-horizontal-item-2"
                        data-tab="#tabs-horizontal-2" aria-controls="tabs-horizontal-2" role="tab"
                        aria-selected="false">
                        <span class="icon-[tabler--mail] size-5 me-2"></span>
                        <span class="font-medium">Correos</span>
                    </button>
                </nav>

                <div class="lg:ms-3 w-full">
                    <div id="tabs-horizontal-1" role="tabpanel" aria-labelledby="tabs-horizontal-item-1">
                        @include('Admin.settings.partials.general')
                    </div>
                    <div id="tabs-horizontal-2" class="hidden" role="tabpanel" aria-labelledby="tabs-horizontal-item-2">
                        @include('Admin.settings.partials.emails')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
