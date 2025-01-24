@section('title', 'Profile')
<x-dashboard-layout>
    <div class="container-fulid p-0 d-flex">
        <div class="container-fluid w-100">
            <h2 class="fs-1">
                {{ __('Perfil de Usuario') }}
            </h2>
        </div>
    </div>
    <div class="py-12">
        <div class="mx-auto">
            <div class="p-4">
                <div>
                    @include('user.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 ">
                <div>
                    @include('user.profile.partials.update-profile-data-form')
                </div>
            </div>

            <div class="p-4 ">
                <div>
                    @include('user.profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
