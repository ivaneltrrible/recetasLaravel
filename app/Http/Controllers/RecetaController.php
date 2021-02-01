<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    public function __construct()
    {
        /* Validar que este logueado el usuario */
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Auth::user()->recetas->dd();
        // dd($usuario);

        //Obtener las recetas del usuario autentificado
        /* $recetas = auth()->user()->recetas; */



        //Obtener id de usuario autentificado en el momento
        $usuario = auth()->user();

        //Obtener la informacion ya paginada desde una consulta
        $recetas = Receta::where('user_id', $usuario->id)->paginate(2);

        return view('recetas.index', compact('recetas', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request['imagen']->store('upload-recetas', 'public'));
        /* Validacion de los datos enviados desde el formulario */
        $data = request()->validate([
            'titulo' => 'required|min:6|max:100',
            'categorias' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
        ]);

        //Obtener la ruta de img ingresada en el form
        $ruta_img = $request['imagen']->store('upload-recetas', 'public');

        //Resize de img
        $img = Image::make(public_path("storage/{$ruta_img}"))->fit(1000, 550);
        $img->save();

        /* Query a realizar en la BD (sin modelo) */
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'ingredientes' => $data['ingredientes'],
        //     'preparacion' => $data['preparacion'],
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categorias'],
        //     'imagen' => $ruta_img
        // ]);

        //Insertar receta a BD con modelo
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'categoria_id' => $data['categorias'],
            'imagen' => $ruta_img,
        ]);

        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //Saber a que receta se le dio like
        $like = ( auth()->user() ) ? auth()->user()->meGusta->contains($receta->id) : false;

        //Pasar la cantidad de likes a la vista
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        ////Validamos con policies que sea la misma persona que quiere editar
        $this->authorize('view', $receta);

        // $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //policies si es el usuario que creo la receta entonces la puede actualizar
        $this->authorize('update', $receta);

        //Validar formulario de editar receta
        $data = request()->validate([
            'titulo' => 'required|min:6|max:100',
            'categorias' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ]);
        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categorias'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];

        if (request('imagen')) {
            //Obtener la ruta de img ingresada en el form
            $ruta_img = $request['imagen']->store('upload-recetas', 'public');

            //Resize de img
            $img = Image::make(public_path("storage/{$ruta_img}"))->fit(1000, 550);
            $img->save();

            //asignar al objeto
            $receta->imagen = $ruta_img;
        }

        //Guardar los cambios
        $receta->save();

        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        /*return 'eliminando...';*/
        //Validacion de policy
        $this->authorize('delete', $receta);

        //Eliminar de DB y DOM
        $receta->delete();

        return redirect()->action('RecetaController@index');
    }
    
    //Metodo para buscar consultas desde el index SEARCH input
    public function search(Request $request)
    {
        $search_receta = $request['buscar'];

        $recetas = Receta::where('titulo', 'like', '%'.$search_receta.'%')->paginate(10);
        $recetas->appends(['buscar' => $search_receta]);

        return view('buscador.show', compact('recetas', 'search_receta'));
    }
}
