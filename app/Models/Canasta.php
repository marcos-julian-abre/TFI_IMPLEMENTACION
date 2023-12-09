<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canasta extends Model
{
    use HasFactory;

    public function setCanasta($idCanasta, 
                               $estadoCanasta, 
                               $idUsuario, 
                               $tiempoCanasta, 
                               $nombre_canasta){
        $miCanasta = new \stdClass;
        $miCanasta->idCanasta = $idCanasta;
        $miCanasta->estadoCanasta = $estadoCanasta;
        $miCanasta->idUsuario = $idUsuario;   
        $miCanasta->tiempoCanasta = $tiempoCanasta;     
        $miCanasta->nombre_canasta = $nombre_canasta;
       
        return $miCanasta; 

}
}