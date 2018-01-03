<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgenciaController extends Controller
{
    public function getPlanes(Request $request){
        $a = "hola";
        return json_encode(array("success" => true));
    }
}
