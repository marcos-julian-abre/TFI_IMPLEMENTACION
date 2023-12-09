<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Canasta;
use App\Models\canastas;
use App\Models\Producto;
use App\Models\productos;


class IndexController extends Controller
{

    public function index(){
    $alerta = 0; /* MODIFICAR ALERTAS */
    
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





$iterarProducto = new Producto();

$miMaxIdProductos = json_decode(json_encode($miListaProductos->getMaxIdProducts()), true);
$m=4;
while($m <= 5){
for($i=1;$i<=3;$i++){

    if(!isset($productoChart1)){
    $idProductoChartRandom[$i] = rand(11,$miMaxIdProductos[0]["MAX(id_producto)"]);

    $miProductoChart[$i] = $iterarProducto -> setProducto($idProductoChartRandom[$i], 
                                                '', 
                                                '',
                                                '',
                                                '',
                                                '',
                                                '',
                                                '');

    $miProductoView[$i] = json_decode(json_encode($miListaProductos->getProductById($miProductoChart[$i])), true);

    $productoChart1 = $miProductoView[$i][0]["tipo_producto"];
    }else{

        $miProductoChart[$i] = $iterarProducto -> setProducto('', 
                                                                '', 
                                                                $productoChart1,
                                                                '',
                                                                '',
                                                                '',
                                                                '',
                                                                '');

        $misIdProductosTipo = json_decode(json_encode($miListaProductos->getIdProductsType($miProductoChart[$i])), true);        
        
        $valorAEliminar1 = $miProductoView[1][0]["id_producto"];
        foreach ($misIdProductosTipo as $clave => $elemento) {
            if ($elemento["id_producto"] === $valorAEliminar1) {
                // Eliminar el elemento usando unset
                unset($misIdProductosTipo[$clave]);
        
                // Mostrar el array después de eliminar el elemento
                break; // Terminar el bucle una vez que se encuentra y elimina el elemento
            }
        }

        if(isset($valorAEliminar2)){            
            foreach ($misIdProductosTipo as $clave => $elemento) {
                if ($elemento["id_producto"] === $valorAEliminar2) {
                    // Eliminar el elemento usando unset
                    unset($misIdProductosTipo[$clave]);
            
                    // Mostrar el array después de eliminar el elemento
                    break; // Terminar el bucle una vez que se encuentra y elimina el elemento
                }
            }
        }

        $miTiradaProductoId["id_producto"] = 0;
        while($miTiradaProductoId["id_producto"] <= 10){
            $randomIndex = rand(0, count($misIdProductosTipo) - 1);
            while (!isset($misIdProductosTipo[$randomIndex])){
                    $randomIndex = rand(0, count($misIdProductosTipo) - 1);
                }
                    $miTiradaProductoId = $misIdProductosTipo[$randomIndex]; 
                }               
        $idProductoChartRandom[$i] =  $miTiradaProductoId["id_producto"];

        $miProductoChart[$i] = $iterarProducto -> setProducto($idProductoChartRandom[$i], 
                                                    '', 
                                                    '',
                                                    '',
                                                    '',
                                                    '',
                                                    '',
                                                    '');

            $miProductoView[$i] = json_decode(json_encode($miListaProductos->getProductById($miProductoChart[$i])), true);   
            
            $valorAEliminar2 = $miProductoView[2][0]["id_producto"];
            }    
}
$miProductoView[$m] = $miProductoView;
$m = $m +1;
unset($productoChart1);
}

    return view('index_view',
    ['alertaIndex' => $alerta,
    'tipoUsuario' => Session::get('tipo_usuario'),
    'nombreUsuario' => Session::get('usuario'),
    'canastasActuales' => $misCanastasUsuario,
    'listaProductosFinal' => $listaProductosFinal,
    'idUsuario' => Session::get('id_usuario'),
    'idSesion' => Session::get('id_sesion'),
    'miProductView' => $miProductoView
    ]
    );
    }



    public function indexAlert($alerta){    

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


        $iterarProducto = new Producto();

$miMaxIdProductos = json_decode(json_encode($miListaProductos->getMaxIdProducts()), true);

for($i=1;$i<=3;$i++){

    if(!isset($productoChart1)){
    $idProductoChartRandom[$i] = rand(11,$miMaxIdProductos[0]["MAX(id_producto)"]);

    $miProductoChart[$i] = $iterarProducto -> setProducto($idProductoChartRandom[$i], 
                                                '', 
                                                '',
                                                '',
                                                '',
                                                '',
                                                '',
                                                '');

    $miProductoView[$i] = json_decode(json_encode($miListaProductos->getProductById($miProductoChart[$i])), true);

    $productoChart1 = $miProductoView[$i][0]["tipo_producto"];
    }else{

        $miProductoChart[$i] = $iterarProducto -> setProducto('', 
                                                                '', 
                                                                $productoChart1,
                                                                '',
                                                                '',
                                                                '',
                                                                '',
                                                                '');

        $misIdProductosTipo = json_decode(json_encode($miListaProductos->getIdProductsType($miProductoChart[$i])), true);        
        
        $valorAEliminar1 = $miProductoView[1][0]["id_producto"];
        foreach ($misIdProductosTipo as $clave => $elemento) {
            if ($elemento["id_producto"] === $valorAEliminar1) {
                // Eliminar el elemento usando unset
                unset($misIdProductosTipo[$clave]);
        
                // Mostrar el array después de eliminar el elemento
                break; // Terminar el bucle una vez que se encuentra y elimina el elemento
            }
        }

        if(isset($valorAEliminar2)){            
            foreach ($misIdProductosTipo as $clave => $elemento) {
                if ($elemento["id_producto"] === $valorAEliminar2) {
                    // Eliminar el elemento usando unset
                    unset($misIdProductosTipo[$clave]);
            
                    // Mostrar el array después de eliminar el elemento
                    break; // Terminar el bucle una vez que se encuentra y elimina el elemento
                }
            }
        }

        $miTiradaProductoId["id_producto"] = 0;
        while($miTiradaProductoId <= 10){
            $randomIndex = rand(0, count($misIdProductosTipo) - 1);
            while (!isset($misIdProductosTipo[$randomIndex])){
                    $randomIndex = rand(0, count($misIdProductosTipo) - 1);
                }
                    $miTiradaProductoId = $misIdProductosTipo[$randomIndex]; 
                }
        $idProductoChartRandom[$i] =  $miTiradaProductoId["id_producto"];

        $miProductoChart[$i] = $iterarProducto -> setProducto($idProductoChartRandom[$i], 
                                                    '', 
                                                    '',
                                                    '',
                                                    '',
                                                    '',
                                                    '',
                                                    '');

            $miProductoView[$i] = json_decode(json_encode($miListaProductos->getProductById($miProductoChart[$i])), true);   
            
            $valorAEliminar2 = $miProductoView[2][0]["id_producto"];
            }    
            
}

        return view('index_view',
        ['alertaIndex' => $alerta,
        'tipoUsuario' => Session::get('tipo_usuario'),
        'nombreUsuario' => Session::get('usuario'),
        'canastasActuales' => $misCanastasUsuario,
        'listaProductosFinal' => $listaProductosFinal,
        'idUsuario' => Session::get('id_usuario'),
        'idSesion' => Session::get('id_sesion'),
        'miProductView' => $miProductoView
        ]
        );
        }


        public function aboutUs(){   
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

        return view('about_us_view',[
            'tipoUsuario' => Session::get('tipo_usuario'),
            'nombreUsuario' => Session::get('usuario'),
            'canastasActuales' => $misCanastasUsuario,
            'listaProductosFinal' => $listaProductosFinal,
            'idUsuario' => Session::get('id_usuario'),
            'idSesion' => Session::get('id_sesion')
        ]);
        }
    }



