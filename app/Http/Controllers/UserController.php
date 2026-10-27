<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    public static function getMatricula($id){
        return DB::table('users')
            ->where('users.id', $id)
            ->value('matricula');
    }

    public static function getNome($id){
        return DB::table('users')
            ->where('users.id', $id)
            ->value('name');
    }
}
