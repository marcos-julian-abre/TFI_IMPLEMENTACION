<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model 
{
    use HasFactory;
    public function setMeta($idMeta, $idUsuario, $restriccion, $descripcion, $idUsuarioMeta, $idVariable){
        $miMeta = new \stdClass;
        $miMeta->idMeta = $idMeta;
        $miMeta->idUsuario = $idUsuario;
        $miMeta->restriccion = $restriccion;   
        $miMeta->descripcion = $descripcion;     
        $miMeta->idUsuarioMeta = $idUsuarioMeta;
        $miMeta->idVariable = $idVariable;
       
        return $miMeta; 
    }


}
