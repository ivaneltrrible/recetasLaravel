@extends('layouts.app')

@section('botones')
    <a href="{{ route('recetas.create') }}" class="btn btn-primary mr-2">Crear Receta</a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Administra tus recetas</h2>
    {{-- {{$recetas}} --}}
    <div class="col-md-8 mx-auto p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scol="col">Titulo</th>
                    <th scol="col">Categoria</th>
                    <th scol="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recetas as $receta)
                <tr>
                    <td>{{$receta->titulo}}</td>
                    <td>{{$receta->categoria->nombre}}</td>
                    <td>
                        <a href="#" class="btn btn-dark mr-2">Editar</a>
                        <a href="#" class="btn btn-success  mr-2">Ver</a>
                        <a href="#" class="btn btn-danger mr-2">Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
