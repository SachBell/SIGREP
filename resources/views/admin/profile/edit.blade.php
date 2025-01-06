@extends('layouts.dashboard')
@section('title', 'Profile')
@section('content')
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
@endsection
