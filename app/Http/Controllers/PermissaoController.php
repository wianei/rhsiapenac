<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissaoController extends Controller
{
    public static $idUP = 1;
    public static $idCEPA = 2;
    public static $idCEPACoord = 4;
    public static $idCOAPE = 8;
    public static $idCOAPECoord = 16;
    public static $idSetorPessoal = 32;
    public static $idSetorPessoalCoord = 64;
    public static $idSETIC = 128;
    public static $idSecretarios = 256;

    public static function temPermissao($permissaoPagina){
        return (($permissaoPagina & Auth::user()->permissao)!==0);
    }

    public static function temPermissaoUP(){
        return (Auth::user()->permissao)%2;
        return Auth::user()->permissao>=1;
    }

    public static function temPermissaoCEPA(){
        return ((Auth::user()->permissao)>>1)%2;
        return Auth::user()->permissao>=2;
    }

    public static function temPermissaoCEPACoord(){
        return ((Auth::user()->permissao)>>2)%2;
        return Auth::user()->permissao>=4;
    }

    public static function temPermissaoCOAPE(){
        return ((Auth::user()->permissao)>>3)%2;
        return Auth::user()->permissao>=8;
    }

    public static function temPermissaoCOAPECoord(){
//        return ((Auth::user()->permissao)>>4)%2;
        return Auth::user()->permissao>=16;
    }

    public static function temPermissaoSetorPessoal(){
//        return ((Auth::user()->permissao)>>5)%2;
        return Auth::user()->permissao>=32;
    }

    public static function temPermissaoSetorPessoalCoord(){
        return ((Auth::user()->permissao)>>6)%2;
        return Auth::user()->permissao>=64;
    }

    public static function temPermissaoSETIC(){
        return ((Auth::user()->permissao)>>7)%2;
        return Auth::user()->permissao>=128;
    }

    public static function temPermissaoSecretario(){
        return ((Auth::user()->permissao)>>8)%2;
        return Auth::user()->permissao>=256;
    }
}
