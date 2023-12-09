<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\LoginController;
use DB;


class usuarios extends Model
{
    use HasFactory;


    public function credentialsValidation($miUsuario){
    
    $loginValidar = "SELECT*FROM usuarios where usuario=? and contraseña=sha1(?)";
    
    $resultadoQuery = DB::select($loginValidar, array($miUsuario->username, $miUsuario->pass));
   
  
    return $resultadoQuery; 
    }

    
    public function altaUsuario($miUsuario){
    
    $queryAltaUsuario = "INSERT INTO usuarios (id_usuario, usuario, contraseña, tipo_usuario, estado_usuario, pack_adquirido) 
                        VALUES (?,?,sha1(?),?,?,?) ";
    
    DB::insert($queryAltaUsuario, array($miUsuario->id ,$miUsuario->username,$miUsuario->pass,$miUsuario->tipo,'1','0'));
    }

    public function userMaxId(){

        $consultaIdUsuario = "SELECT MAX(id_usuario) FROM usuarios";

        $idUsuarioMax = DB::select($consultaIdUsuario, array());

        return $idUsuarioMax;

    }

    public function usernameValidation($miUsuario){

        $queryUsername = 'SELECT usuario 
                          FROM usuarios
                          WHERE usuario = ?';

        $consultaUsername = DB::select($queryUsername, array($miUsuario->username));

        return $consultaUsername;

    }

    public function userDataById($miUsuario){
        
        $queryDataUser = 'SELECT *
                          FROM usuarios
                          WHERE id_usuario = ?';

        $consultaDataUser = DB::select($queryDataUser, array($miUsuario->id));

        return $consultaDataUser;

    }

    public function manageUser($miUsuario){

        $queryManageUser = 'UPDATE usuarios
                            SET usuario = ?,
                            tipo_usuario = ?,
                            estado_usuario = ?,
                            pack_adquirido = ?
                            WHERE id_usuario = ?';

        DB::update($queryManageUser,array($miUsuario->username,$miUsuario->tipo,$miUsuario->estado,$miUsuario->pack,$miUsuario->id));

        return;
    }


}

