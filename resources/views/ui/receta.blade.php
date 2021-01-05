<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/storage/{{ $receta->imagen }}" alt="Imagen de Receta" class="card-img-top">
        <div class="card-body">
            <h3 class="card-title">{{ $receta->titulo }}</h3>
            <div class="meta-receta d-flex justify-content-between">
                <p class="text-primary fecha font-weight-bold">
                    @php
                        $fecha = $receta->created_at
                    @endphp
                    <fecha-receta fecha="{{$fecha}}"></fecha-receta>
                </p>
                <p>
                    {{ count($receta->likes) }} Les gusto
                </p>
                
            </div>
            <div class="card-text d-flex justify-content-between flex-column h-100">
                <p>{{ Str::words(strip_tags($receta->preparacion), 20, '...') }}</p>
                <a class="d-block btn btn-primary font-weight-bold text-uppercase" href="{{ route('recetas.show', $receta->id) }}">Ver Receta</a>
            </div>
        </div>
    </div>
</div>