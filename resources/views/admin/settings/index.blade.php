@section('title', 'Configuración')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Configuraciones Generales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="h-full p-4 sm:p-8">
            <div class="flex">
                <nav class="tabs tabs-bordered tabs-vertical" aria-label="Tabs" role="tablist" data-tabs-vertical="true"
                    aria-orientation="horizontal">
                    <button type="button" class="tab active-tab:tab-active" id="tabs-vertical-item-1"
                        data-tab="#tabs-vertical-1" aria-controls="tabs-vertical-1" role="tab" aria-selected="true">
                        Home
                    </button>
                    <button type="button" class="tab active-tab:tab-active active" id="tabs-vertical-item-2"
                        data-tab="#tabs-vertical-2" aria-controls="tabs-vertical-2" role="tab"
                        aria-selected="false">
                        Profile
                    </button>
                    <button type="button" class="tab active-tab:tab-active " id="tabs-vertical-item-3"
                        data-tab="#tabs-vertical-3" aria-controls="tabs-vertical-3" role="tab"
                        aria-selected="false">
                        Messages
                    </button>
                    <button type="button" class="tab active-tab:tab-active " id="tabs-vertical-item-3"
                        data-tab="#tabs-vertical-4" aria-controls="tabs-vertical-3" role="tab"
                        aria-selected="false">
                        Messages
                    </button>
                </nav>

                <div class="ms-3 w-full">
                    <div id="tabs-vertical-1" class="hidden" role="tabpanel" aria-labelledby="tabs-vertical-item-1">
                        @include('Admin.settings.partials.convenants')
                    </div>
                    <div id="tabs-vertical-2" role="tabpanel" aria-labelledby="tabs-vertical-item-2">
                        @include('Admin.settings.partials.emails')
                    </div>
                    <div id="tabs-vertical-3" class="hidden" role="tabpanel" aria-labelledby="tabs-vertical-item-3">
                        <p class="text-base-content/80"> <span class="text-base-content font-semibold">Messages:</span>
                            View your recent messages,
                            chat with friends, and manage your conversations. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
