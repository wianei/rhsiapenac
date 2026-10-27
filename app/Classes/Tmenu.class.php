<?php


namespace App\Classes;


class Tmenu
{
    public static function getNome($id){

        $menu = array(
            "Atestados" => "1",
            "Afastamentos" => "5",
            "Concessões" => "8",
            "Férias" => "9",
            "Licenças" => "7",
            "Penalidades" => "10",
            "Remoções" => "11",
            "Redistribuições" => "12",
            "Substituições" => "13",
            "Vacâncias" => "14",
            "Elogio" => "15",
        );
        $menuNome = array_search($id, $menu);

        return $menuNome;

    }
}