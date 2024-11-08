@extends('layouts.app')
@section('title', 'Panel de Control')
@section('content')
    <h1>Estas en el panel</h1>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Salir
        </a>
    </form>
@endsection
