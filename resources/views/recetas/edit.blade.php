@extends('layouts.app')
@section('styles')
    {{-- Libreria de trix editor de texto como word --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.min.css"
        integrity="sha512-sC2S9lQxuqpjeJeom8VeDu/jUJrVfJM7pJJVuH9bqrZZYqGe7VhTASUb3doXVk6WtjD0O4DTS+xBx2Zpr1vRvg=="
        crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2">Volver</a>
@endsection

@section('content')
<h2 class="text-center mb-5">Editar Receta: {{$receta->titulo}}</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('recetas.update', $receta->id) }}" enctype="multipart/form-data" novalidate>
                {{-- token para enviar formularios en laravel por seguridad
                --}}
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="titulo">Titulo Receta: </label>
                    <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror"
                        value="{{ ($receta->titulo) }}" placeholder="Titulo de Receta">

                    @error('titulo')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{-- SECTION TERMINA TITULO --}}
                <div class="form-group">
                    <label for="categorias">Categorias: </label>
                    <select name="categorias" id="categorias"
                        class="form-control @error('categorias') is-invalid @enderror">
                        <option value="">-- Selecciona una opcion --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $receta->id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categorias')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                {{-- SECTION TERMINA CATEGORIAS --}}

                <div class="form-group mb-3">
                    <label for="preparacion">Preparacion:</label>
                    <input type="hidden" name="preparacion" id="preparacion" value="{{ $receta->preparacion }}">
                    <trix-editor 
                        input="preparacion"
                        class="form-control @error('preparacion') is-invalid @enderror"
                    ></trix-editor>
                    @error('preparacion')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{-- SECTION TERMINA PREPARACION --}}

                <div class="form-group">
                    <label for="ingredientes">Ingredientes:</label>
                    <input type="hidden" name="ingredientes" id="ingredientes"  value="{{ $receta->ingredientes }}">
                    <trix-editor
                        input="ingredientes"
                        class="form-control @error('ingredientes') is-invalid @enderror"
                    ></trix-editor>
                    @error('ingredientes')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{-- SECTION TERMINA INGREDIENTES --}}

                <div class="form-group">
                    <label for="imagen">Elige una imagen</label>

                    <input type="file"
                            class="form-control @error('imagen')is-invalid @enderror"
                            name="imagen"
                            id="imagen"
                    >
                    @error('imagen')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <p>Imagen actual: </p>
                    <img src="/storage/{{$receta->imagen}}" alt="imagen de la receta" style="width: 300px">
                </div> 

                <div class="form-group">
                    <input type="submit" value="Actualizar Receta" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Libreria de trix editor de texto como word --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.min.js"
        integrity="sha512-8iE6dgykdask8wKpgxYbLCJMwoXudIVsYbzVk8qD7OUiaBzFLtfpmT5N6L5E1uT3j2Qjz2ynZCfDdrmAJzMkVg=="
        crossorigin="anonymous" defer></script>
@endsection
