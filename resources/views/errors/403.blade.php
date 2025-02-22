@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message')

    @if ($exception->getMessage())
        {{ $exception->getMessage() }}
    @endif

@endsection
