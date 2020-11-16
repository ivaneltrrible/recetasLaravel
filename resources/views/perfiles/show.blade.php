@extends('layouts.app')

@section('content')
    {{ $perfil->usuario->recetas }}
@endsection