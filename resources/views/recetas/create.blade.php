@extends('layouts.app')
@section('styles')
    {{-- Libreria de trix editor de texto como word --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.min.css"
        integrity="sha512-sC2S9lQxuqpjeJeom8VeDu/jUJrVfJM7pJJVuH9bqrZZYqGe7VhTASUb3doXVk6WtjD0O4DTS+xBx2Zpr1vRvg=="
        crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-outline-secondary mr-2 text-uppercase font-weight-bold">
        <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
        Volver
    </a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Crear Receta</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('recetas.store') }}" enctype="multipart/form-data" novalidate>
                {{-- token para enviar formularios en laravel por seguridad
                --}}
                @csrf
                <div class="form-group">
                    <label for="titulo">Titulo Receta: </label>
                    <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror"
                        value="{{ old('titulo') }}" placeholder="Titulo de Receta">

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
                            <option value="{{ $categoria->id }}" {{ old('categorias') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}
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
                    <input type="hidden" name="preparacion" id="preparacion" value="{{ old('preparacion') }}">
                    <trix-editor 
                        input="preparacion"
                        class="overflow-auto form-control @error('preparacion') is-invalid @enderror"
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
                    <input type="hidden" name="ingredientes" id="ingredientes" value="{{ old('ingredientes') }}">
                    <trix-editor
                        input="ingredientes"
                        class="overflow-auto form-control @error('ingredientes') is-invalid @enderror"
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

                <div class="form-group">
                    <input type="submit" value="Agregar Receta" class="btn btn-primary">
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
