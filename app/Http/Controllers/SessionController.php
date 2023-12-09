<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\sesiones;
use App\Models\Sesion;



class SessionController extends Controller
{
    
    public function startSession($datosUsuario){
    
    $datosUsuario2 = json_decode(json_encode($datosUsuario), true);


    Session::put('id_usuario', $datosUsuario2[0]['id_usuario']);
    Session::put('usuario', $datosUsuario2[0]['usuario']);
    Session::put('tipo_usuario', $datosUsuario2[0]['tipo_usuario']);
    Session::put('estado_usuario', $datosUsuario2[0]['estado_usuario']);
    Session::put('pack_adquirido', $datosUsuario2[0]['pack_adquirido']);


    $nuevaSesion = new sesiones;
    $miNuevaSesion = new Sesion;
    $idMaxSesion = $nuevaSesion->getIdSession();    
    $idSesion = json_decode(json_encode($idMaxSesion), true);
    Session::put('id_sesion', $idSesion[0]['MAX(id_sesion)'] + 1);
    
    $miSesion= $miNuevaSesion->setSesion($idSesion[0]['MAX(id_sesion)'] + 1, 
                                            $datosUsuario2[0]['id_usuario']);

    $nuevaSesion->insertSession($miSesion);


    return;
    }


    public function endSession(){

    $miIdSesion = Session::get('id_sesion');
    $nuevaSesion = new sesiones;
    $miNuevaSesion = new Sesion;

    $miSesion = $miNuevaSesion->setSesion($miIdSesion,'');

    $nuevaSesion->setLogout($miSesion);

    return;
        
    }

}
