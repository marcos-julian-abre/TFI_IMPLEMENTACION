<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoPaquete extends Model
{
    use HasFactory;

    public function setProductoPaquete($idProductoPaquete, 
                                $idProducto, 
                                $pesoProductoPaquete, 
                                $precioProductoPaquete,
                                $idMaxProductoCanasta){
                    $miProductoPaquete = new \stdClass;
                    $miProductoPaquete->idProductoPaquete = $idProductoPaquete;
                    $miProductoPaquete->idProducto = $idProducto;
                    $miProductoPaquete->pesoProductoPaquete = $pesoProductoPaquete;
                    $miProductoPaquete->precioProductoPaquete = $precioProductoPaquete;
                    $miProductoPaquete->idMaxProductoCanasta = $idMaxProductoCanasta;
                
return $miProductoPaquete;
}
}