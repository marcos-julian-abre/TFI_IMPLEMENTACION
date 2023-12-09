<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCanasta extends Model
{
    use HasFactory;

    public function setProductoCanasta($id, $cantidad, $idCanasta){
$miProductoCanasta = new \stdClass;
$miProductoCanasta->id = $id;
$miProductoCanasta->cantidad = $cantidad;
$miProductoCanasta->idCanasta = $idCanasta;


return $miProductoCanasta;

    }

}
