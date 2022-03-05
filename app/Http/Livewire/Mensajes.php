<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Mensaje;
use Illuminate\Support\Facades\Auth;

class Mensajes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $mensaje, $img, $link, $status, $empresa_id;
    public $updateMode = false;
 
    public function mount(){
        $this->empresa_id = Auth::user()->empresa_id;
        $this->status = 0;
      
    }

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.mensajes.view', [
            'mensajes' => Mensaje::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('mensaje', 'LIKE', $keyWord)
						->orWhere('img', 'LIKE', $keyWord)
						->orWhere('link', 'LIKE', $keyWord)
						->orWhere('status', 'LIKE', $keyWord)
						->orWhere('empresa_id', 'LIKE', $keyWord)
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
		$this->mensaje = null;
		$this->img = null;
		$this->link = null;
		$this->status = null;
		//$this->empresa_id = null;
    }
    public function ckeking($id, $check){
        $record = Mensaje::find($id);
        $record->update([ 
        'status' => $check
        ]);
       
       session()->flash('message', 'Successfully updated.');
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
        ]);

        Mensaje::create([ 
			'name' => $this-> name,
			'mensaje' => $this-> mensaje,
			'img' => $this-> img,
			'link' => $this-> link,
			'status' => 0,
			'empresa_id' => $this-> empresa_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Mensaje Successfully created.');
    }

    public function edit($id)
    {
        $record = Mensaje::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->mensaje = $record-> mensaje;
		$this->img = $record-> img;
		$this->link = $record-> link;
		$this->status = $record-> status;
		$this->empresa_id = $record-> empresa_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Mensaje::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'mensaje' => $this-> mensaje,
			'img' => $this-> img,
			'link' => $this-> link,
			'status' => $this-> status,
			'empresa_id' => $this-> empresa_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Mensaje Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Mensaje::where('id', $id);
            $record->delete();
        }
    }
}
