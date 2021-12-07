<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cliente;
use App\Models\Carstype;
use App\Models\Mycar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Clientes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $wsp1, $wsp2, $status, $empresa_id;
    public $updateMode = false;
    public $empresas, $carsmotor,$mycars;
    public $userEmpresa, $name_cliente;
    public $placa_id, $cars_id, $placa_busca;


    public function updatingKeyWord(){
        $this->resetPage();
    }

    public function getplaca($id){
    // return 'placa id : ' . $id;
//    return  Mycar::Where("cliente_id", $id)->get();

    return  DB::table('mycars')
			->join('carstypes', 'mycars.carstypes_id', '=', 'carstypes.id')
			->select('mycars.id as id', 'mycars.name', 'carstypes.icon as icon')
			->Where("mycars.cliente_id", $id)
			->orderBy('mycars.name')
			->get();

    }
   
    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        $placa_busca = '%'.$this->placa_busca .'%';
      
        $this->cars = Carstype::Where('empresa_id', $this->userEmpresa)->get();
        $this->userEmpresa = Auth::user()->empresa_id;

        if(empty($this->placa_busca)){
            return view('livewire.clientes.view', [
                'clientes' => Cliente::latest()
                            ->Where('empresa_id', $this->userEmpresa)
                            ->Where('name', 'LIKE', $keyWord)
                            ->orderBy('created_at', 'desc')
                            ->paginate(50)
            ]);
        }else {
            return view('livewire.clientes.view', [
                'clientes' => Cliente::latest()
                            ->Where('empresa_id', $this->userEmpresa)
                            ->Where('name', 'LIKE', $keyWord)
                            ->orderBy('created_at', 'desc')
                            ->paginate(50)

                        ]);
                        
        }
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->name = null;
		$this->wsp1 = null;
		$this->wsp2 = null;
		$this->status = null;
		//$this->empresa_id = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required'
        ]);

        Cliente::create([ 
			'name' => $this-> name,
			'wsp1' => $this-> wsp1,
			'wsp2' => $this-> wsp2,
			'status' => 1,
			'empresa_id' => $this-> empresa_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Cliente Successfully created.');
    }

    public function edit($id)
    {
        $record = Cliente::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->wsp1 = $record-> wsp1;
		$this->wsp2 = $record-> wsp2;
		$this->status = $record-> status;
		//$this->empresa_id = $record-> empresa_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'status' => 'required'
        ]);

        if ($this->selected_id) {
			$record = Cliente::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'wsp1' => $this-> wsp1,
			'wsp2' => $this-> wsp2,
			'status' => $this-> status
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Cliente Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Cliente::where('id', $id);
            $record->delete();
        }
    }

    public function deleteplaca($id){

            if ($id) {
                $record = Mycar::where('id', $id);
                $record->delete();
            }
    }

    public function ckeking($id, $check){
        $record = Cliente::find($id);
        $record->update([ 
        'status' => $check
        ]);
       
       session()->flash('message', 'Successfully updated.');
    }
    public function addcars($id, $name){
        $this->mycars = null;
        $this->mycars = Mycar::Where('cliente_id', $id)->get();
        $this->selected_id = $id;
        $this->name_cliente = $name;
    }

    public function save_add($id){
        $this->validate([
            'placa_id' => 'required|unique:mycars,name,'. $id,
            'cars_id' => 'required'
            ]);

            Mycar::create([ 
                'name' => $this-> placa_id,
                'cliente_id' => $id,
                'carstypes_id' => $this->cars_id
            ]);
            
          //  $this->resetInput();
          $this->placa_id = null;
          $this->cars_id = null;
          $this->mycars = Mycar::Where('cliente_id', $id)->get();

          $this->updateMode = false;
          $this->emit('closeModal');
         // session()->flash('message', 'Cars Add Client Successfully created.');
    
    }
}
