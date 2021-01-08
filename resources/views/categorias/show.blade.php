@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="titulo-categoria text-uppercase">Por Categoria</h2>
        <div class="row">
            @foreach ($recetas as $receta)
                @include('ui.receta')
            @endforeach
        </div>
        <div class="justify-content-center d-flex mt-5">
            {{ $recetas->onEachSide(3)->links() }}
        </div>
    </div>
@endsection