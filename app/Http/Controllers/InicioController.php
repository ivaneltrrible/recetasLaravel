<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //Metodo de index
    public function index()
    {
         //Ultimas recetas se obtienen
        $nuevas = Receta::latest()->take(5)->get();

        //Obtener todas las categorias de las recetas
        $categorias = CategoriaReceta::all();

        //Agrupamos en categorias las recetas 
        $recetas = [];
        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(2)->get();
        }
        return view('inicio.index', compact('nuevas', 'recetas'));
    }

}
