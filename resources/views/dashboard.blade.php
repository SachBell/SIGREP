@extends('layouts.dashboard')
@section('title', 'Panel de Control')
@section('content')
    <div class="container-fluid mt-2">
        <h1>Bienvenido de nuevo {{auth()->user()->name}}</h1>
    </div>
@endsection
