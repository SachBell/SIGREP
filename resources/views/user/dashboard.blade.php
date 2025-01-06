@extends('layouts.dashboard')
@section('title', 'Panel de Control')
@section('content')
    <div class="container-fluid d-flex justify-content-end mx-0 my-2">
        <div class="container-fluid w-100">
            <h2>Bienvenido de nuevo {{ auth()->user()->name }}</h2>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <button id="toggle-btn" class="btn btn-primary mx-3">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
@endsection

