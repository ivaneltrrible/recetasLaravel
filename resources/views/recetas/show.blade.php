@extends('layouts.app')

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
        Volver
    </a>
    <a href="{{ url()->previous() }}" class="btn btn-outline-success mr-2 text-uppercase font-weight-bold">
        <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
        Volver al perfil
    </a>
@endsection

@section('content')
    {{-- <p>{{ $receta }}</p> --}}

    <article class="contenido-recetas">
        <h2 class="text-center mb-4">{{ $receta->titulo }}</h2>
        <div class="receta-imagen">
            <img src="/storage/{{ $receta->imagen }}" alt="Imagen de la receta" class="w-100 mb-4">
        </div>

        <div class="receta-meta">
            <p>
                <span class="text-primary font-weight-bold">
                    Escrito en:
                </span>
                {{ $receta->categoria->nombre }}
            </p>
            <p>
                <span class="text-primary font-weight-bold">
                    Autor:
                </span>
                {{ $receta->autor->name}}
            </p>
            <p>
                <span class="text-primary font-weight-bold">
                    Fecha:
                </span>
                @php
                    $fecha = $receta->created_at
                @endphp
                <fecha-receta fecha="{{$fecha}}"></fecha-receta>
            </p>
            
            <div class="ingredientes">
                <h2 class="text-primary my-2">
                    Ingredientes:
                </h2>
                {!! $receta->ingredientes !!}
            </div>
            <div class="preparacion">
                <h2 class="text-primary my-2">
                    Preparacion:
                </h2>
                {!! $receta->preparacion !!}
            </div>
        </div>

    </article>
@endsection
