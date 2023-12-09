<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendacion extends Model
{
    use HasFactory;

    public function setRecomendacion($idProducto, 
                                $idUsuario, 
                                $RecomendacionProducto,
                                $idRecomendacion){
        $miRecomendacion = new \stdClass;
        $miRecomendacion->idProducto = $idProducto;
        $miRecomendacion->idUsuario = $idUsuario;
        $miRecomendacion->recomendacionProducto = $RecomendacionProducto;
        $miRecomendacion->idRecomendacion = $idRecomendacion;
        

        return $miRecomendacion;
    }
}
