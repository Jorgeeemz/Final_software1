<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "api_beeweb";
    
    public $timestamps = true;

    protected $fillable = [
        'nombreProducto',
        'costoProducto',
        'cantidadProducto',
        'descripcionProducto'
    ];
}
