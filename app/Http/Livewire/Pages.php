<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Page;

class Pages extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $status;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.pages.view', [
            'pages' => Page::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('status', 'LIKE', $keyWord)
						->paginate(2),
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
		'name' => 'required',
		'status' => 'required',
        ]);

        Page::create([ 
			'name' => $this-> name,
			'status' => $this-> status
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Page Successfully created.');
    }

    public function edit($id)
    {
        $record = Page::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->status = $record-> status;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'status' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Page::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'status' => $this-> status
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Page Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Page::where('id', $id);
            $record->delete();
        }
    }
}
