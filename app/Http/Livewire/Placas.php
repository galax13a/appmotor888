<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mycar;

class Placas extends Component
{
    public $carros_cliente;
    public $placas;

    public function  mount(){
        $this->placas = 'sakndks-sadsf-dfdsfs';
    }
    public function render()
    {
       // $this->placas = 'sakndks-sadsf-dfdsfs';
       $this->placas = Mycar::Where("cliente_id", 2)->get();
    
       //return $this->placas;

        return view('livewire.placas.getplacas', ['placas' => $this->carros_cliente]);
    }
}
