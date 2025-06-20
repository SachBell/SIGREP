@section('title', __('Perfil'))
<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Perfil de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-w-7x1 mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('user.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-3xl">
                    @include('user.profile.partials.update-profile-data-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('user.profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
