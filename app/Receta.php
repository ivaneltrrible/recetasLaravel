<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //
    protected $fillable = [
        'titulo', 'ingredientes', 'preparacion', 'imagen', 'user_id', 'categoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class, 'categoria_id');
    }
    public function autor()
    {
        // user_id se refiere al FK de recetas al que esta conectada a los usuarios
        return $this->belongsTo(User::class, 'user_id');
    }

    /**Cantidad de likes que se le dio a la receta por los usuarios */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
