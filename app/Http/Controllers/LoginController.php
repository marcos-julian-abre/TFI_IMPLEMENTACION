<?php

namespace App\Http\Controllers;

use Session;
use App\Models\usuarios;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;

class LoginController extends Controller
{
    public function login(){
                
        $miLogin = new usuarios();
        $miNuevoUsuario = new Usuario();
        $miUsuario = $miNuevoUsuario->setUsuario($_POST['usuario'], $_POST['contraseña'], '','','','');
        
        $resultadoLogin = $miLogin->credentialsValidation($miUsuario); 
        
        
        if ($resultadoLogin){
            $miSesion = new SessionController();
            $miSesion->startSession($resultadoLogin);
            return redirect ('/index');
        }else {
            return redirect ('/login/1');
        }
        
    }



    public function loginView(){

    $alertaLogin = 0;
    return view('login_view',['alertaLogin' => $alertaLogin]);
    }


    public function loginAlert($alert){   
    
   $alertaLogin = $alert;
    return view('login_view',['alertaLogin' => $alertaLogin]);
    }


}
