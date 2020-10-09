@extends('layouts.app')

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
