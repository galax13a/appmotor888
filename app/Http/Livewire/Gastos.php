<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;

class Gastos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $status, $value;
    public $updateMode = false;
    public $empresa_id, $natu;

    
    public function mount(){
        $this->empresa_id = Auth::user()->empresa_id;
    }

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.gastos.view', [
            'gastos' => Gasto::latest()
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
		$this->status = null;
		//$this->empresa_id = null;
        $this->natu = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'empresa_id' => 'required',
        'natu' => 'required'
        ]);

        Gasto::create([ 
			'name' => $this-> name,
			'status' => 1,
			'empresa_id' => $this-> empresa_id,
            'natu' => $this-> natu,
            'value' => $this-> value

        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Gastos Successfully created.');
    }

    public function edit($id)
    {
        $record = Gasto::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->status = $record-> status;
        $this->natu = $record-> natu;
        $this->value = $record-> value;
		//$this->empresa_id = $record-> empresa_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'status' => 'required',
        'natu' => 'required'
        ]);

        if ($this->selected_id) {
			$record = Gasto::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'status' => $this-> status,
            'natu' => $this->natu,
            'value' => $this-> value
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Gasto Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Gasto::where('id', $id);
            $record->delete();
        }
    }

    public function updatingKeyWord(){
        $this->resetPage();
    }
    public function ckeking($id, $check){
        $record = Gasto::find($id);
        $record->update([ 
        'status' => $check
        ]);
       
       session()->flash('message', 'Successfully updated.');
    }
}
