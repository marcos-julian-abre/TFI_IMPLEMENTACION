<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auditoria extends Model
{
    use HasFactory;

    public function auditMaxId(){
        $queryAuditMaxId = 'SELECT MAX(id_auditoria)
                            FROM auditoria';

        $miMaxIdAudit = DB::select($queryAuditMaxId, array());

        return $miMaxIdAudit;
    }



    public function auditUserChange($miAuditoria){
        $queryAuditUserChange = 'INSERT INTO auditoria
                                 (id_auditoria,
                                 id_sesion,
                                 id_usuario,
                                 usuario,
                                 tipo_usuario,
                                 estado_usuario,
                                 fecha_cambio)
                                 VALUES (?,?,?,?,?,?,NOW())';
                            
        DB::insert($queryAuditUserChange,array($miAuditoria->idAuditoria,
                                               $miAuditoria->idSesion,
                                               $miAuditoria->idUsuario,
                                               $miAuditoria->username,
                                               $miAuditoria->tipo,
                                               $miAuditoria->estado));

        return;


    }
}
