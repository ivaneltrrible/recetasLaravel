<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikesController extends Controller
{
    //Restrinccion para dar likes - tiene que estar resgistrado para dar like a receta
    public function __construct()
    {
        $this->middleware('auth');
    }

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
