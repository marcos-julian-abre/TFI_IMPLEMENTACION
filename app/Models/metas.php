<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metas extends Model
{
    use HasFactory;

    public function getListaMetas(){

        $listaMetasQuery = "SELECT descripcion_meta
                            FROM metas";

        return DB::select($listaMetasQuery, array());

    }

    public function getAllMetas(){

        $querygetAllMetas = "SELECT *
                            FROM metas";

        return DB::select($querygetAllMetas, array());

    }

    public function getIdMetaByDescripcion($miMeta){
        $queryGetIdMetaByDescripcion = "SELECT id_meta
                                        FROM metas
                                        WHERE descripcion_meta = ?";
        return DB::select($queryGetIdMetaByDescripcion, array($miMeta->descripcion));
    }

    public function getIdUsuarioMetasMax(){
        $maxUsuarioMetaIdQuery = "SELECT MAX(id_meta_usuario)
                                  FROM lista_usuario_metas";
        return DB::select($maxUsuarioMetaIdQuery, array());
    }

    public function insertUsuarioMetas($miMeta){
        $queryAltaUsuarioMetas = "INSERT INTO lista_usuario_metas (id_meta_usuario, id_meta, id_usuario, nivel_restriccion, meta_activa) 
        VALUES (?,?,?,?,?) ";

        DB::insert($queryAltaUsuarioMetas,array($miMeta->idUsuarioMeta,$miMeta->idMeta, $miMeta->idUsuario, $miMeta->restriccion, '1'));

        return;
    }

    public function getUsuarioMetas($miMeta){
        $queryGetUsuarioMetas = "SELECT *
                                FROM lista_usuario_metas
                                INNER JOIN metas ON lista_usuario_metas.id_meta = metas.id_meta
                                INNER JOIN variables_nutricionales ON variables_nutricionales.id_variable_nutricional = metas.id_variable_nutricional
                                WHERE id_usuario = ?
                                AND meta_activa = ?";

        return DB::select($queryGetUsuarioMetas, array($miMeta->idUsuario, '1'));

    }


    public function deleteMetaUsuarioByIdMetaUsuario($miMeta){
        $queryDeleteMetaUsuarioByIdMetaUsuario = "UPDATE lista_usuario_metas
                                                  SET meta_activa = ?
                                                  WHERE id_meta_usuario = ?";

        DB::update($queryDeleteMetaUsuarioByIdMetaUsuario, array('0',$miMeta->idUsuarioMeta));

        return;

    }

    public function validarMetaUsuario($miMeta){
        $queryValidarMetaUsuario = "SELECT *
                                    FROM lista_usuario_metas
                                    INNER JOIN metas ON metas.id_meta = lista_usuario_metas.id_meta
                                    WHERE metas.id_variable_nutricional = ?
                                    AND lista_usuario_metas.id_usuario = ?
                                    AND lista_usuario_metas.meta_activa = 1
                                    AND NOT lista_usuario_metas.id_meta = ?";

        return DB::select($queryValidarMetaUsuario, array($miMeta->idVariable, $miMeta->idUsuario, $miMeta->idMeta));
    }
 
    public function updateMetaUsuario($miMeta){
        $queryUpdateMetaUsuario = "UPDATE lista_usuario_metas
                                   SET nivel_restriccion = ?,
                                   meta_activa = ? 
                                   WHERE id_usuario = ?
                                   AND id_meta = ?";

        DB::update($queryUpdateMetaUsuario,array($miMeta->restriccion, '1' ,$miMeta->idUsuario, $miMeta->idMeta));

        return;
    }

    public function getIdVariableByDescription($miMeta){
        $queryGetIdVariableByDescription = "SELECT id_variable_nutricional
                                        FROM metas
                                        WHERE descripcion_meta = ?";
        return DB::select($queryGetIdVariableByDescription, array($miMeta->descripcion));

    }


    public function validarMetaUsuarioActualizar($miMeta){
        $queryValidarMetaUsuarioActualizar = "SELECT * 
                                              FROM lista_usuario_metas
                                              WHERE id_usuario = ?
                                              and id_meta = ?";
        return DB::select($queryValidarMetaUsuarioActualizar, array($miMeta->idUsuario,$miMeta->idMeta));
    }

    public function getVariableByListaMetas($miUsuario){
        $querygetVariableByListaMetas = "SELECT variables_nutricionales.id_variable_nutricional
                                FROM variables_nutricionales
                                INNER JOIN metas ON variables_nutricionales.id_variable_nutricional = metas.id_variable_nutricional
                                INNER JOIN lista_usuario_metas ON metas.id_meta = lista_usuario_metas.id_meta
                                WHERE id_usuario = ?
                                AND meta_activa = ?";

        return DB::select($querygetVariableByListaMetas, array($miUsuario->id, '1'));

    }
}