<?php

namespace App\Http\Controllers;
use Session;
use App\Models\usuarios;
use App\Models\auditoria;
use App\Models\AuditoriaUsuario;
use App\Models\Usuario;

use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function manageView(){

    return view('manage_view',["alertaManage" => 0]);     
    }


    public function manageAlert($alerta){
    
    return view('manage_view',["alertaManage" => $alerta]);
}


    public function manage(){


    $miManageUsuario = new usuarios();
    $miNuevoUsuario = new Usuario();
    $miUserDataById = $miNuevoUsuario ->setUsuario('','','',$_POST['idUsuario_update'],'','');
    $miDataUsuario = json_decode(json_encode($miManageUsuario->userDataById($miUserDataById)), true);

    if($miDataUsuario){
    if(empty($_POST['usuario_update'])){
        $username = $miDataUsuario[0]['usuario'];
    }else{
        $username = $_POST['usuario_update'];
    }

    if(empty($_POST['estado_update'])){ 
        $estado = $miDataUsuario[0]['estado_usuario'];
    }else{
        $estado = $_POST['estado_update'];
    }

    if(empty($_POST['tipo_update'])){ 
        $tipo = $miDataUsuario[0]['tipo_usuario'];
    }else{
        $tipo = $_POST['tipo_update'];
    }

    if(empty($_POST['pack_update'])){ 
        $pack = $miDataUsuario[0]['pack_adquirido'];
    }else{
        $pack = $_POST['pack_update'];
    }

    
    $miAuditoria = new auditoria;
    $miIdMaxAuditoria = json_decode(json_encode($miAuditoria->auditMaxId()), true);
    
    $miNuevaAuditoriaUsuario = new AuditoriaUsuario;

    $miAuditoriaUsuario = $miNuevaAuditoriaUsuario->setAuditoriaUsuario($miDataUsuario[0]['usuario'],
                                                                        '',
                                                                        $miDataUsuario[0]['tipo_usuario'],
                                                                        $miDataUsuario[0]['id_usuario'],
                                                                        $miDataUsuario[0]['estado_usuario'],
                                                                        $miDataUsuario[0]['pack_adquirido'],
                                                                        $miIdMaxAuditoria[0]['MAX(id_auditoria)'] + 1,
                                                                        Session::get('id_sesion'));

    $miAuditoria->auditUserChange($miAuditoriaUsuario);





    $miUsuario = $miNuevoUsuario->setUsuario($username,
                                            '',
                                            $tipo,
                                            $_POST['idUsuario_update'],                                            
                                            $estado,                                           
                                            $pack);
    $miManageUsuario->manageUser($miUsuario);


 



    return redirect('/manage/2');
    

    }else{
        return redirect('/manage/1');
    }
    
    

    return;

    }


}
