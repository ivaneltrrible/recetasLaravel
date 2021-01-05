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
        //Obtener las recetas mas votadas
        // $votadas = Receta::has('likes', '>=', 1)->get();
        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();
        
         //Ultimas recetas se obtienen
        $nuevas = Receta::latest()->take(5)->get();

        //Obtener todas las categorias de las recetas
        $categorias = CategoriaReceta::all();

        //Agrupamos en categorias las recetas 
        $recetas = [];
        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(2)->get();
        }
        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }

}
