<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Models\Canasta;
use App\Models\canastas;
use App\Models\Producto;
use App\Models\productos;
use App\Models\ProductoPaquete;
use App\Models\ProductoCanasta;
use App\Models\metas;
use App\Models\Meta;
use App\Models\ProductoVariables;
use App\Models\Usuario;

class BasketController extends Controller
{
    public function basket(){

        if($_POST['tiempo_canasta'] <= 64 AND strlen($_POST['nombre_canasta']) <= 20){
        
        $miAltaCanasta = new canastas();
        $iterarCanasta = new Canasta();

       
       $miIdCanastaMax = json_decode(json_encode($miAltaCanasta -> getIdCanastaMax()), true);

       $miCanasta = $iterarCanasta -> setCanasta($miIdCanastaMax[0]['MAX(id_canasta)'] + 1,
                                                0,
                                                Session::get('id_usuario'),
                                                $_POST['tiempo_canasta'],
                                                $_POST['nombre_canasta']);

        $miAltaCanasta->altaCanasta($miCanasta);

        $idNuevaCanasta = $miIdCanastaMax[0]['MAX(id_canasta)'] + 1;


        return redirect('/basket/'. $idNuevaCanasta .'');
    }else{         
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

        $alertaFormCanasta = 1;

        return view('basket_form_view',[
                    'canastasActuales' => $misCanastasUsuario,
                    'listaProductosFinal' => $listaProductosFinal,
                    'tipoUsuario' => Session::get('tipo_usuario'),
                    'nombreUsuario' => Session::get('usuario'),
                    'idUsuario' => Session::get('id_usuario'),
                    'idSesion' => Session::get('id_sesion'),
                    'alertaFormCanasta' => $alertaFormCanasta]);
    }


    }

    public function basketForm(){

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

        $alertaFormCanasta = 0;

        return view('basket_form_view',[
                    'canastasActuales' => $misCanastasUsuario,
                    'listaProductosFinal' => $listaProductosFinal,
                    'tipoUsuario' => Session::get('tipo_usuario'),
                    'nombreUsuario' => Session::get('usuario'),
                    'idUsuario' => Session::get('id_usuario'),
                    'idSesion' => Session::get('id_sesion'),
                    'alertaFormCanasta' => $alertaFormCanasta]);
    }

    public function basketView($idCanasta){

        $miListaProductos = new productos();
        
        $nuevaListaProductos = json_decode(json_encode($miListaProductos->getProductosNombre()), true);

        $listaProductosfinal = '';
        $i = 0;
        while(!empty($nuevaListaProductos[$i])){
        $listaProductosfinal = $listaProductosfinal . '\''. $nuevaListaProductos[$i]['nombre_producto'] . '\', ';
        
        $i = $i +1;
        }
        
        if(!isset($listaBusquedaProducto)){
            $listaBusquedaProducto = 0;
            }
        $misMetas = new metas();
        $miNuevaMeta = new Meta();
        $miMeta = $miNuevaMeta->setMeta('',Session::get('id_usuario'),'','','','');
        $misMetasActuales = json_decode(json_encode($misMetas->getUsuarioMetas($miMeta)), true);

        $miIteracionCanasta = new Canasta();
        $misCanastas = new canastas();
        $miNuevaCanasta = $miIteracionCanasta->setCanasta($idCanasta,'','','','');
        $misProductosActuales = json_decode(json_encode($misCanastas->getPorductosCanasta($miNuevaCanasta)), true);

        $miIteracionProductoVariables = new ProductoVariables();

        $i = 0;
        $h = 0;
        while(!empty($misProductosActuales[$i])){
        $misProductosActuales[$i]['variable'] = array();
        while(!empty($misMetasActuales[$h])){
        $miNuevoProductosVariables = $miIteracionProductoVariables->setProductoVariables ($misProductosActuales[$i]['id_producto'],
                                                                                        $misMetasActuales[$h]['id_variable_nutricional'],
                                                                                        '',
                                                                                        '');

        $miProductoVariable = json_decode(json_encode($miListaProductos->getPorductosVariables($miNuevoProductosVariables)), true);
        
        $misProductosActuales[$i]['variable'][$h] = array();
        $misProductosActuales[$i]['variable'][$h]['nombre'] = $miProductoVariable[0]['descripcion_variable_nutricional'];
        $misProductosActuales[$i]['variable'][$h]['cantidad'] = ($miProductoVariable[0]['cantidad_cien_gr'] * ($misProductosActuales[$i]['peso'] / 100)) * $misProductosActuales[$i]['cantidad'];
        $misProductosActuales[$i]['variable'][$h]['cantidad_cien_gr'] = $miProductoVariable[0]['cantidad_cien_gr'];

        $h = $h + 1;
            }
        $h = 0;
        $i = $i + 1;    
        }

        $miIteracionCanasta = new Canasta();
        $miCanasta = new canastas();
        $miNuevaCanasta = $miIteracionCanasta->setCanasta($idCanasta,'','','','');
        $miTiempoCanasta = json_decode(json_encode($miCanasta->getTiempoCanastaByIdCanasta($miNuevaCanasta)), true);

        $totalVariables = array();
        $i = 0;
        $h = 0;   
        $maxVariable = 0;
        $minVariable = 99999;
        $tipoProducto = array();

       while (!empty($misProductosActuales[0]['variable'][$i])){           
        $totalVariables[$i] = array();
        $totalVariables[$i]['nombre'] = $misProductosActuales[0]['variable'][$i]['nombre'];
        $totalVariables[$i]['cantidad'] = 0;
        $totalVariables[$i]['meta'] =((((
                                    $misMetasActuales[$i]['cantidad_minima(gr)'] - $misMetasActuales[$i]['cantidad_maxima(gr)']) 
                                    / 100 ) 
                                    * $misMetasActuales[$i]['nivel_restriccion']) 
                                    + $misMetasActuales[$i]['cantidad_maxima(gr)'] ) * $miTiempoCanasta[0]['tiempo_canasta'];
        $totalVariables[$i]['mas_menos'] = $misMetasActuales[$i]['mas_menos'];                  


        while(!empty($misProductosActuales[$h]['variable'][$i])){
            $totalVariables[$i]['cantidad'] = $misProductosActuales[$h]['variable'][$i]['cantidad'] +  $totalVariables[$i]['cantidad'];
            
        
            if($maxVariable < $misProductosActuales[$h]['variable'][$i]['cantidad_cien_gr'] AND $totalVariables[$i]['mas_menos'] == 1
                OR $minVariable > $misProductosActuales[$h]['variable'][$i]['cantidad_cien_gr'] AND $totalVariables[$i]['mas_menos'] == 0){
                    if($totalVariables[$i]['mas_menos'] == 1){
                        $maxVariable = $misProductosActuales[$h]['variable'][$i]['cantidad_cien_gr'];
                        $tipoProducto[$i] = $misProductosActuales[$h]['tipo_producto'];
                    }else if($totalVariables[$i]['mas_menos'] == 0){
                        $tipoProducto[$i] = $misProductosActuales[$h]['tipo_producto'];
                    }

                $misProductosActuales[$h]['variable'][$i]['max_variable'] = true;
                $j = $h - 1;
                    while($j >= 0){                        
                        $misProductosActuales[$j]['variable'][$i]['max_variable'] = false;
                        $j = $j - 1;

                    }
            }else{
                $misProductosActuales[$h]['variable'][$i]['max_variable'] = false;
            }         
            $h = $h + 1;
        }       

        $totalVariables[$i]['total'] = $totalVariables[$i]['cantidad'] - $totalVariables[$i]['meta'];        

       if($totalVariables[$i]['mas_menos'] === 0){
            if($totalVariables[$i]['total'] > 0){
                $totalVariables[$i]['pase'] =  true;
            }else if($totalVariables[$i]['total'] < 0){
                $totalVariables[$i]['pase'] =  false;
            }
        }else if ($totalVariables[$i]['mas_menos'] === 1) {
            if($totalVariables[$i]['total'] > 0){
                $totalVariables[$i]['pase'] =  false;
            }else if ($totalVariables[$i]['total'] < 0){
                $totalVariables[$i]['pase'] =  true;
            }
        }             
        $i = $i +1;
        $h = 0;
    }

    $i = 0;
    $h = 0;
    $j = 0;
    $miProducto = new productos();   


    
    if(!empty($tipoProducto)){
        for($i = 0; !empty($misMetasActuales[$i]); $i++){ 
        $misMetasActuales[$i]['producto_sustituto'] = array();
        if(empty($tipoProducto[$i])){
            $tipoProducto[$i] = "Fruta";
        }
        $miNuevoProducto = $miIteracionProductoVariables->setProductoVariables ('',$misMetasActuales[$i]['id_variable_nutricional'],'',$tipoProducto[$i]);

        if($misMetasActuales[$i]['mas_menos'] == 0){
        $miReturn= json_decode(json_encode($miProducto->getProductSortVariableDesc($miNuevoProducto)), true);  
        $misMetasActuales[$i]['producto_sustituto'] = $miReturn[0];
        }
        else if($misMetasActuales[$i]['mas_menos'] == 1){
        $miReturn= json_decode(json_encode($miProducto->getProductSortVariableAsc($miNuevoProducto)), true);  
        $misMetasActuales[$i]['producto_sustituto'] = $miReturn[0];
        }
    }}

    for($i=0;!empty($misProductosActuales[$i]);$i++){
        for($h=0;!empty($misProductosActuales[$i]['variable'][$h]);$h++){
            if($misProductosActuales[$i]['variable'][$h]['max_variable'] == true){
                if($misProductosActuales[$i]['id_producto'] == $misMetasActuales[$h]['producto_sustituto']['id_producto']){
                    $misProductosActuales[$i]['variable'][$h]['max_variable'] = false;
                }
            }

        }
    }

    $miListaProductos = new productos();
        
    $nuevaListaProductos = json_decode(json_encode($miListaProductos->getProductosNombre()), true);

    $miListaProductosFinalBusqueda = '';
    $i = 0;
    while(!empty($nuevaListaProductos[$i])){
    $miListaProductosFinalBusqueda = $miListaProductosFinalBusqueda . '\''. $nuevaListaProductos[$i]['nombre_producto'] . '\', ';
    
    $i = $i +1;
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

    $misDatosCanasta = json_decode(json_encode($miNuevaCanasta->getCanastaById($idCanasta)), true);

        return view('/basket_view',['idCanasta' => $idCanasta,
                                    'totalVariables' => $totalVariables,
                                    'listaProductos' => $listaProductosfinal,
                                    'listaBusquedaProducto' => $listaBusquedaProducto,
                                    'metasActuales' => $misMetasActuales,
                                    'productosActuales' => $misProductosActuales,
                                    'tipoUsuario' => Session::get('tipo_usuario'),
                                    'nombreUsuario' => Session::get('usuario'),
                                    'canastasActuales' => $misCanastasUsuario,
                                    'listaProductosFinal' => $miListaProductosFinalBusqueda,
                                    'idUsuario' => Session::get('id_usuario'),
                                    'idSesion' => Session::get('id_sesion'),
                                    'datosCanasta' => $misDatosCanasta
                                ]);       
    }



    public function basketDelete($miIdCanasta){
        $miBajaCanasta = new canastas();
        $iterarCanasta = new Canasta();

        $miCanasta = $iterarCanasta -> setCanasta($miIdCanasta,
                                                '',
                                                '' ,
                                                '',
                                                '');

        $bajaCanasta = $miBajaCanasta->bajaCanasta($miCanasta);              
        
        return redirect('/index');
    }


    
    public function productBasketSearch($idCanasta){
        $miListaProductos = new productos();        
        $iterarProducto = new Producto();

        $miProducto = $iterarProducto -> setProducto('', 
                                                    $_POST['nombre_producto'], 
                                                    '',
                                                    '',
                                                    '',
                                                    '',
                                                    '',
                                                    '');

        $listaBusquedaProducto = json_decode(json_encode($miListaProductos->getPaquetesByName($miProducto)), true);

        
        $nuevaListaProductos = json_decode(json_encode($miListaProductos->getProductosNombre()), true);

        $listaProductosfinal = '';
        $i = 0;
        while(!empty($nuevaListaProductos[$i])){
        $listaProductosfinal = $listaProductosfinal . '\''. $nuevaListaProductos[$i]['nombre_producto'] . '\', ';
        
        $i = $i +1;
        }
        
        $misMetas = new metas();
        $miNuevaMeta = new Meta();
        $miMeta = $miNuevaMeta->setMeta('',Session::get('id_usuario'),'','','','');
        $misMetasActuales = json_decode(json_encode($misMetas->getUsuarioMetas($miMeta)), true);

        $miIteracionCanasta = new Canasta();
        $misCanastas = new canastas();
        $miNuevaCanasta = $miIteracionCanasta->setCanasta($idCanasta,'','','','');
        $misProductosActuales = json_decode(json_encode($misCanastas->getPorductosCanasta($miNuevaCanasta)), true);

        $miIteracionProductoVariables = new ProductoVariables();

        $i = 0;
        $h = 0;
        while(!empty($misProductosActuales[$i])){
        $misProductosActuales[$i]['variable'] = array();
        while(!empty($misMetasActuales[$h])){
        $miNuevoProductosVariables = $miIteracionProductoVariables->setProductoVariables ($misProductosActuales[$i]['id_producto'],
                                                                                        $misMetasActuales[$h]['id_variable_nutricional'],
                                                                                        '',
                                                                                        '');

        $miProductoVariable = json_decode(json_encode($miListaProductos->getPorductosVariables($miNuevoProductosVariables)), true);
        
        $misProductosActuales[$i]['variable'][$h] = array();
        $misProductosActuales[$i]['variable'][$h]['nombre'] = $miProductoVariable[0]['descripcion_variable_nutricional'];
        $misProductosActuales[$i]['variable'][$h]['cantidad'] = ($miProductoVariable[0]['cantidad_cien_gr'] * ($misProductosActuales[$i]['peso'] / 100)) * $misProductosActuales[$i]['cantidad'];
        $misProductosActuales[$i]['variable'][$h]['cantidad_cien_gr'] = $miProductoVariable[0]['cantidad_cien_gr'];


        $h = $h + 1;
            }
        $h = 0;
        $i = $i + 1;    
        }


        $miIteracionCanasta = new Canasta();
        $miCanasta = new canastas();
        $miNuevaCanasta = $miIteracionCanasta->setCanasta($idCanasta,'','','','');
        $miTiempoCanasta = json_decode(json_encode($miCanasta->getTiempoCanastaByIdCanasta($miNuevaCanasta)), true);

        $totalVariables = array();
        $i = 0;
        $h = 0;   
        $maxVariable = 0;
        $minVariable = 99999;  
        $tipoProducto = array();



       while (!empty($misProductosActuales[0]['variable'][$i])){           
        $totalVariables[$i] = array();
        $totalVariables[$i]['nombre'] = $misProductosActuales[0]['variable'][$i]['nombre'];
        $totalVariables[$i]['cantidad'] = 0;
        $totalVariables[$i]['meta'] =((((
                                    $misMetasActuales[$i]['cantidad_minima(gr)'] - $misMetasActuales[$i]['cantidad_maxima(gr)']) 
                                    / 100 ) 
                                    * $misMetasActuales[$i]['nivel_restriccion']) 
                                    + $misMetasActuales[$i]['cantidad_maxima(gr)'] ) * $miTiempoCanasta[0]['tiempo_canasta'];
        $totalVariables[$i]['mas_menos'] = $misMetasActuales[$i]['mas_menos'];                  


        while(!empty($misProductosActuales[$h]['variable'][$i])){
            $totalVariables[$i]['cantidad'] = $misProductosActuales[$h]['variable'][$i]['cantidad'] +  $totalVariables[$i]['cantidad'];
            
        
            if($maxVariable < $misProductosActuales[$h]['variable'][$i]['cantidad_cien_gr'] AND $totalVariables[$i]['mas_menos'] == 1
                OR $minVariable > $misProductosActuales[$h]['variable'][$i]['cantidad_cien_gr'] AND $totalVariables[$i]['mas_menos'] == 0){
                    if($totalVariables[$i]['mas_menos'] == 1){
                        $maxVariable = $misProductosActuales[$h]['variable'][$i]['cantidad_cien_gr'];
                        $tipoProducto[$i] = $misProductosActuales[$h]['tipo_producto'];
                    }else if($totalVariables[$i]['mas_menos'] == 0){
                        $tipoProducto[$i] = $misProductosActuales[$h]['tipo_producto'];
                    }

                $misProductosActuales[$h]['variable'][$i]['max_variable'] = true;
                $j = $h - 1;
                    while($j >= 0){                        
                        $misProductosActuales[$j]['variable'][$i]['max_variable'] = false;
                        $j = $j - 1;

                    }
            }else{
                $misProductosActuales[$h]['variable'][$i]['max_variable'] = false;
            }         
            $h = $h + 1;
        }       

        $totalVariables[$i]['total'] = $totalVariables[$i]['cantidad'] - $totalVariables[$i]['meta'];        

       if($totalVariables[$i]['mas_menos'] === 0){
            if($totalVariables[$i]['total'] > 0){
                $totalVariables[$i]['pase'] =  true;
            }else if($totalVariables[$i]['total'] < 0){
                $totalVariables[$i]['pase'] =  false;
            }
        }else if ($totalVariables[$i]['mas_menos'] === 1) {
            if($totalVariables[$i]['total'] > 0){
                $totalVariables[$i]['pase'] =  false;
            }else if ($totalVariables[$i]['total'] < 0){
                $totalVariables[$i]['pase'] =  true;
            }
        }             
        $i = $i +1;
        $h = 0;
    }

    $i = 0;
    $h = 0;
    $j = 0;
    $miProducto = new productos();   

    if(!empty($tipoProducto)){
    for($i = 0; !empty($misMetasActuales[$i]); $i++){
        if(empty($tipoProducto[$i])){
            $tipoProducto[$i] = "Fruta";
        }
    $misMetasActuales[$i]['producto_sustituto'] = array();
    $miNuevoProducto = $miIteracionProductoVariables->setProductoVariables ('',$misMetasActuales[$i]['id_variable_nutricional'],'',$tipoProducto[$i]);

    if($misMetasActuales[$i]['mas_menos'] == 0){
    $miReturn= json_decode(json_encode($miProducto->getProductSortVariableDesc($miNuevoProducto)), true);  
     $misMetasActuales[$i]['producto_sustituto'] = $miReturn[0];
    }
    else if($misMetasActuales[$i]['mas_menos'] == 1){
    $miReturn= json_decode(json_encode($miProducto->getProductSortVariableAsc($miNuevoProducto)), true);  
    $misMetasActuales[$i]['producto_sustituto'] = $miReturn[0];
    }
    }
    }

    for($i=0;!empty($misProductosActuales[$i]);$i++){
        for($h=0;!empty($misProductosActuales[$i]['variable'][$h]);$h++){
            if($misProductosActuales[$i]['variable'][$h]['max_variable'] == true){
                if($misProductosActuales[$i]['id_producto'] == $misMetasActuales[$h]['producto_sustituto']['id_producto']){
                    $misProductosActuales[$i]['variable'][$h]['max_variable'] = false;
                }
            }

        }
    }

    $miListaProductos = new productos();
        
    $nuevaListaProductos = json_decode(json_encode($miListaProductos->getProductosNombre()), true);

    $miListaProductosFinalBusqueda = '';
    $i = 0;
    while(!empty($nuevaListaProductos[$i])){
    $miListaProductosFinalBusqueda = $miListaProductosFinalBusqueda . '\''. $nuevaListaProductos[$i]['nombre_producto'] . '\', ';
    
    $i = $i +1;
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

    $misDatosCanasta = json_decode(json_encode($miNuevaCanasta->getCanastaById($idCanasta)), true);
       
        return view('/basket_view',['idCanasta' => $idCanasta,
                                    'listaProductos' => $listaProductosfinal,
                                    'totalVariables' => $totalVariables,
                                    'listaBusquedaProducto' => $listaBusquedaProducto,
                                    'metasActuales' => $misMetasActuales,
                                    'productosActuales' => $misProductosActuales,
                                    'tipoUsuario' => Session::get('tipo_usuario'),
                                    'nombreUsuario' => Session::get('usuario'),
                                    'canastasActuales' => $misCanastasUsuario,
                                    'listaProductosFinal' => $miListaProductosFinalBusqueda,
                                    'idUsuario' => Session::get('id_usuario'),
                                    'idSesion' => Session::get('id_sesion'),
                                    'datosCanasta' => $misDatosCanasta]);      
    }

    public function basketAdd($idCanasta, $idProductoPaquete){
        $iterarCanasta = new Canasta();
        $iterarProductoPaquete = new ProductoPaquete();
        $altaProductoCanasta = new canastas();
        $iterarProductoCanasta = new ProductoCanasta();

        $maxId = json_decode(json_encode($altaProductoCanasta -> getMaxIdFromListaCanastaProductos()), true);
        $miCanasta = $iterarCanasta -> setCanasta($idCanasta,
                                                '',
                                                '',
                                                '',
                                                '');
                                                     
        $miProductoPaquete = $iterarProductoPaquete -> setProductoPaquete($idProductoPaquete,
                                                                '',
                                                                '',
                                                                '',
                                                                $maxId[0]['MAX(id_canasta_producto)'] + 1);


        $miValidarProductoPaquete = $iterarProductoCanasta->setProductoCanasta($idProductoPaquete,'', $idCanasta);
        $validarProductoPaquete = json_decode(json_encode($altaProductoCanasta->validarProductoPaqueteCanasta($miValidarProductoPaquete)), true);


        if($validarProductoPaquete){
            return redirect('/basket/'. $idCanasta .'');

        }else{
                                                          
        $miAñadirProductoCanasta = $altaProductoCanasta -> addProductToBasket($miCanasta, $miProductoPaquete);

        
        
        return redirect('/basket/'. $idCanasta .'');
        }
    }


    public function productQuantityUpdate($idCanasta){
        $iterarProductoCanasta = new ProductoCanasta();
        $misCanastas = new canastas();
        $nuevoProductoCanasta = $iterarProductoCanasta->setProductoCanasta($_POST['id_canasta_producto'],$_POST['cantidad_producto_canasta'],'');

        $miProductoCanasta = $misCanastas->updateCantidadProductoCanasta($nuevoProductoCanasta);

        return redirect('/basket/'. $idCanasta .'');
    }

    public function smartBasketForm(){

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

        $alertaFormCanasta = 0;

        $misMetas = new metas();
        $miNuevaMeta = new Meta();
        $miListaMetas = json_decode(json_encode($misMetas->getListaMetas()), true);
        $miMeta = $miNuevaMeta->setMeta('',Session::get('id_usuario'),'','','','');
        $misMetasActuales = json_decode(json_encode($misMetas->getUsuarioMetas($miMeta)), true);

        return view('smart_basket_form_view',[
                    'canastasActuales' => $misCanastasUsuario,
                    'listaProductosFinal' => $listaProductosFinal,
                    'tipoUsuario' => Session::get('tipo_usuario'),
                    'nombreUsuario' => Session::get('usuario'),
                    'idUsuario' => Session::get('id_usuario'),
                    'idSesion' => Session::get('id_sesion'),
                    'alertaFormCanasta' => $alertaFormCanasta,
                    'metasActuales' => $misMetasActuales]);
    }


    public function smartBasketView(){

        $tiempoCanasta = $_POST['tiempo_canasta'];
        $nombreCanasta = $_POST['nombre_canasta'];

        $miListaProductos = new productos();
        
        $nuevaListaProductos = json_decode(json_encode($miListaProductos->getProductosNombre()), true);

        $listaProductosFinal = '';
        $i = 0;
        while(!empty($nuevaListaProductos[$i])){
        $listaProductosFinal = $listaProductosFinal . '\''. $nuevaListaProductos[$i]['nombre_producto'] . '\', ';
        
        $i = $i +1;
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


        $misMetas = new metas();
        $miNuevaMeta = new Meta();
        $miListaMetas = json_decode(json_encode($misMetas->getListaMetas()), true);
        $miMeta = $miNuevaMeta->setMeta('',Session::get('id_usuario'),'','','','');
        $misMetasActuales = json_decode(json_encode($misMetas->getUsuarioMetas($miMeta)), true);


        $i = 0;
        while(!empty($misMetasActuales[$i])){
            $misMetasActuales[$i]['valor_total_dias'] = (((($misMetasActuales[$i]['cantidad_minima(gr)'] - $misMetasActuales[$i]['cantidad_maxima(gr)']) / 100 ) * $misMetasActuales[$i]['nivel_restriccion']) + $misMetasActuales[$i]['cantidad_maxima(gr)']);
            $misMetasActuales[$i]['valor_total_dias'] =  $misMetasActuales[$i]['valor_total_dias'] * $tiempoCanasta;
            $i = $i +1;
        }



        $j = 0;
        while(!empty($misMetasActuales[$j])){
            if($misMetasActuales[$j]['mas_menos'] == 0){
        $misProductosTop[$j] = json_decode(json_encode($miListaProductos->getTopProductsDesc($misMetasActuales[$j]['id_variable_nutricional'])), true);}
        else{
            $misProductosTop[$j] = json_decode(json_encode($miListaProductos->getTopProductsAsc($misMetasActuales[$j]['id_variable_nutricional'])), true);}

            $g = 0;
            while(!empty($misProductosTop[$j][$g])){
                $miPaqueteNuevo = json_decode(json_encode($miListaProductos->getProductoPaquetebyIdProducto($misProductosTop[$j][$g]['id_producto'])), true);

                $misProductosTop[$j][$g]['id_producto_paquete'] = $miPaqueteNuevo[0]['id_producto_paquete'];
                $misProductosTop[$j][$g]['cantidad_incluir'] = 0;
                $g = $g +1;
            }
            
        $j =$j +1;
        }
        

/*
        $t = 0;
        $misProductosTopValoracion = json_decode(json_encode($miListaProductos->getTopProductosRecom()), true);
        
        while(!empty($misProductosTopValoracion[$t])){           
            
            $misProductosTopValoracion[$t]['cantidad_incluir'] = 0;
            $t = $t + 1;
        }*/

        
        $miAltaCanasta = new canastas();
        $iterarCanasta = new Canasta();

       
       $miIdCanastaMax = json_decode(json_encode($miAltaCanasta -> getIdCanastaMax()), true);

       $miCanasta = $iterarCanasta -> setCanasta($miIdCanastaMax[0]['MAX(id_canasta)'] + 1,
                                                0,
                                                Session::get('id_usuario'),
                                                $_POST['tiempo_canasta'],
                                                $_POST['nombre_canasta']);

        $miAltaCanasta->altaCanasta($miCanasta);

        $idNuevaCanasta = $miIdCanastaMax[0]['MAX(id_canasta)'] + 1;


        $h = 0;
        $todosMisProductos = array();
        while(!empty($misProductosTop[$h])){
        $todosMisProductos = array_merge($misProductosTop[$h], $todosMisProductos);
        $h = $h +1;
        }/*
        $todosMisProductos = array_merge($misProductosTopValoracion, $todosMisProductos);*/

        
        foreach ($todosMisProductos as $indice => $producto) {
            if ($producto['id_producto'] < 11) {
                unset($todosMisProductos[$indice]);
            }
        }

       

        $conteoItems = 0;
        $tiempoCanasta2 = $tiempoCanasta * 2;

        while($conteoItems <= $tiempoCanasta2){
            $indiceAleatorio = array_rand($todosMisProductos);
            

            $todosMisProductos[$indiceAleatorio]['cantidad_incluir'] = $todosMisProductos[$indiceAleatorio]['cantidad_incluir'] + 1;
            $conteoItems = $conteoItems + 1;
        }       


        $todosMisProductos2 = [];

        // Recorre el array original
        foreach ($todosMisProductos as $producto) {
            $idProducto = $producto['id_producto'];

            // Verifica si ya existe el producto en el nuevo array
            if (isset($todosMisProductos2[$idProducto])) {
                // Si existe, suma las cantidades
                $todosMisProductos2[$idProducto]['cantidad_incluir'] += $producto['cantidad_incluir'];
            } else {
                // Si no existe, agrega el producto al nuevo array
                $todosMisProductos2[$idProducto] = $producto;
            }
        }

        $miProductoCanasta = new ProductoCanasta;
        foreach($todosMisProductos2 as $indice => $producto){
            if($producto['cantidad_incluir'] > 0){
               $miNewMaxId = json_decode(json_encode($miListaProductos->getMaxProductoCanastaId()), true);

               $miProductoPaqueteAlta = $miProductoCanasta->setProductoCanasta($producto['id_producto_paquete'],$producto['cantidad_incluir'],  $idNuevaCanasta);
               $miResultadoAlta = json_decode(json_encode($miListaProductos->altaProductosPaquetesCanasta($miProductoPaqueteAlta,$miNewMaxId[0]['MAX(id_canasta_producto)'] + 1)), true);
            }
        }      
        

        return redirect('/basket/'. $idNuevaCanasta .'');
    }


}
    





