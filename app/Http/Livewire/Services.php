<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service;
use App\Models\Carstype;
use Illuminate\Support\Facades\Auth;

class Services extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $value, $status, $cars_id;
    public $cars,$porcentaje;
    public $updateMode = false;
    public $titulo = 'info tirul2o';
    public $empresa_id;
    public function  mount(){
    $this->titulo = 'Create Service';
       // $this->cars =  Carstype::pluck('id','name');
    $this->empresa_id = Auth::user()->empresa_id;
    $this->cars = Carstype::Where('empresa_id', $this->empresa_id)->get();

    }

    public function updatingKeyWord(){
        $this->resetPage();
    }
    public function render()
    {

      
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.services.view', [
            'services' => Service::latest()
                        ->Where('empresa_id', Auth::user()->empresa_id)
						->Where('name', 'LIKE', $keyWord)
						->Where('value', 'LIKE', $keyWord)
						->paginate(10)
           
        ]);
    

    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->name = null;
		$this->value = null;
		$this->status = null;
		$this->cars_id = null;
        $this->porcentaje = null;
    }

    public function store()
    {
      
        $this->validate([
		'name' => 'required',
		'value' => 'required',
		'cars_id' => 'required',
        'porcentaje' => 'required'
        ]);

        Service::create([ 
			'name' => $this-> name,
			'value' => $this-> value,
			'status' =>1,
			'cars_id' => $this-> cars_id,
            'empresa_id' => $this-> empresa_id,
            'porcentaje' => $this-> porcentaje
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Service Successfully created.');
    
    }

    public function edit($id)
    {
        $record = Service::findOrFail($id);
        $cars = Carstype::pluck('id','name');
        $titulo = 'info 55';
        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->value = $record-> value;
		$this->status = $record-> status;
		$this->cars_id = $record-> cars_id;
        $this->porcentaje = $record-> porcentaje;
        //$this->cars
		
        $this->updateMode = true;
    }
    
    public function carros(){
        $cars = Carstype::pluck('id','name');
        return('carros : ' + $cars);
    }

    public function update()
    {
        $titulo = 'info updste';
        $this->emit('titulo');
        $this->validate([
		'name' => 'required',
		'value' => 'required',
		'status' => 'required',
		'cars_id' => 'required',
        'porcentaje' => 'required'
        ]);

        if ($this->selected_id) {
			$record = Service::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'value' => $this-> value,
			'status' => $this-> status,
			'cars_id' => $this-> cars_id,
            'porcentaje' => $this->porcentaje
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Service Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Service::where('id', $id);
            $record->delete();
        }
    }
    public function ckeking($id, $check){
        $record = Service::find($id);
        $record->update([ 
        'status' => $check
        ]);
       
       session()->flash('message', 'Successfully updated.');
    }
    
}
