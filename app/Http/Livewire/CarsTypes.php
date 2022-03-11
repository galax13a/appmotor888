<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Carstype;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;

class Carstypes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $status;
    public $updateMode = false;
    public $empresa_id, $color_select, $selected_id_img, $icon;

    public function mount(){
      //  $this->color_select = "secondary";
        $this->empresa_id = Auth::user()->empresa_id;
    }
    public function updatingKeyWord(){ // resetea la busqueda url 
        $this->resetPage();
    }

    public function render()
    {
       

		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.carstypes.view', [
            'carstypes' => Carstype::latest()
                        ->Where('empresa_id', Auth::user()->empresa_id)
						->Where('name', 'LIKE', $keyWord)
						->paginate(30),
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
    }

    public function store()
    {
       
        $this->validate([
		'name' => 'required'
        ]);

        Carstype::create([ 
			'name' => $this-> name,
			'status' => 1,
            'empresa_id' => $this->empresa_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Save Cars, Successfully created.');
    }

    public function edit($id)
    {
        $record = Carstype::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->status = $record-> status;
        $this->icon = $record-> icon;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'status' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Carstype::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'status' => $this-> status,
            'icon' => $this->selected_id_img
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Cars Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Carstype::where('id', $id);
            $record->delete();
        }
    }
    public function select_img($id , $id_car) {
        if($id) {
            $this->color_select = "danger";
            $this->selected_id_img = $id;

            $this->icon = $id;
            $record = Carstype::find($id_car);
            $record->update([ 
            'icon' => $this->selected_id_img
            ]);

            $this->emit('closeModal');
           
        }
        //session()->flash('message', 'Icon updated.');
    }
    public function ckeking($id, $check){
        $record = Carstype::find($id);
        $record->update([ 
        'status' => $check
        ]);
       
       session()->flash('message', 'Successfully updated.');
    }
}
