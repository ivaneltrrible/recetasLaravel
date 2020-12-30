@extends('layouts.app')

@section('styles')
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" />
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        jQuery(document).ready(function($){
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                autoplay: true,
                autoplayHoverPause: true,
                touchDrag: true,
                autoplayTimeout: 3000,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
            })
        })
    </script>
@endsection


@section('content')
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">
            Ultimas Recetas 
        </h2>
        <div class="owl-carousel owl-theme">
            @foreach ($nuevas as $nueva)
                    <div class="card">
                        <img class="card-img-top" src="../storage/{{ $nueva->imagen }}" alt="Imagen de Receta">
                        <div class="card-body justify-content-between">
                            <h4 class="card-title">{{Str::title($nueva->titulo)  }}</h4>
                            <p>{{ Str::words(strip_tags($nueva->preparacion), 15) }}</p>
                            <a href="{{ route('recetas.show', $nueva->id) }}" class="btn btn-primary d-block">Ver</a>
                        </div>
                    </div>
            @endforeach
        </div>    
    </div>
    @foreach ($recetas as $key => $grupo )
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mb-4">{{ str_replace('-',' ', $key) }}</h2>
            @foreach ($grupo as $recetas)
                @foreach ($recetas as $receta)
                    {{ $receta }}
                @endforeach
            @endforeach
        </div>
    @endforeach

@endsection


