<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IprintController extends Controller
{
    //imprimir en factory
    public function __invoke($id,$operario,$service,$valor){
        return 'home print '.$service;
    }
    public function index() {
        return 'Print controller';
    }
    public function xprint($id,$operario,$service, $placa, $valor,$cliente,$icon){
        //return 'Listo para imprimir '.$service;
        date_default_timezone_set("America/Bogota");
        $fecha = 	$this->fecha_server =  date('Y-m-d h:i:s');
        return view('print/index', compact('operario','service','valor','placa','fecha','cliente','icon'));


    }

    public function xsprint(){
        //return 'Listo para imprimir '.$service;
        date_default_timezone_set("America/Bogota");

        return view('print/index', compact('operario','service','valor','placa'));


    }
}
