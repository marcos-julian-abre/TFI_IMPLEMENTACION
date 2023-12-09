<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public function setUsuario($username, $pass, $tipo, $id, $estado, $pack){
        $miUsuario = new \stdClass;
        $miUsuario->username = $username;
        $miUsuario->pass = $pass;
        $miUsuario->tipo = $tipo;
        $miUsuario->id = $id;
        $miUsuario->estado = $estado;
        $miUsuario->pack = $pack;
        
       
        return $miUsuario; 
    }
}
