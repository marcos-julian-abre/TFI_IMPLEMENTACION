<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function setProducto($idProducto, 
                                $nombreProducto, 
                                $tipoProducto,
                                $aptoVegano,
                                $aptoVegetariano,
                                $aptoDiabetico,
                                $nutritionalScore,
                                $pesoProducto){
        $miProducto = new \stdClass;
        $miProducto->idProducto = $idProducto;
        $miProducto->nombreProducto = $nombreProducto;
        $miProducto->tipoProducto = $tipoProducto;
        $miProducto->aptoVegano = $aptoVegano;
        $miProducto->aptoVegetariano = $aptoVegetariano;
        $miProducto->aptoDiabetico = $aptoDiabetico;
        $miProducto->nutritionalScore = $nutritionalScore;
        $miProducto->pesoProducto = $pesoProducto;
        

        return $miProducto;
    }
}
