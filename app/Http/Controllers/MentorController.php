<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Producto;
use App\Models\ProductoCanasta;
use App\Models\productos;
use App\Models\Usuario;
use App\Models\Metas;
use App\Models\Canasta;
use App\Models\canastas;
use App\Models\Recomendacion;
use App\Models\Mentor;
use App\Models\mentores;

class MentorController extends Controller {

    public function mentorView(){
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



        $iterarMentor = new Mentor;
        $miConsultaMentores = new mentores;

        $miMentor = $iterarMentor->setMentor('','', Session::get('id_usuario'));

        $miCheckMentor = json_decode(json_encode($miConsultaMentores->checkMentor($miMentor)), true);

        if(empty($miCheckMentor)){
            $miAltaMentor = json_decode(json_encode($miConsultaMentores->altaMentor($miMentor)), true);

            $miCheckMentor = json_decode(json_encode($miConsultaMentores->checkMentor($miMentor)), true);
        }

        $miListaMentores = json_decode(json_encode($miConsultaMentores->getUsuariosNombre()), true);


        $listaUsuariosFinal = '';
        $i = 0;
        while(!empty($miListaMentores[$i])){
            $listaUsuariosFinal = $listaUsuariosFinal . '\''. $miListaMentores[$i]['usuario'] . '\', ';
        
        $i = $i +1;
        }

        if(Session::get('productos_mentor')){
            $infoProductosMentor = Session::get('productos_mentor');
        }else{
            $infoProductosMentor = array ('');
        }        

        if(Session::get('datos_mentor')){
            $infoMentor = Session::get('datos_mentor');
        }else{
            $infoMentor = array ('');
        } 

        if(Session::get('canastas_mentor')){
            $canastasMentor = Session::get('canastas_mentor');
        }else{
            $canastasMentor = array ('');
        } 

        if(Session::get('menu')){
            $menu = Session::get('menu');
        }else{
            $menu = array ('');
        } 

        $topMentores = json_decode(json_encode($miConsultaMentores->topMentores()), true);


        return view('mentor_view',[
            'tipoUsuario' => Session::get('tipo_usuario'),
            'nombreUsuario' => Session::get('usuario'),
            'canastasActuales' => $misCanastasUsuario,
            'listaProductosFinal' => $listaProductosFinal,
            'idUsuario' => Session::get('id_usuario'),
            'idSesion' => Session::get('id_sesion'),
            'datosEstadoMentor' => $miCheckMentor,
            'listaMentoresFinal' =>  $listaUsuariosFinal,
            'datosProductosMentor' => $infoProductosMentor,
            'nombreMentor'=> $infoMentor,
            'canastasMentor' => $canastasMentor,
            'menu' => $menu,
            'topMentores' => $topMentores
        ]);
    }

    public function mentorUpdate(){

        $iterarMentor = new Mentor;
        $miConsultaMentores = new mentores;

        $miMentor = $iterarMentor->setMentor('',$_POST['estado_mentor'], Session::get('id_usuario'));

        $miUpdateMentor = json_decode(json_encode($miConsultaMentores->updateMentor($miMentor)), true);

        return redirect('/mentor_view');
    }


    
    public function mentorProfile(){

        $iterarMentor = new Mentor;
        $miConsultaMentores = new mentores;
        

        $miMentor = $iterarMentor->setMentor('','', $_POST['nombre_usuario']);

        $misProductosMentor[2] = json_decode(json_encode($miConsultaMentores->productosMentorPos($miMentor)), true);
        $misProductosMentor[1] = json_decode(json_encode($miConsultaMentores->productosMentorNeg($miMentor)), true);
        $misProductosMentor[3] = json_decode(json_encode($miConsultaMentores->mentorActivo($miMentor)), true);

        if(empty($misProductosMentor[2])){
            $misProductosMentor[3][0]['mentor'] = 0;
        }

        $misDatosMentor = array('');


        $cantidadReviews = json_decode(json_encode($miConsultaMentores->cantidadReviewsMentor($miMentor)), true);

        $misCanastas = json_decode(json_encode($miConsultaMentores->canastasMentor($miMentor)), true);

        $canastasMentor = array('');


        $i = 0;

        $miIterarCanasta = new Canasta;

        foreach ($misCanastas as $item) {

            $miCanasta = $miIterarCanasta->setCanasta($item['id_canasta'],
                                                        '',
                                                        '',
                                                        '',
                                                        '',);

            $canastasMentor[$i] = json_decode(json_encode($miConsultaMentores->getPorductosCanasta($miCanasta)), true);

            $canastasMentor[$i]['datos_canasta'] = json_decode(json_encode($miConsultaMentores-> datosCanastaMentor($item['id_canasta'])), true);


            $i = $i +1;
        }


        $misDatosMentor['usuario'] = $_POST['nombre_usuario'];
        $misDatosMentor['cantidad_reviews'] = $cantidadReviews[0]['cantidad_reviews'];

        Session::put('productos_mentor', $misProductosMentor);
        Session::put('datos_mentor', $misDatosMentor);
        Session::put('canastas_mentor', $canastasMentor);
        Session::put('menu', $_POST['menu']);


        return redirect('/mentor_view');
    }


    public function mentorImport(){
        
        $miAltaCanasta = new canastas();
        $iterarCanasta = new Canasta();

        
        $iterarMentor = new Mentor;
        $miConsultaMentores = new mentores;

        $iterarProductoCanasta = new ProductoCanasta;

       
       $miIdCanastaMax = json_decode(json_encode($miAltaCanasta -> getIdCanastaMax()), true);

       $miCanasta = $iterarCanasta -> setCanasta($miIdCanastaMax[0]['MAX(id_canasta)'] + 1,
                                                0,
                                                Session::get('id_usuario'),
                                                $_POST['tiempo_canasta'],
                                                $_POST['nombre_canasta']);

        $miAltaCanasta->altaCanasta($miCanasta);

        $idNuevaCanasta = $miIdCanastaMax[0]['MAX(id_canasta)'] + 1;

        $canastaExportada = json_decode(json_encode($miConsultaMentores -> paquetesCanasta($_POST['id_canasta'])), true);

        $i = 0;
        while(!empty($canastaExportada[$i])){
        $miProductoPaqueteCanasta = $iterarProductoCanasta->setProductoCanasta($canastaExportada[$i]['id_producto_paquete'],$canastaExportada[$i]['cantidad'],$idNuevaCanasta);

        $maxId = json_decode(json_encode($miConsultaMentores -> maxIdCanastaProducto()), true);


        $altaProductos = $miConsultaMentores->importarProductos($miProductoPaqueteCanasta, $maxId[0]['MAX(id_canasta_producto)'] + 1);


        $i = $i +1;
        }


        return redirect('/basket/'. $idNuevaCanasta .'');



    }




}
