<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\usuarios;
use App\Models\Usuario;

class SignupController extends Controller
{
    public function signupView(){

    return view('signup_view', ['alertaSignup' => 0]);

    }


    public function signup(){

        $miAltaUsuario = new usuarios();
        $miNuevoUsuario = new Usuario();
        $idMaxUsuario = json_decode(json_encode($miAltaUsuario->userMaxId()), true);

        $miUsuarioValidacion = $miNuevoUsuario->setUsuario($_POST['usuario_registro'],'','','','','');
        $validacionNombreUsuario = $miAltaUsuario->usernameValidation($miUsuarioValidacion);


        if($validacionNombreUsuario){

            return redirect('/signup/2');
        }else{

        
        $miUsuario =$miNuevoUsuario->setUsuario($_POST['usuario_registro'],
                                                $_POST['contraseña_registro'],
                                                $_POST['tipo_registro'],
                                                $idMaxUsuario[0]['MAX(id_usuario)'] + 1,
                                                '',
                                                '',);

        $miAltaUsuario->altaUsuario($miUsuario);
                                    
        return redirect('/signup/1');
    }

      }


      public function signupAlert($alerta){

        return view('signup_view',
        ['alertaSignup' => $alerta]);

      }


}
