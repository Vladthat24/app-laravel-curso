<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //FILLABLE considera estos campos
    //protected $fillable=['nombre','descripcion','categoria'];

    //IGNORE ESTOS CAMPOS
    //protected $guarded=['status'];
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
