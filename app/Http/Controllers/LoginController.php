<?php

namespace App\Http\Controllers;

use Session;
use App\Models\usuarios;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;

class AuthenticationFacade
{
    public function attemptLogin($username, $password)
    {
        $miNuevoUsuario = new Usuario();
        $miUsuario = $miNuevoUsuario->setUsuario($username, $password, '', '', '', '');

        $miLogin = new usuarios();
        $resultadoLogin = $miLogin->credentialsValidation($miUsuario);

        return $resultadoLogin;
    }

    public function startSession($userData)
    {
        $miSesion = SessionController::getInstance();
        $miSesion->startSession($userData);
    }
}

class LoginController extends Controller
{
    public function login()
    {
        $authFacade = new AuthenticationFacade();
    
        $username = $_POST['usuario'];
        $password = $_POST['contraseña'];
    
        $resultadoLogin = $authFacade->attemptLogin($username, $password);
    
        if ($resultadoLogin) {
            $authFacade->startSession($resultadoLogin);
            return redirect('/index');
        } else {
            return redirect('/login/1');
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


