<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Classes\Tdata;


class LogServidorController extends Controller
{
    public static function addLog($idServidor, $texto){
        date_default_timezone_set('America/Fortaleza');
        $insertLog = DB::table('logaltservidors')->insert(
            ['id_servidor' => $idServidor,
                'matricula_usuario' => UserController::getMatricula(Auth::user()->id),
                'data' => Tdata::TdataHojeMysql(),
                'hora' => Tdata::hora(),
                'texto' => $texto,
                'nome_usuario' => UserController::getNome(Auth::user()->id)
            ]
        );

        if($insertLog){
            return true;
        }

    }
}
