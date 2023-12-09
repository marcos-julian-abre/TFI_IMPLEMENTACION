<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaUsuario extends Model
{
    use HasFactory;
    public function setAuditoriaUsuario($username, $pass, $tipo, $idUsuario, $estado, $pack, $idAuditoria,$idSesion){
        $miAuditoriaUsuario = new \stdClass;
        $miAuditoriaUsuario->username = $username;
        $miAuditoriaUsuario->pass = $pass;
        $miAuditoriaUsuario->tipo = $tipo;
        $miAuditoriaUsuario->idUsuario = $idUsuario;
        $miAuditoriaUsuario->estado = $estado;
        $miAuditoriaUsuario->pack = $pack;
        $miAuditoriaUsuario->idAuditoria = $idAuditoria;
        $miAuditoriaUsuario->idSesion = $idSesion;

        
        
       
        return $miAuditoriaUsuario; 
    }

}
