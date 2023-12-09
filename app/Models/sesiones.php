<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\SessionController;
use DB;

class sesiones extends Model
{
    use HasFactory;

    public function insertSession($miSesion){

        $altaNuevaSesion = "INSERT INTO sesiones (id_sesion, id_usuario, fecha_inicio) VALUES (?,?, NOW())";
          
        DB::select($altaNuevaSesion, array($miSesion->idSesion, $miSesion->idUsuario));

        return;
    
        }

    public function getIdSession(){

        $consultaIdSesion = "SELECT MAX(id_sesion) FROM sesiones";

        $idSesionMax = DB::select($consultaIdSesion, array());

        return $idSesionMax;
   
    }


    public function setLogout($miSesion){

    $altaLogout = "UPDATE sesiones set fecha_fin = NOW() WHERE id_sesion = ?";

    DB::update($altaLogout, array($miSesion->idSesion));

    return; 


    }

}
