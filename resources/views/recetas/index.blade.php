@extends('layouts.app')

@section('botones')
<a href="{{ route('recetas.create') }}" class="btn btn-primary mr-2">Crear Receta</a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Administra tus recetas</h2>

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
                <tr>
                    <td>Pizza</td>
                    <td>Pizzas</td>
                    <td>
                        #
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
