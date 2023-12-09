<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Models\metas;
use App\Models\Meta;
use App\Models\canastas;
use App\Models\Usuario;
use App\Models\productos;



class GoalsController extends Controller
{
    public function goalsView(){

        $misMetas = new metas();
        $miNuevaMeta = new Meta();
        $miListaMetas = json_decode(json_encode($misMetas->getListaMetas()), true);
        $miMeta = $miNuevaMeta->setMeta('',Session::get('id_usuario'),'','','','');
        $misMetasActuales = json_decode(json_encode($misMetas->getUsuarioMetas($miMeta)), true);

                
        $listaMetas=array();
        $totalMetas = 0;
        while(!empty($miListaMetas[$totalMetas]["descripcion_meta"])){
            $listaMetas[$totalMetas] = $miListaMetas[$totalMetas]["descripcion_meta"];
            $totalMetas = $totalMetas + 1;
        }

        $alert = 0;

        $miNuevaCanasta = new canastas();
        $miUsuario = new Usuario();
    
        $miUsuarioCanasta =  $miUsuario->setUsuario('',
        '',
        '',
        Session::get('id_usuario'),
        '',
        '',);          
    
        $misCanastasUsuario = json_decode(json_encode($miNuevaCanasta->getCanastaByUsuario($miUsuarioCanasta)), true);

        $miListaProductos = new productos();
        
        $nuevaListaProductos = json_decode(json_encode($miListaProductos->getProductosNombre()), true);
    
        $listaProductosFinal = '';
        $i = 0;
        while(!empty($nuevaListaProductos[$i])){
        $listaProductosFinal = $listaProductosFinal . '\''. $nuevaListaProductos[$i]['nombre_producto'] . '\', ';
        
        $i = $i +1;
        }

        $miListacompletaMetas = json_decode(json_encode($misMetas->getAllMetas()), true);

                
        return view('goals_view',['listaMetas' => $listaMetas, 
                                  'totalMetas' => $totalMetas,
                                  'metasActuales' => $misMetasActuales,
                                  'alert'=> $alert,
                                  'canastasActuales' => $misCanastasUsuario,
                                  'listaProductosFinal' => $listaProductosFinal,
                                  'tipoUsuario' => Session::get('tipo_usuario'),
                                  'nombreUsuario' => Session::get('usuario'),
                                  'idUsuario' => Session::get('id_usuario'),
                                  'idSesion' => Session::get('id_sesion'),
                                  'listaCompletaMetas' =>  $miListacompletaMetas]);
       
    }

    public function goalsAlert($alert){
    
        $misMetas = new metas();
        $miNuevaMeta = new Meta();
        $miListaMetas = json_decode(json_encode($misMetas->getListaMetas()), true);
        $miMeta = $miNuevaMeta->setMeta('',Session::get('id_usuario'),'','','','');
        $misMetasActuales = json_decode(json_encode($misMetas->getUsuarioMetas($miMeta)), true);

                
        $listaMetas=array();
        $totalMetas = 0;
        while(!empty($miListaMetas[$totalMetas]["descripcion_meta"])){
            $listaMetas[$totalMetas] = $miListaMetas[$totalMetas]["descripcion_meta"];
            $totalMetas = $totalMetas + 1;
        }

        $miNuevaCanasta = new canastas();
        $miUsuario = new Usuario();
    
        $miUsuarioCanasta =  $miUsuario->setUsuario('',
        '',
        '',
        Session::get('id_usuario'),
        '',
        '',);          
    
        $misCanastasUsuario = json_decode(json_encode($miNuevaCanasta->getCanastaByUsuario($miUsuarioCanasta)), true);

        $miListaProductos = new productos();
        
        $nuevaListaProductos = json_decode(json_encode($miListaProductos->getProductosNombre()), true);
    
        $listaProductosFinal = '';
        $i = 0;
        while(!empty($nuevaListaProductos[$i])){
        $listaProductosFinal = $listaProductosFinal . '\''. $nuevaListaProductos[$i]['nombre_producto'] . '\', ';
        
        $i = $i +1;
        }

        
        $miListacompletaMetas = json_decode(json_encode($misMetas->getAllMetas()), true);

                

               
        return view('goals_view',['listaMetas' => $listaMetas, 
                                  'totalMetas' => $totalMetas,
                                  'metasActuales' => $misMetasActuales,
                                  'alert'=> $alert,
                                  'tipoUsuario' => Session::get('tipo_usuario'),
                                  'nombreUsuario' => Session::get('usuario'),
                                  'idUsuario' => Session::get('id_usuario'),
                                  'idSesion' => Session::get('id_sesion'),
                                  'canastasActuales' => $misCanastasUsuario,
                                  'listaProductosFinal' => $listaProductosFinal,
                                  'listaCompletaMetas' =>  $miListacompletaMetas]);


    }


    public function goals(){        
       
        $misMetas = new metas();
        $miNuevaMeta = new Meta();        

        $maxIdUsuarioMetas = json_decode(json_encode($misMetas->getIdUsuarioMetasMax()), true);

        $miNuevoIdMeta = $miNuevaMeta->setMeta('','','',$_POST['nombreMeta'],'','');
        $miIdMeta = json_decode(json_encode($misMetas->getIdMetaByDescripcion($miNuevoIdMeta)), true);
        $miIdVariable = json_decode(json_encode($misMetas->getIdVariableByDescription($miNuevoIdMeta)), true);
        

        $miValidarMeta = $miNuevaMeta->setMeta($miIdMeta[0]["id_meta"],Session::get('id_usuario'),'','','',$miIdVariable[0]['id_variable_nutricional']);
        $miMetaValidar = json_decode(json_encode($misMetas->validarMetaUsuario($miValidarMeta)), true);
        

        $miValidarMetaActualizar = $miNuevaMeta->setMeta($miIdMeta[0]["id_meta"],Session::get('id_usuario'),'','','','');
        $miMetaValidarActualizar = json_decode(json_encode($misMetas->validarMetaUsuarioActualizar($miValidarMetaActualizar)), true);; 


    
        if($miMetaValidar){
            return redirect('/goals_alert/1');
        }
        else{ 
            if($miMetaValidarActualizar){
                $miMetaUpdate = $miNuevaMeta->setMeta($miIdMeta[0]["id_meta"],Session::get('id_usuario'),$_POST['rangoMeta'],'','','');
                $miUpdateMetaUsuario = json_decode(json_encode($misMetas->updateMetaUsuario($miMetaUpdate)), true);
                return redirect('/goals');
            }else{      
       
            $miMetaUpdate = $miNuevaMeta->setMeta($miIdMeta[0]["id_meta"],Session::get('id_usuario'),$_POST['rangoMeta'],'',$maxIdUsuarioMetas[0]['MAX(id_meta_usuario)'] + 1,'');
            $misMetasUsuarioInsert = $misMetas->insertUsuarioMetas($miMetaUpdate);

       
             return redirect('/goals');
            }

    }
}


    public function goalsDelete($idDelete){
        
        $misMetas = new metas();
        $miNuevaMeta = new Meta();
        $miMetaDelete = $miNuevaMeta->setMeta('','','','',$idDelete,'');

        $miDeleteMetaUsuario = json_decode(json_encode($misMetas->deleteMetaUsuarioByIdMetaUsuario($miMetaDelete)), true);

        return redirect('/goals');
    }
}
