<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\SessionController;
use DB;

class mentores extends Model
{
    use HasFactory;

    public function checkMentor($miMentor){
        

    $query = "SELECT * FROM mentores WHERE id_usuario = ?";
    return DB::select($query, array($miMentor->idUsuario));

    }

    public function altaMentor($miMentor){

        $query = "INSERT INTO mentores (id_usuario, mentor)
        VALUES (? , 0)";
    
        DB::insert($query, array($miMentor->idUsuario));
    
        return; 
        }

        public function getUsuariosNombre(){
            $query = "SELECT usuarios.usuario FROM usuarios 
            INNER JOIN mentores ON usuarios.id_usuario = mentores.id_usuario 
            WHERE mentores.mentor = 1";

            return DB::select($query, array());
        }

        public function updateMentor($miMentor){
            $query = "UPDATE mentores 
                    SET mentor = ?
                    WHERE id_usuario = ?";

            return DB::update($query, array($miMentor->estadoMentor,$miMentor->idUsuario));
        }

        public function productosMentorPos($miMentor){
            $query = "SELECT productos.id_producto, productos.nombre_producto, productos.tipo_producto, productos.nutritional_score FROM productos
                    INNER JOIN recomendaciones ON recomendaciones.id_producto = productos.id_producto
                    INNER JOIN usuarios ON recomendaciones.id_usuario = usuarios.id_usuario
                    INNER JOIN mentores ON usuarios.id_usuario = mentores.id_usuario
                    WHERE usuarios.usuario = ?
                    AND recomendaciones.valor_recomendacion = 2
                    AND mentores.mentor = 1";

            return DB::select($query, array($miMentor->idUsuario));
        }

        public function productosMentorNeg($miMentor){
            $query = "SELECT productos.id_producto, productos.nombre_producto, productos.tipo_producto, productos.nutritional_score FROM productos
                    INNER JOIN recomendaciones ON recomendaciones.id_producto = productos.id_producto
                    INNER JOIN usuarios ON recomendaciones.id_usuario = usuarios.id_usuario
                    INNER JOIN mentores ON usuarios.id_usuario = mentores.id_usuario
                    WHERE usuarios.usuario = ?
                    AND recomendaciones.valor_recomendacion = 1
                    AND mentores.mentor = 1";

            return DB::select($query, array($miMentor->idUsuario));
        }

        public function cantidadReviewsMentor($miMentor){
            $query = "SELECT COUNT(*) AS cantidad_reviews
                    FROM recomendaciones
                    INNER JOIN usuarios ON usuarios.id_usuario = recomendaciones.id_usuario
                    WHERE usuarios.usuario = ?";

            return DB::select($query, array($miMentor->idUsuario));
        }

        public function mentorActivo($miMentor){
            $query = "SELECT mentor
                    FROM mentores
                    INNER JOIN usuarios ON usuarios.id_usuario = mentores.id_usuario
                    WHERE usuarios.usuario = ?";

            return DB::select($query, array($miMentor->idUsuario));
        }

        public function canastasMentor($miMentor){
            $query = "SELECT canastas.id_canasta
                    FROM canastas
                    INNER JOIN usuarios ON usuarios.id_usuario = canastas.id_usuario
                    WHERE usuarios.usuario = ?
                    AND canastas.estado_canasta = 0";

            return DB::select($query, array($miMentor->idUsuario));
        }

        public function datosCanastaMentor($idCanasta){
            $intNumber = (int)$idCanasta;

            $query = "SELECT *
                    FROM canastas
                    WHERE id_canasta = ?
                    AND canastas.estado_canasta = 0";

            return DB::select($query, array($idCanasta, ));
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

        public function paquetesCanasta($idCanasta){                    
                    
            $query = "SELECT * FROM lista_canasta_productos
            WHERE id_canasta = ?
            AND cantidad > 0;";

            return DB::select($query, array($idCanasta));
        }

        public function importarProductos($miProducto, $maxId){
            $query = "INSERT INTO lista_canasta_productos
                    (id_canasta, cantidad, id_producto_paquete, id_canasta_producto)
                    VALUES (?,?,?,?) ";

            return DB::insert($query, array($miProducto->idCanasta,$miProducto->cantidad,$miProducto->id, $maxId));
        }

        public function maxIdCanastaProducto(){
            $query = "SELECT MAX(id_canasta_producto) FROM lista_canasta_productos";

            return DB::select($query, array());
        }

        
        public function topMentores(){
                $query = "SELECT usuarios.usuario 
                        FROM usuarios
                        INNER JOIN mentores ON mentores.id_usuario = usuarios.id_usuario
                        ORDER BY mentores.valoracion_mentor DESC";

            return DB::select($query, array());
        }






}
