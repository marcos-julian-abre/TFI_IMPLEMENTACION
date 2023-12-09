<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    public function setSesion($idSesion, $idUsuario){
        $miSesion = new \stdClass;
        $miSesion->idSesion = $idSesion;
        $miSesion->idUsuario = $idUsuario;

        return $miSesion;
    }
}
