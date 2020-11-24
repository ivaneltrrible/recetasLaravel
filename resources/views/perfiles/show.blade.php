@extends('layouts.app')
@section('botones')
<a href="{{ route('recetas.index') }}" class="btn btn-outline-secondary mr-2 text-uppercase font-weight-bold">
    <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
    Volver
</a>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if ( $perfil->imagen )
                    <img src="/storage/{{ $perfil->imagen }}" alt="Imagen de Perfil" class="rounded-circle w-100">
                @endif
            </div>
            <div class="col-md-7 mt-4 mt-md-0">
                <h2 class="text-center mb-2 text-primary">{{ $perfil->usuario->name }}</h2>
                <a href="{{ $perfil->usuario->url }}">Visita mi pagina web</a>
                <div class="biografia">
                    {!! $perfil->biografia !!}
                </div>
            </div>
        </div>
    </div>
    <h2 class="text-center mt-5">Recetas creadas por {{ $perfil->usuario->name }}</h2>
    <div class="container">
        <div class="row mx-auto bg-white p-4">
            @if ( count($recetas) > 0 )
                @foreach ($recetas as $receta)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="/storage/{{ $receta->imagen }}" alt="Imagen de recetas" class="card-img-top">
                            <div class="card-body">
                                <h4>{{ $receta->titulo }}</h4>
                                <a href="{{ route('recetas.show', $receta->id) }}">Ver receta</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center col-12">
                    No hay recetas creadas
                </p>
            @endif
        </div>
    </div>
@endsection