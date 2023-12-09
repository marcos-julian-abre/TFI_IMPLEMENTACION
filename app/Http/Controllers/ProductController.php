<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\productos;
use App\Models\Usuario;
use App\Models\Metas;
use App\Models\Canasta;
use App\Models\canastas;
use App\Models\Recomendacion;


class ProductController extends Controller
{
    public function productView(){


        if(is_null(request('nombre_producto'))){            
            $miNuevoProducto = Session::get('nombre_producto');
        } else {            
        $miNuevoProducto = request('nombre_producto');
        }


        $iterarProducto = new Producto();

        $miProducto = $iterarProducto -> setProducto('', 
                                                    $miNuevoProducto, 
                                                    '',
                                                    '',
                                                    '',
                                                    '',
                                                    '',
                                                    '');


        $nuevoProducto = new productos();

        $datosProducto = json_decode(json_encode($nuevoProducto->getProductByName($miProducto)), true);          

        if(empty($datosProducto)){
            $alertaBusquedaProducto = 1;
            $productosAlternativos = NULL;
            $ingredientesProducto = NULL;
            $datosVariables = NULL;            
            $variablesMetasUsuario = NULL;

        }else{
            $alertaBusquedaProducto = 0;

            
        $ingredientesProducto = json_decode(json_encode($nuevoProducto->getIngredientsByProduct($miProducto)), true); 

        $miProducto = $iterarProducto -> setProducto('', 
                                                    $miNuevoProducto,
                                                    $datosProducto[0]['tipo_producto'],
                                                    '',
                                                    '',
                                                    '',
                                                    '',
                                                    '');

        $productosAlternativos= json_decode(json_encode($nuevoProducto->getAlternativasByType($miProducto)), true); 

        shuffle($productosAlternativos);

        $datosVariables = json_decode(json_encode($nuevoProducto->getPromedioVariables($miProducto)), true); 

        $nuevoUsuario = new Usuario;

        $miUsuario = $nuevoUsuario -> setUsuario('', 
                                                    '', 
                                                    '',
                                                    Session::get('id_usuario'),
                                                    '',
                                                    '');

        $nuevasMetas = new metas;

        $variablesMetasUsuario = json_decode(json_encode($nuevasMetas->getVariableByListaMetas($miUsuario)), true); 
        }


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




        $miRecomendacion = new Recomendacion();

        $miNuevaRecomendacion = $miRecomendacion->setRecomendacion($datosProducto[0]['id_producto'],
                                                                    Session::get('id_usuario'),
                                                                    '',
                                                                    '',);   
                                                                    
        $checkRecomendacion = json_decode(json_encode($nuevoProducto->getRecomendacionExistente($miNuevaRecomendacion)), true);

        if(empty($checkRecomendacion)){
            $checkRecomendacion[0]['valor_recomendacion'] = 0;
        }

        $checkPorcRecomendacion = json_decode(json_encode($nuevoProducto->getPorcentajeRecomendacion($miNuevaRecomendacion)), true);

        return view('product_profile_view',
        ['datosProducto' => $datosProducto,        
        'tipoUsuario' => Session::get('tipo_usuario'),
        'nombreUsuario' => Session::get('usuario'),
        'alertaBusquedaProducto'=>$alertaBusquedaProducto,
        'ingredientesProducto' => $ingredientesProducto,
        'productosAlternativos'=> $productosAlternativos,
        'datosVariables'=> $datosVariables,
        'variablesMetasUsuario' => $variablesMetasUsuario,
        'canastasActuales' => $misCanastasUsuario,
        'listaProductosFinal' => $listaProductosFinal,
        'recomendacionProducto' => $checkRecomendacion,
        'ratingProducto' => $checkPorcRecomendacion]
        );
    }


    public function listProductsView(){

        $miListaProductos = new productos();
        $misProductosTodos = json_decode(json_encode($miListaProductos->getAllProductos()), true);



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


        return view('list_products_view',[
            'tipoUsuario' => Session::get('tipo_usuario'),
            'nombreUsuario' => Session::get('usuario'),
            'canastasActuales' => $misCanastasUsuario,
            'listaProductosFinal' => $listaProductosFinal,
            'idUsuario' => Session::get('id_usuario'),
            'idSesion' => Session::get('id_sesion'),
            'productosLista' => $misProductosTodos
        ]);
    }

    public function productSuggestion(){         
        
        $miNuevoProducto = request('nombre_producto');        
        $miNuevoRecomendacion = request('recomendacion_producto');        
        $miNuevoIdProducto = request('id_producto');

        $miRecomendacion = new Recomendacion();

        $miNuevaRecomendacion = $miRecomendacion->setRecomendacion($miNuevoIdProducto,
                                                                    Session::get('id_usuario'),
                                                                    $miNuevoRecomendacion,
                                                                    '',);   

    $misProductos = new productos;


    $checkRecomendacion = json_decode(json_encode($misProductos->getRecomendacionExistente($miNuevaRecomendacion)), true);


        if(empty($checkRecomendacion)){
            $nuevaRecomendacion = json_decode(json_encode($misProductos->altaRecomendacion($miNuevaRecomendacion)), true);           

        }else{        
            if($checkRecomendacion[0]['valor_recomendacion'] == $miNuevoRecomendacion){
                $miNuevoRecomendacion = 0;
            }
            
            $miNuevaRecomendacion = $miRecomendacion->setRecomendacion($miNuevoIdProducto,
                                                                        Session::get('id_usuario'),
                                                                        $miNuevoRecomendacion,
                                                                        $checkRecomendacion[0]['id_recomendacion'],);

            $nuevaRecomendacion = json_decode(json_encode($misProductos->updateRecomendacion($miNuevaRecomendacion)), true);
        }

        Session::put('nombre_producto',  $miNuevoProducto);

        return redirect('/product_profile');
    }



}
