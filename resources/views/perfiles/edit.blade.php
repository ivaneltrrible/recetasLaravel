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
    <h2 class="text-center text-primary font-weight-bold">Editar mi perfil</h2>
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 bg-white p-3">
            <form action="{{ route('perfiles.edit', $perfil->id) }}" method="POST" enctype="multipart/form-data">
                {{-- token para enviar formularios en laravel por seguridad
                --}}
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ ($perfil->name) }}" placeholder="Tu nombre">

                    @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{-- SECTION TERMINA TITULO --}}

                <div class="form-group mb-3">
                    <label for="url">Sitio web:</label>
                    
                    <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                        value="{{ ($perfil->url) }}" placeholder="Tu Sitio web">
                    @error('url')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{-- SECTION TERMINA PREPARACION --}}

                <div class="form-group">
                    <label for="biografia">Biografia:</label>
                    <input type="hidden" name="biografia" id="biografia"  value="{{ $perfil->biografia }}">
                    <trix-editor
                        input="biografia"
                        class="form-control @error('biografia') is-invalid @enderror"
                    ></trix-editor>
                    @error('biografia')
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
                    <img src="/storage/{{$perfil->imagen}}" alt="imagen de la receta" style="width: 300px">
                </div> 

                <div class="form-group">
                    <input type="submit" value="Actualizar Receta" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
    {{ $perfil->usuario->recetas }}
@endsection

@section('scripts')
    {{-- Libreria de trix editor de texto como word --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.min.js"
        integrity="sha512-8iE6dgykdask8wKpgxYbLCJMwoXudIVsYbzVk8qD7OUiaBzFLtfpmT5N6L5E1uT3j2Qjz2ynZCfDdrmAJzMkVg=="
        crossorigin="anonymous" defer></script>
@endsection

