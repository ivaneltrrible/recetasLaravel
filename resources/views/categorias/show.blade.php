@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="titulo-categoria text-uppercase">Por Categoria</h2>
        <div class="row">
            @foreach ($recetas as $receta)
                {{ $receta }}
                
            @endforeach
        </div>
    </div>
@endsection