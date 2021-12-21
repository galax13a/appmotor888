<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class Reports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $userEmpresa, $fecha_serve;
    public $entre1, $entre2, $menu;
    public $data1, $data_total,$data_buscar;
    public $data2;
    
    public function render()
    {
        //$this->data_total = 0;
        if($this->menu == 1) $this->data1 = $this->get_menu1();
        if($this->menu == 2) $this->data2 = $this->get_menu2();

        return view('livewire.reports.view');
    }

    public function mount(){

        $this->data_buscar = false;
        date_default_timezone_set("America/Bogota");
        $this->data_total = 0;
        $this->menu  = 1;
		$this->fecha_serve = date('Y-m-d'); //strftime("Hoy es %A y son las %H:%M");
        $this->userEmpresa = Auth::user()->empresa_id;

    }

    public function menu($data){

        $this->menu = $data;

    }
    public function buscar(){
        $this->data_buscar = true;
    }

    public function get_menu2(){
/*
        SELECT SUM(`facturas`.`operario`) as operario, SUM(`facturas`.`empresa`) as empresa, operarios.name 
        FROM `operarios` LEFT JOIN `facturas` ON `facturas`.`operario_id` = `operarios`.`id`
         WHERE facturas.empresa_id = 1 GROUP BY operarios.name;
         */

         if(!$this->data_buscar) {
            return  DB::table('operarios')
              ->join('facturas', 'facturas.operario_id', '=', 'operarios.id')
              ->select(DB::raw(" SUM(facturas.operario) as operario, SUM(facturas.empresa) as empresa,SUM(facturas.value) as value, operarios.name as name"))
              ->groupBy('operarios.name')      
              ->orderBy('operario', 'desc')
              ->Where("facturas.empresa_id", Auth::user()->empresa_id)
              ->get();
          }else {
            return  DB::table('operarios')
              ->join('facturas', 'facturas.operario_id', '=', 'operarios.id')
              ->select(DB::raw(" SUM(facturas.operario) as operario, SUM(facturas.empresa) as empresa,SUM(facturas.value) as value, operarios.name as name"))
              ->groupBy('operarios.name')      
              ->orderBy('operario', 'desc')
              ->Where("facturas.empresa_id", Auth::user()->empresa_id)
               ->whereBetween('facturas.fecha', [$this->entre1, $this->entre2])
            ->get();
          }

    }

    public function get_menu1(){

     if(!$this->data_buscar) {
        return  DB::table('services')
          ->join('facturas', 'facturas.servicio_id', '=', 'services.id')
          ->join('carstypes', 'services.cars_id', '=', 'carstypes.id')
          ->select(DB::raw(" SUM(facturas.value) as total, services.name, carstypes.icon as icon"))
          ->groupBy('services.name')
          ->groupBy('carstypes.icon') 
          ->groupBy('facturas.value')              
          ->orderBy('total', 'desc')
          ->Where("carstypes.empresa_id", Auth::user()->empresa_id)
          ->get();
      }else {
        return  DB::table('services')
        ->join('facturas', 'facturas.servicio_id', '=', 'services.id')
        ->join('carstypes', 'services.cars_id', '=', 'carstypes.id')
        ->select(DB::raw(" SUM(facturas.value) as total, services.name, carstypes.icon as icon"))
        ->groupBy('services.name')
        ->groupBy('carstypes.icon') 
        ->groupBy('facturas.value')              
        ->orderBy('total', 'desc')
        ->Where("carstypes.empresa_id", Auth::user()->empresa_id)
        ->whereBetween('facturas.fecha', [$this->entre1, $this->entre2])
        ->get();
      }
  
    }
}
