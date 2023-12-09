<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class canastas extends Model
{
    use HasFactory;

    public function getIdCanastaMax(){
        $maxCanastaIdQuery = "SELECT MAX(id_canasta)
                                  FROM canastas";
        return DB::select($maxCanastaIdQuery, array());
    }

    public function altaCanasta($miCanasta){
        $queryAltaCanasta = "INSERT INTO canastas (id_canasta, 
                                                   estado_canasta, 
                                                   id_usuario, 
                                                   tiempo_canasta, 
                                                   nombre_canasta) 
        VALUES (?,?,?,?,?) ";

        DB::insert($queryAltaCanasta,array($miCanasta->idCanasta,
                                           $miCanasta->estadoCanasta, 
                                           $miCanasta->idUsuario, 
                                           $miCanasta->tiempoCanasta, 
                                           $miCanasta->nombre_canasta));

        return;
    }


    public function getCanastaByUsuario ($miUsuario){
        $queryGetCanastaByUsuario = "SELECT * FROM canastas
                                     WHERE estado_canasta = ?
                                     AND id_usuario = ?";

        return DB::select($queryGetCanastaByUsuario,array(0,$miUsuario->id));
       }

       public function getCanastaById ($miCanasta){
        $querygetCanastaById = "SELECT * FROM canastas
                                     WHERE estado_canasta = ?
                                     AND id_canasta = ?";

        return DB::select($querygetCanastaById,array(0,$miCanasta));
       }

    public function bajaCanasta($miCanasta){
        $queryBajaCanasta = "UPDATE canastas
                             SET estado_canasta = ?
                             WHERE id_canasta = ?";      
                             
        DB::update($queryBajaCanasta, array(1,$miCanasta->idCanasta));

        return;
    } 

    public function addProductToBasket($miCanasta, $miProductoPaquete){
        $queryAddProductToBasket = "INSERT INTO lista_canasta_productos
                                    (id_canasta, cantidad, id_canasta_producto, id_producto_paquete)
                                    VALUES (?,?,?,?)";

        DB::insert($queryAddProductToBasket,array($miCanasta->idCanasta,
        1, 
        $miProductoPaquete->idMaxProductoCanasta, 
        $miProductoPaquete ->idProductoPaquete));

        return;

    }

    public function getMaxIdFromListaCanastaProductos(){
        $queryGetMaxIdFromListaCanastaProductos = "SELECT MAX(id_canasta_producto)
                                                    FROM lista_canasta_productos";

        $maxIdCanastaProducto = DB::select($queryGetMaxIdFromListaCanastaProductos, array());

        return $maxIdCanastaProducto;

    }

    public function getPorductosCanasta($miCanasta){
        $queryGetProductoCanasta = "SELECT productos.id_producto, 
                                    canastas.tiempo_canasta, 
                                    lista_canasta_productos.cantidad, 
                                    lista_producto_paquetes.peso, 
                                    productos.nombre_producto,
                                    productos.tipo_producto,
                                    productos.apto_vegano,
                                    productos.apto_vegetariano,
                                    productos.apto_celiaco,
                                    productos.nutritional_score,
		                            lista_canasta_productos.id_canasta_producto
                                    FROM canastas
                                    INNER JOIN lista_canasta_productos ON canastas.id_canasta = lista_canasta_productos.id_canasta
                                    INNER JOIN lista_producto_paquetes ON lista_canasta_productos.id_producto_paquete = lista_producto_paquetes.id_producto_paquete
                                    INNER JOIN productos ON lista_producto_paquetes.id_producto = productos.id_producto
                                    WHERE canastas.id_canasta = ?
                                    AND canastas.estado_canasta = ?
                                    AND lista_canasta_productos.cantidad > 0 ";

        return DB::select($queryGetProductoCanasta, array($miCanasta->idCanasta, 0));

    }
    
    public function updateCantidadProductoCanasta($miProductoCanasta){
        $queryUpdateCantidadProductoCanasta = "UPDATE lista_canasta_productos
                                               SET cantidad = ?
                                               WHERE id_canasta_producto = ?";

        DB::update($queryUpdateCantidadProductoCanasta, array($miProductoCanasta->cantidad, $miProductoCanasta->id));
        return;
    }

    public function validarProductoPaqueteCanasta($miProductoCanasta){
        $queryValidarProductoPaqueteCanasta = "SELECT * 
                                               FROM lista_canasta_productos
                                               WHERE id_canasta = ?
                                               AND id_producto_paquete = ?
                                               AND NOT cantidad = 0";
 
        return DB::select($queryValidarProductoPaqueteCanasta, array($miProductoCanasta->idCanasta, $miProductoCanasta->id));


    }

    public function getTiempoCanastaByIdCanasta($miCanasta){
        $queryGetTiempoCanastaByIdCanasta = "SELECT tiempo_canasta
                                             FROM canastas
                                             WHERE id_canasta = ?";

        return DB::select($queryGetTiempoCanastaByIdCanasta, array($miCanasta->idCanasta));                                    
    }
}
