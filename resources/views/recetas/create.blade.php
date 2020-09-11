@extends('layouts.app')

@section('botones')
<a href="{{route('recetas.index')}}" class="btn btn-primary mr-2">Volver</a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Crear Receta</h2>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-8">
        <form method="post" action="{{route('recetas.store')}}" novalidate>
                {{-- token para enviar formularios en laravel por seguridad --}}
                @csrf
                <div class="form-group">
                    <label for="titulo">Titulo Receta: </label>
                    <input
                    type="text"
                    name="titulo"
                    id="titulo"
                    class="form-control @error('titulo') is-invalid @enderror"
                    value="{{old('titulo')}}"
                    placeholder="Titulo de Receta">

                   @error('titulo')
                       <span class="invalid-feedback d-block" role="alert">
                       <strong>{{$message}}</strong>
                       </span>
                   @enderror
                </div>
                <div class="form-group">
                    <input type="submit" value="Agregar Receta" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection
