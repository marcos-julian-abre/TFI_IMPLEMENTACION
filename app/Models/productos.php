<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class productos extends Model
{
    use HasFactory;

    public function getProductosNombre(){
        $queryGetUsuarioMetas = "SELECT nombre_producto
                                FROM productos
                                WHERE id_producto > 10";

        return DB::select($queryGetUsuarioMetas, array());

    }

    public function getAllProductos(){
        $querygetAllProductos = "SELECT *
                                FROM productos
                                WHERE id_producto > 10";

        return DB::select($querygetAllProductos, array());

    }

    public function getPaquetesByName($miProducto){
        $queryGetProductoIdByName = "SELECT productos.nombre_producto, lista_producto_paquetes.peso, lista_producto_paquetes.id_producto_paquete
                                    FROM productos
                                    INNER JOIN lista_producto_paquetes ON productos.id_producto = lista_producto_paquetes.id_producto
                                    WHERE productos.nombre_producto = ? ";

        return DB::select($queryGetProductoIdByName, array($miProducto->nombreProducto));
    }

    public function getPorductosVariables($miProductoVariable){
        $queryGetProductosVariables = "SELECT cantidad_cien_gr, descripcion_variable_nutricional
                                    FROM lista_info_nutricional
                                    INNER JOIN variables_nutricionales ON variables_nutricionales.id_variable_nutricional = lista_info_nutricional.id_variable_nutricional
                                    WHERE lista_info_nutricional.id_variable_nutricional = ?
                                    AND lista_info_nutricional.id_producto = ?";

        return DB::select($queryGetProductosVariables,array($miProductoVariable->idVariable, $miProductoVariable->idProducto));
    }

    public function getProductSortVariableDesc($miProductoVariable){
        $queryGetProductSortVariableDesc ="SELECT productos.id_producto, productos.nombre_producto
                                            FROM productos 
                                            INNER JOIN lista_info_nutricional ON productos.id_producto = lista_info_nutricional.id_producto
                                            WHERE lista_info_nutricional.id_variable_nutricional = ?
                                            AND productos.tipo_producto = ?
                                            ORDER BY lista_info_nutricional.cantidad_cien_gr DESC";
        
        return DB::select($queryGetProductSortVariableDesc, array($miProductoVariable->idVariable, $miProductoVariable->tipoProducto));
    }

    public function getProductSortVariableAsc($miProductoVariable){
        $queryGetProductSortVariableAsc ="SELECT productos.id_producto, productos.nombre_producto
                                            FROM productos 
                                            INNER JOIN lista_info_nutricional ON productos.id_producto = lista_info_nutricional.id_producto
                                            WHERE lista_info_nutricional.id_variable_nutricional = ?
                                            AND productos.tipo_producto = ?
                                            ORDER BY lista_info_nutricional.cantidad_cien_gr ASC";
        
        return DB::select($queryGetProductSortVariableAsc, array($miProductoVariable->idVariable, $miProductoVariable->tipoProducto));
    }

    public function getProductByName($miProducto){
        $querygetProductByName ="SELECT * FROM productos 
        INNER JOIN lista_info_nutricional ON productos.id_producto = lista_info_nutricional.id_producto
        INNER JOIN variables_nutricionales ON variables_nutricionales.id_variable_nutricional = lista_info_nutricional.id_variable_nutricional
        WHERE productos.nombre_producto = ?";

        return DB::select( $querygetProductByName, array($miProducto->nombreProducto));
    }

    public function getIngredientsByProduct($miProducto) {
        $querygetIngredientsByProduct ="SELECT * FROM productos 
        INNER JOIN lista_producto_ingredientes ON productos.id_producto = lista_producto_ingredientes.id_producto
        INNER JOIN ingredientes ON ingredientes.id_ingrediente = lista_producto_ingredientes.id_ingrediente
        WHERE productos.nombre_producto = ?";

        return DB::select( $querygetIngredientsByProduct, array($miProducto->nombreProducto));        
    }

    public function getAlternativasByType($miProducto){
        $querygetAlternativasByType ="SELECT id_producto, nombre_producto, tipo_producto, nutritional_score FROM productos 
        WHERE tipo_producto = ?
        AND nombre_producto != ?
        AND id_producto > 10";

        return DB::select( $querygetAlternativasByType, array($miProducto->tipoProducto,$miProducto->nombreProducto));
    }

    public function getPromedioVariables(){
        $querygetPromedioVariables ="SELECT variables_nutricionales.descripcion_variable_nutricional, AVG(lista_info_nutricional.cantidad_cien_gr) as promedio, MAX(lista_info_nutricional.cantidad_cien_gr) as max, MIN(lista_info_nutricional.cantidad_cien_gr) as min FROM lista_info_nutricional
                                    INNER JOIN variables_nutricionales ON lista_info_nutricional.id_variable_nutricional = variables_nutricionales.id_variable_nutricional
                                    GROUP BY variables_nutricionales.id_variable_nutricional";

        return DB::select( $querygetPromedioVariables,array());

    }

    public function getProductById($miProducto){
        $querygetProductById ="SELECT * FROM productos 
        INNER JOIN lista_info_nutricional ON productos.id_producto = lista_info_nutricional.id_producto
        INNER JOIN variables_nutricionales ON variables_nutricionales.id_variable_nutricional = lista_info_nutricional.id_variable_nutricional
        WHERE productos.id_producto = ?";

        return DB::select( $querygetProductById, array($miProducto->idProducto));
    }

    public function getMaxIdProducts(){
        $querygetMaxIdProducts ="SELECT MAX(id_producto) FROM productos";

        return DB::select( $querygetMaxIdProducts,array());
    }

    public function getIdProductsType($miProducto){
        $querygetIdProductsType ="SELECT id_producto FROM productos
                                WHERE tipo_producto = ?";

        return DB::select( $querygetIdProductsType,array($miProducto->tipoProducto));
    }


    public function getRecomendacionExistente($miRecomendacion){
        $querygetRecomendacionExistente = "SELECT * FROM recomendaciones
                                            WHERE id_producto = ?
                                            AND id_usuario = ?";

        return DB::select($querygetRecomendacionExistente,array($miRecomendacion->idProducto, $miRecomendacion->idUsuario));
    }


    public function altaRecomendacion($miRecomendacion){
        $query = "INSERT INTO recomendaciones (id_usuario, id_producto, valor_recomendacion)
                  VALUES (?,?,?)";

    return DB::insert($query, array($miRecomendacion->idUsuario, $miRecomendacion->idProducto, $miRecomendacion->recomendacionProducto));
    }

    public function updateRecomendacion($miRecomendacion){
        $query = "UPDATE recomendaciones
                 SET valor_recomendacion = ?
                WHERE id_recomendacion = ?";
                      
    return DB::update($query, array($miRecomendacion->recomendacionProducto, $miRecomendacion->idRecomendacion));
    }

    public function getPorcentajeRecomendacion($miRecomendacion){
        $query = "SELECT COUNT(id_producto) as votos, valor_recomendacion FROM recomendaciones
                  WHERE id_producto = ?
                  GROUP BY valor_recomendacion
                  ORDER BY valor_recomendacion DESC ";

        return DB::select($query, array($miRecomendacion->idProducto));
    }

    public function getTopProductsAsc($variable){
        $query = "SELECT * FROM productos
                INNER JOIN lista_info_nutricional ON productos.id_producto = lista_info_nutricional.id_producto
                INNER JOIN variables_nutricionales ON lista_info_nutricional.id_variable_nutricional = variables_nutricionales.id_variable_nutricional
                WHERE variables_nutricionales.id_variable_nutricional = ?
                ORDER BY lista_info_nutricional.cantidad_cien_gr ASC
                LIMIT 4";

        return DB::select($query, array($variable));
    }

    public function getTopProductsDesc($variable){
        $query = "SELECT * FROM productos
                INNER JOIN lista_info_nutricional ON productos.id_producto = lista_info_nutricional.id_producto
                INNER JOIN variables_nutricionales ON lista_info_nutricional.id_variable_nutricional = variables_nutricionales.id_variable_nutricional
                WHERE variables_nutricionales.id_variable_nutricional = ?
                ORDER BY lista_info_nutricional.cantidad_cien_gr DESC
                LIMIT 4";

        return DB::select($query, array($variable));
    }

    public function getTopProductosRecom(){
        $query = "SELECT productos.id_producto, productos.nombre_producto, COUNT(*) as cantidad
                FROM recomendaciones
                INNER JOIN productos ON recomendaciones.id_producto = productos.id_producto
                WHERE valor_recomendacion = 2
                GROUP BY id_producto
                ORDER BY cantidad DESC
                LIMIT 3";

        return DB::select($query, array());
    }

    public function getProductoPaquetebyIdProducto($idProducto){
       $query="SELECT id_producto_paquete FROM lista_producto_paquetes
                WHERE id_producto = ?
                LIMIT 1";

        return DB::select($query, array($idProducto));
    }

    public function getProductoPaquetebyIdProducto2($miProducto){
        $query="SELECT id_producto_paquete FROM lista_producto_paquetes
                 WHERE id_producto = ?
                 LIMIT 1";
    
         return DB::select($query, array($miProducto->idProducto));
     }

    public function altaProductosPaquetesCanasta($miProductoPaquete,$maxId){
        $querygetProductById ="INSERT INTO lista_canasta_productos (id_producto_paquete, cantidad, id_canasta, id_canasta_producto)
                                VALUES (?,?,?,?)";

        return DB::insert( $querygetProductById, array($miProductoPaquete->id, $miProductoPaquete->cantidad, $miProductoPaquete->idCanasta,$maxId));
    }

    public function getMaxProductoCanastaId(){
        $querygetProductById ="SELECT MAX(id_canasta_producto)
                                FROM lista_canasta_productos";

        return DB::select( $querygetProductById, array());
    }
 
 



}
