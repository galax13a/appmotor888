<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Myuser;
use App\Models\Empresa;


class Myusers extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $email, $avatar, $two_factor_secret, $two_factor_recovery_codes, $current_team_id, $profile_photo_path, $empresa_id;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.myusers.view', [
            'myusers' => Myuser::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->orWhere('avatar', 'LIKE', $keyWord)
						->orWhere('two_factor_secret', 'LIKE', $keyWord)
						->orWhere('two_factor_recovery_codes', 'LIKE', $keyWord)
						->orWhere('current_team_id', 'LIKE', $keyWord)
						->orWhere('profile_photo_path', 'LIKE', $keyWord)
						->orWhere('empresa_id', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	public function updatingKeyWord(){
        $this->resetPage();
    }
    private function resetInput()
    {		
		$this->name = null;
		$this->email = null;
		$this->avatar = null;
		$this->two_factor_secret = null;
		$this->two_factor_recovery_codes = null;
		$this->current_team_id = null;
		$this->profile_photo_path = null;
		$this->empresa_id = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'email' => 'required',
        ]);

        Myuser::create([ 
			'name' => $this-> name,
			'email' => $this-> email,
			'avatar' => $this-> avatar,
			'two_factor_secret' => $this-> two_factor_secret,
			'two_factor_recovery_codes' => $this-> two_factor_recovery_codes,
			'current_team_id' => $this-> current_team_id,
			'profile_photo_path' => $this-> profile_photo_path,
			'empresa_id' => $this-> empresa_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Myuser Successfully created.');
    }

    public function edit($id)
    {
        $record = Myuser::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->email = $record-> email;
		$this->avatar = $record-> avatar;
		$this->two_factor_secret = $record-> two_factor_secret;
		$this->two_factor_recovery_codes = $record-> two_factor_recovery_codes;
		$this->current_team_id = $record-> current_team_id;
		$this->profile_photo_path = $record-> profile_photo_path;
		$this->empresa_id = $record-> empresa_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'email' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Myuser::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'email' => $this-> email,
			'avatar' => $this-> avatar,
			'two_factor_secret' => $this-> two_factor_secret,
			'two_factor_recovery_codes' => $this-> two_factor_recovery_codes,
			'current_team_id' => $this-> current_team_id,
			'profile_photo_path' => $this-> profile_photo_path,
			'empresa_id' => $this-> empresa_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Myuser Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Myuser::where('id', $id);
            $record->delete();
        }
    }
}
