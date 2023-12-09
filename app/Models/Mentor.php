<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    public function setMentor($idMentor, 
                               $estadoMentor, 
                               $idUsuario, 
                              ){
        $miMentor = new \stdClass;
        $miMentor->idUsuario = $idMentor;
        $miMentor->estadoMentor = $estadoMentor;
        $miMentor->idUsuario = $idUsuario;   
       
        return $miMentor; 

}
}