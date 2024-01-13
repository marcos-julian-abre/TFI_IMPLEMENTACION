<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;
use App\Models\sesiones;

class LogoutController extends Controller
{
    public function logout(){

    $miLogout = SessionController::getInstance();
    $miLogout->endSession();

    return redirect ('/login');

    }
}
