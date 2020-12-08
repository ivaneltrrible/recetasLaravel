@extends('layouts.app')

@section('botones')
    @include('ui.navegacion')
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
                    <td class="btn-crud"> 
                        <eliminar-receta receta-id="{{ $receta->id }}">
                            
                        </eliminar-receta>
                        <a href="{{route('recetas.edit', $receta->id)}}" class="btn btn-dark w-100 d-block mb-2">Editar</a>
                        <a href="{{route('recetas.show', $receta->id)}}" class="btn btn-success  w-100 d-block mb-2">Ver</a>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex mt-4 justify-content-center col-12">
            {{ $recetas->links() }}
        </div>
        
    </div>
@endsection
