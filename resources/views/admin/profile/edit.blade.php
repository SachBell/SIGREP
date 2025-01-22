@section('title', 'Profile')
<x-dashboard-layout>
    <div class="container-fulid p-0 d-flex">
        <div class="container-fluid w-100">
            <h2 class="fs-1">
                {{ __('Perfil de Usuario') }}
            </h2>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <button id="toggle-btn" class="btn btn-primary mx-3">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
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
</x-dashboard-layout>
