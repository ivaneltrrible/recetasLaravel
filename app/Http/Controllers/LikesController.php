<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //Almacenar likes de usuario
        return auth()->user()->meGusta()->toggle($receta);
    }


}
