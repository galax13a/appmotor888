<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Caja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Gasto;

class Cajas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $fecha, $valor, $status, $gastos_id, $empresa_id;
    public $updateMode = false;
    public $fecha_serve, $gastos, $userEmpresa, $value, $id_gasto;
    public $total_gasto, $total_ingreso, $total_caja;
    public $entre1, $entre2, $buscar;

    public function mount()
	{
        date_default_timezone_set("America/Bogota");
		$this->userEmpresa = Auth::user()->empresa_id;
		$this->fecha_serve = date('Y-m-d'); //strftime("Hoy es %A y son las %H:%M");
        $this->value = 0;
        $this->keyWord = $this->fecha_serve;
       // $this->entre2 = $this->fecha_serve;

    }

  
    public function buscar() {
            $this->buscar = true;
    }
    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        $this->userEmpresa = Auth::user()->empresa_id;
        $this->gastos = Gasto::where('empresa_id', $this->userEmpresa)->get();
        $this->fecha_serve = date('Y-m-d'); 
       

        if($this->buscar){
          //  $data = Modelo::whereBetween('created_at', ['2018/11/10 12:00:00', '2018/11/11 10:30:00'])->get();
            return view('livewire.cajas.view', [
                'cajas' => Caja::Where("empresa_id", Auth::user()->empresa_id)
                            ->whereBetween('fecha', [$this->entre1, $this->entre2])
                            ->orderBy('fecha')
                            ->paginate(200)
            ]);

        }else{
            return view('livewire.cajas.view', [
                'cajas' => Caja::latest()
                            ->Where("empresa_id", Auth::user()->empresa_id)
                        ->Where('fecha', 'LIKE', $keyWord)
                            ->paginate(200)
            ]);
    }

        $this->emit('combos');

    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->name = null;
		//$this->fecha = null;
		$this->value = null;
		$this->status = 0;
		$this->gastos_id = null;
		//$this->empresa_id = null;
    }

    public function store()
    {
       
        $this->validate([
		'value' => 'required',
		'gastos_id' => 'required',
        ]);

        Caja::create([ 
			'name' => $this-> name,
			'fecha' => $this-> keyWord,
			'valor' => $this-> value,
			'status' => 0,
			'gastos_id' => $this-> id_gasto,
			'empresa_id' => $this-> userEmpresa
        ]);
        
        $this->resetInput();
		//$this->emit('closeModal');
		//session()->flash('message', 'Caja Successfully created.');
        $this->emit('combos');
    }

    public function edit($id)
    {
        $record = Caja::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->fecha = $record-> fecha;
		$this->valor = $record-> valor;
		$this->status = $record-> status;
		$this->gastos_id = $record-> gastos_id;
		$this->empresa_id = $record-> empresa_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'fecha' => 'required',
		'valor' => 'required',
		'gastos_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Caja::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'fecha' => $this-> fecha,
			'valor' => $this-> valor,
			'status' => $this-> status,
			'gastos_id' => $this-> gastos_id,
			'empresa_id' => $this-> empresa_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Caja Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Caja::where('id', $id);
            $record->delete();
        }
    }
}
