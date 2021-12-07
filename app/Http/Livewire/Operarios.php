<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Operario;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;

class Operarios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $dni, $wsp, $status;
    public $updateMode = false;
    public $gastos, $gasto_id, $empresa_id;

    public function updatingKeyWord(){
        $this->resetPage();
    }
    
    public function  mount(){
        $this->empresa_id = Auth::user()->empresa_id;
        $this->gastos =  Gasto::Where('empresa_id', $this->empresa_id)->get();
    }

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.operarios.view', [
            'operarios' => Operario::latest()
                        ->Where('empresa_id', $this->empresa_id)
						->Where('name', 'LIKE', $keyWord)
						->paginate(10),
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
		$this->dni = null;
		$this->wsp = null;
		//$this->status = 1;
	//	$this->empresa_id = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
        ]);

        Operario::create([ 
			'name' => $this-> name,
			'dni' => $this-> dni,
			'wsp' => $this-> wsp,
			'status' => 1,
			'empresa_id' => $this-> empresa_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Operario Successfully created.');
    }

    public function edit($id)
    {
        $record = Operario::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->dni = $record-> dni;
		$this->wsp = $record-> wsp;
		$this->status = $record-> status;
		//$this->empresa_id = $record-> empresa_id;
        $this->gasto_id = $record-> gasto_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
        'gasto_id' => 'required'
        ]);

        if ($this->selected_id) {
			$record = Operario::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'dni' => $this-> dni,
			'wsp' => $this-> wsp,
			'status' => $this-> status,
            'gasto_id' =>$this->gasto_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Operario Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Operario::where('id', $id);
          //  $record->delete();
        }
    }

    public function ckeking($id, $check){
        $record = Operario::find($id);
        $record->update([ 
        'status' => $check
        ]);
       
       session()->flash('message', 'Successfully updated.');
    }
}
