@section('title', 'Profile')
<x-dashboard-layout>
    <div class="container-fluid d-flex flex-column justify-content-end mx-0 my-2">
        <div name="header">
            <h2 class="fs-1">
                {{ __('Perfil de Usuario') }}
            </h2>
        </div>

        <div class="py-12">
            <div class="mx-auto">
                <div class="p-4">
                    <div>
                        @include('admin.profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 ">
                    <div>
                        @include('admin.profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
