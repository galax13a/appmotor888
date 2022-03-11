<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cliente;
use App\Models\Carstype;
use App\Models\Mycar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Mensaje;

class Clientes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $wsp1, $wsp2, $status, $empresa_id;
    public $updateMode = false;
    public $empresas, $carsmotor,$mycars;
    public $userEmpresa, $name_cliente;
    public $placa_id, $cars_id, $placa_busca;
    public $mys_carros, $cumple,$cumple2;
    public $key_car, $nuevo_clientes;
    public $filtro_ads;
    public $mensajes,$msg_id, $msg_contenido, $msg_msg, $msg_placa, $msg_cliente, $msg_cumple, $msg_servicio, $msg_phone, $msg_operario;


    public function updatingKeyWord(){
        $this->resetPage();
    }

   
    public function mount(){

        $this->userEmpresa = Auth::user()->empresa_id;
        $key_car = 0;
        $this->nuevo_clientes = null;
        $this->filtro_ads = 0;
        $this->wsp2 = 0;
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

    public function mis_clientes(){

        return DB::table('clientes')
                ->select(DB::raw("COUNT(clientes.id) as cuantos"))
                ->where('clientes.empresa_id', Auth::user()->empresa_id)
                ->where('clientes.status',1)
                ->get();

    }
    public function filtro_adss(){
        $this->filtro_ads = 1;
    }
    public function menu($id,$name) {

        $this->key_car = $id;
        $this->resetPage();
        session()->flash('message', 'Cambiado a '  . $name);
    }

    public function get_mycars() {
          return  DB::table('carstypes')
			->join('mycars', 'mycars.carstypes_id', '=', 'carstypes.id')
			->select(DB::raw("COUNT(carstypes.name) as cuantos, carstypes.name, carstypes.icon as icon, carstypes.id"))
            ->groupBy('carstypes.name')
            ->groupBy('carstypes.icon')    
            ->groupBy('carstypes.id')        
			->Where("carstypes.empresa_id", Auth::user()->empresa_id)
			->get();
    }

    public function msg_carga($cliente, $cumple, $phone){ // para enviar mensages x la placa y cliente

		
		$this->msg_cliente = $cliente;
		$this->msg_phone = $phone;
        $this->cumple  = $cumple;
	}

    public function render()
    { 
		$keyWord = '%'.$this->keyWord .'%';
        $placa_busca = '%'.$this->placa_busca .'%';
      
        $this->cars = Carstype::Where('empresa_id', $this->userEmpresa)->get();
        $this->userEmpresa = Auth::user()->empresa_id;
        $this->mys_carros = $this->get_mycars();

        $this->mensajes = Mensaje::where('empresa_id', $this->userEmpresa)->where('status',1)->get();
        if($this->msg_id > 0) $this->msg_contenido = $this->mensajes = Mensaje::where('id',$this->msg_id)->get();
    
    
        if($this->key_car == 0){
         
            return view('livewire.clientes.view', [
                'clientes' => DB::table('clientes')
                ->leftJoin('mycars', 'mycars.cliente_id', '=', 'clientes.id')
                ->select('clientes.name','clientes.id', 'clientes.wsp1', 'clientes.status','clientes.cumple')
                ->Where('empresa_id', $this->userEmpresa)
                ->Where('clientes.name', 'LIKE', $keyWord)
                ->where('clientes.status', 1)
                ->groupBy('clientes.name') 
                ->groupBy('clientes.id') 
                ->groupBy('clientes.wsp1') 
                ->groupBy('clientes.status') 
                ->groupBy('clientes.cumple') 
                ->orderBy('cliente_id', 'asc')
                ->paginate(50)
            ]);
        } else{
         
            return view('livewire.clientes.view', [
                'clientes' => DB::table('clientes')
                ->join('mycars', 'mycars.cliente_id', '=', 'clientes.id')
                ->select('clientes.name','clientes.id', 'clientes.wsp1', 'clientes.status','clientes.cumple')
                ->Where('empresa_id', $this->userEmpresa)
                ->where('mycars.carstypes_id',$this->key_car)
                ->groupBy('clientes.name') 
                ->groupBy('clientes.id') 
                ->groupBy('clientes.wsp1') 
                ->groupBy('clientes.status') 
                ->groupBy('clientes.cumple') 
                ->orderBy('cliente_id', 'desc')
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
    public function messages()
    {
        return [
            'wsp1.numeric' => 'el wsp de ser numero',
            'wsp2.numeric' => 'el wsp de ser numero',
        ];
    }
    public function store()
    {
        $this->validate([
		'name' => 'required',
        'wsp1' => 'numeric',
        'wsp2' => 'numeric'
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
        $this->cumple2 = $record-> cumple;

        if($this->wsp2 <=0) $this->wsp2 = 0;
		//$this->empresa_id = $record-> empresa_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'status' => 'required',
        'wsp1' => 'numeric',
        'wsp2' => 'numeric'
        ]);

        if ($this->selected_id) {
			$record = Cliente::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'wsp1' => $this-> wsp1,
			'wsp2' => $this-> wsp2,
			'status' => $this-> status,
            'cumple' => $this-> cumple2,
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
            'placa_id' => 'required|unique:mycars,name,'. strtoupper($id),
            'cars_id' => 'required'
            ]);

            Mycar::create([ 
                'name' =>  strtoupper($this->placa_id),
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
