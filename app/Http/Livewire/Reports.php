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
    
    public function render()
    {
        //$this->data_total = 0;
        if($this->menu == 1) $this->data1 = $this->get_menu1();
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
