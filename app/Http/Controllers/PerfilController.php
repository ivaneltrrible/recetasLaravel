<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        /* Validar que este logueado el usuario */
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Obtener las recetas con paginacion
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(2);
        
        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //Validar con policy si es el mismo usuario autentificado
        $this->authorize('view', $perfil);
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //Ejecutar Policy para validar que sea el usuario auth sea el mismo que modifica
        $this->authorize('update', $perfil);

        //Validando formulario
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'url'],
            'biografia' => 'string|max:1500'
        ]);

        //IF image up for user
        if ( $request['imagen'] ) {
            //Get image and create folder 
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            //Resize image with intervention image
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            //Create array with img and route from img
            $array_imagen = ['imagen' => $ruta_imagen];

        }
        
        //asign URL and name
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['name'];
        auth()->user()->save();

        //Delete from array fiel name and url because perfil don't have
        unset($data['url']);
        unset($data['name']);
        
        
        //Asignar biografia e imagen
        auth()->user()->perfil()->update(array_merge(
            $data,
            $array_imagen ?? []
        ));

        //Regresar a pagina principal
        return redirect()->route('recetas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
