<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoVariables extends Model
{
    use HasFactory;

    public function setProductoVariables($idProducto, $idVariable, $cantidad100gr, $tipoProducto){
        $miProductoVariable = new \stdClass;
        $miProductoVariable->idProducto = $idProducto;
        $miProductoVariable->idVariable = $idVariable;
        $miProductoVariable->cantidad = $cantidad100gr;
        $miProductoVariable->tipoProducto = $tipoProducto;

        return $miProductoVariable;
    }
}