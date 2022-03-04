<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Factura;
use App\Models\Operario;
use App\Models\Mycar;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Caja;
use App\Models\Gasto;


class Facturas extends Component
{
	use WithPagination;

	protected $paginationTheme = 'bootstrap';
	public $selected_id, $keyWord, $placa, $value, $empresa, $operario, $status, $cliente_id, $servicio_id, $operario_id, $empresa_id;
	public $updateMode = false;
	public $userEmpresa, $servicios, $mycarrs, $operarios, $fecha, $operario_name, $myservicios;

	public $row_count_operario, $fecha_server,$idoperario, $total, $empresa_totales, $fechax,$total_empresa, $total_all;
    public  $array_nopayment, $nopayment, $contador ,$daty, $filtro, $contables, $btn_pay, $gasto_id;
	public $data, $total_liquidar, $contable_service_name, $contable_service_id;
	public $calificar_id, $calificar_puntaje, $calificar_name, $calificar_name_servicio;
	public $thema_factu = "light";
	public function updatingKeyWord()
	{
		$this->resetPage();
	}

	public function mount()
	{
		date_default_timezone_set("America/Bogota");
		$this->userEmpresa = Auth::user()->empresa_id;
		$this->fecha = date('Y-m-d'); //strftime("Hoy es %A y son las %H:%M");
		$this->daty = date('Y-m-d');
		$this->fecha_server =  date('Y-m-d h:i:s');
		$this->operario_name = null;
		$this->total = null;
		$this->calificar_id = 0;
		$this->calificar_puntaje = 0;
		$calificar_name = null;
		//$this->thema_factu = "light";
		$this->filtro = true;

	}

	public function cambiar_tema(){
		
		if($this->thema_factu == "dark") $this->thema_factu = "light";
		else $this->thema_factu = "dark";
	}

	public function getplaca($id)
	{
		return  Mycar::Where("id", $id)->get();
	}
	public function votar($id,$valor)
		{
			$this->calificar_id = $id;
			$this->calificar_puntaje = $valor;

			$record = Factura::find($id);

				$record->update([
					'voto' => $valor
				]);
		

			session()->flash('message', 'Gracias por su voto ' . $valor);

		}	
		public function carga_voto($id,$operario,$puntaje,$servicio_name='none'){

			$this->calificar_name = $operario;
			$this->calificar_id = $id;
			$this->calificar_puntaje = $puntaje;
			$this->calificar_name_servicio = $servicio_name;

			session()->flash('message', 'cargando voto de . ' . $this->calificar_puntaje);
		}
   public function calificar($id, $valor){
		$this->calificar_puntaje = $valor;
		$this->calificar_id = $id;
		session()->flash('message', 'Change voto ' . $this->calificar_puntaje);
	}
	
	public function get_payment(){
		session()->flash('message', 'Change Date Payment ' . $this->fecha);
		$this->filtro = false;
	}
	
	public function get_caja($id,$name)
	{
		/*
		return  Caja::Where("name","'$name'" )	
					->Where("fecha", "'$this->fecha'"  )
		            ->get(); */
					return  Caja::Where("name",$name)	
					->Where("fecha",$this->fecha)
		            ->get();
	}
	public function get_caja_factory($id) {
			// busca en caja si existe un pago de cierre de caja de factory 
					return  Caja::Where("gastos_id",$id)	
					->Where("fecha",$this->fecha)
					->get();

	}
	public function get_name_liquis() {

		return  Gasto::Where("contable",1)	
									->Where("empresa_id", $this->userEmpresa)
									->get();

	}
	
	public function pay_empresa($gasto_id,$name,$valor){
		
	
		Caja::create([ 
			'name' => $name,
			'fecha' => $this->fecha,
			'valor' => $valor,
			'status' => 0,
			'gastos_id' => $gasto_id,
			'empresa_id' => $this->userEmpresa
		]);
		session()->flash('message', 'Exito! Pago Empresa ' . $this->fecha);
	}
	public function pay($gasto_id,$name,$valor){
		
		$data = $this->get_caja($gasto_id, $name);

		if (!empty($data->count()>0)){
		//	session()->flash('message_pay_error', 'Error !!! Ya existe un pago Realizado! ' .$name );
			$this->btn_pay = false;
		}else {

				if(!empty($gasto_id)) { 
					Caja::create([ 
						'name' => $name,
						'fecha' => $this->fecha,
						'valor' => $valor,
						'status' => 0,
						'gastos_id' => $gasto_id,
						'empresa_id' => $this->userEmpresa
					]);
				}

				//session()->flash('message_pay', 'Exito!!  Se genero Pago y Registro en Caja ' . $name);
	        }
		
	//	$this->emit('closeModal');
	}

	public function get_contable($id){

		 $this->contables  = DB::table('operarios')
			->join('gastos', 'operarios.gasto_id', '=', 'gastos.id')
			->select('operarios.gasto_id as id_gasto','operarios.id','operarios.name', 'gastos.name as contable')
			->where('operarios.id', $id)
			->get();
	}

	public function get_nopayment(){
	
		$this->array_nopayment  = DB::table('facturas')
			->join('services', 'facturas.servicio_id', '=', 'services.id')
			->join('carstypes','services.cars_id', '=', 'carstypes.id')
			->select('facturas.created_at','facturas.placa', 'services.porcentaje' ,'carstypes.name as cars', 'carstypes.icon as icon', 'services.name as servicio', 'facturas.value', 'facturas.empresa','facturas.operario','facturas.fecha','facturas.operario_id')
			->Where("facturas.empresa_id", Auth::user()->empresa_id)
			->where('facturas.status', 0)
			->where('facturas.fecha', $this->fecha)
			->orderBy('facturas.created_at', 'desc')
			->get();
	}
	public function servicios_operador($id,$name){
		$this->operario_name = $name;
		$this->idoperario = $id;
		//session()->flash('message', 'cargado' . $this->operario_name);
		$this->myservicios  = DB::table('facturas')
			->join('services', 'facturas.servicio_id', '=', 'services.id')
			->join('carstypes','services.cars_id', '=', 'carstypes.id')
			->select('facturas.created_at','facturas.placa', 'services.porcentaje' ,'carstypes.name as cars', 'carstypes.icon as icon', 'services.name as servicio', 'facturas.value', 'facturas.empresa','facturas.operario','facturas.fecha','facturas.operario_id')
			->Where("facturas.empresa_id", Auth::user()->empresa_id)
			->where('facturas.operario_id',$this->idoperario)
			->where('facturas.fecha', $this->fecha)
			->orderBy('facturas.created_at', 'desc')
			->get();

	}

	public function get_servicios($id){
		//DB::enableQueryLog(); 
				return  DB::table('facturas')
                       ->select(DB::raw('count(*) as allservice'))     
					  ->where('operario_id', $id)
					  ->where('facturas.fecha',$this->fecha)
				 	   ->get();      

	}



	public function save()
	{
		$this->validate([
			'placa' => 'required',
			'servicio_id' => 'required',
			'operario_id' => 'required'
		]);


		$this->empresa = 66666;
		$this->value = 999;
		$this->operario = 333;
		$this->status = 0;
		$this->cliente_id = 2;
		$this->empresa_id = $this->userEmpresa; // id de la empresa_id
		$tags_servicio = explode("-", $this->servicio_id); // id servicio_id y valor del servicios
		$this->value = $tags_servicio[1]; // Valor del Servicio
		$idservicio = $tags_servicio[0]; // id del servicios
		$tags_placas = explode("-", $this->placa); // la placa y id cliente
		$idplaca = $tags_placas[0]; // el id de placa
		$this->cliente_id = $tags_placas[2]; // id cliente
		$porcentaje = $tags_servicio[2];

		$this->operario = $this->value * $porcentaje/100;
		$empresa_porcentaje = 100 - $porcentaje;
		$this->empresa =  $this->value * $empresa_porcentaje/100;



		Factura::create([
			'placa' => $idplaca,
			'value' => $this->value,
			'empresa' => $this->empresa,
			'operario' => $this->operario,
			'status' => $this->status,
			'cliente_id' => $this->cliente_id,
			'servicio_id' => $idservicio,
			'operario_id' => $this->operario_id,
			'empresa_id' => $this->userEmpresa,
			'fecha' => $this->fecha
		]);

		session()->flash('message', 'Save Register ') . $idplaca;
		//$this->resetInput();
		$this->placa = null;
		$this->emit('combos');
	}

	public function render()
	{
		$keyWord = '%' . $this->keyWord . '%';
		//$this->fecha = date('Y-m-d'); 
		//date_default_timezone_set("America/Bogota");
		$this->fecha_server =  date('Y-m-d h:i:s');

		if($this->array_nopayment) 
		{
			$this->get_nopayment();
		}

		$this->mycarrs  = DB::table('clientes')
			->join('mycars', 'clientes.id', '=', 'mycars.cliente_id')
			->select('clientes.name as cliente', 'mycars.name', 'mycars.id', 'clientes.id as cliente_ids')
			->Where("empresa_id", Auth::user()->empresa_id)
			->orderBy('mycars.name')
			->get();

		$this->servicios = Service::where('empresa_id', $this->userEmpresa)->where('status',1)->get();

		$this->operarios  = Operario::where('empresa_id', $this->userEmpresa)
							  ->where('status',1)
		                      ->get();


		$this->empresa_totales =DB::table('facturas')
							->select(DB::raw("SUM(facturas.empresa) as empresa, SUM(facturas.value) as total, SUM(facturas.operario) as operario"))
							->where('facturas.fecha', $this->fecha)
							->get();

	      $this->total_liquidar = $this->empresa_totales[0]->total;					
							
		if($this->myservicios){
			$this->myservicios  = DB::table('facturas')
			->join('services', 'facturas.servicio_id', '=', 'services.id')
			->join('carstypes','services.cars_id', '=', 'carstypes.id')
			->select('facturas.created_at','facturas.placa', 'services.porcentaje', 'carstypes.name as cars', 'carstypes.icon as icon','services.name as servicio', 'facturas.value', 'facturas.empresa','facturas.operario','facturas.fecha','facturas.operario_id')
			->Where("facturas.empresa_id", Auth::user()->empresa_id)
			->where('facturas.operario_id',$this->idoperario)
			->where('facturas.fecha', $this->fecha)
			->orderBy('facturas.created_at', 'desc')
			->get();

		}
 if(!$this->filtro) {
					return view('livewire.facturas.view', [
						'facturas' => Factura::orderBy('created_at', 'desc')
							->Where('empresa_id', $this->userEmpresa)
							->Where('placa', 'LIKE', $keyWord)
							->Where("facturas.empresa_id", Auth::user()->empresa_id)
							->paginate(50)
					]);

					   $this->emit('combos');
			     	}else {
						return view('livewire.facturas.view', [
							'facturas' => Factura::latest()
								->Where('empresa_id', $this->userEmpresa)
								->Where('placa', 'LIKE', $keyWord)
								->Where("facturas.empresa_id", Auth::user()->empresa_id)
								->Where('facturas.fecha', $this->fecha)
								->paginate(100)
						]);
						//$this->emit('combos');
					 }

					// $this->emit('combos');
	}

	public function cancel()
	{
		$this->resetInput();
		$this->updateMode = false;
	}

	private function resetInput()
	{
		$this->placa = null;
		$this->value = null;
		$this->empresa = null;
		$this->operario = null;
		$this->status = null;
		$this->cliente_id = null;
		$this->servicio_id = null;
		$this->operario_id = null;
		$this->empresa_id = null;
	}

	public function store()
	{
		$this->validate([
			'placa' => 'required',
			'value' => 'required',
			'empresa' => 'required',
			'operario' => 'required',
			'status' => 'required',
			'cliente_id' => 'required',
			'servicio_id' => 'required',
			'operario_id' => 'required',
			'empresa_id' => 'required',
		]);
		//date_default_timezone_set("America/Bogota");
		Factura::create([
			'placa' => $this->placa,
			'value' => $this->value,
			'empresa' => $this->empresa,
			'operario' => $this->operario,
			'status' => $this->status,
			'cliente_id' => $this->cliente_id,
			'servicio_id' => $this->servicio_id,
			'operario_id' => $this->operario_id,
			'empresa_id' => $this->empresa_id
		]);

		$this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Factura Successfully created.');
	}
  public function newdate($id){

	if($id ==1){ // es por que va aumentar la fecha
		$this->fecha = date("Y-m-d",strtotime("+ 1 days")); 
	}else $this->fecha = date("Y-m-d",strtotime("- 1 days")); 
  }
	public function edit($id)
	{
		$record = Factura::findOrFail($id);

		$this->selected_id = $id;
		$this->placa = $record->placa;
		$this->value = $record->value;
		$this->empresa = $record->empresa;
		$this->operario = $record->operario;
		$this->status = $record->status;
		$this->cliente_id = $record->cliente_id;
		$this->servicio_id = $record->servicio_id;
		$this->operario_id = $record->operario_id;
		$this->empresa_id = $record->empresa_id;
		$this->fechax = $record->fecha;

		$this->updateMode = true;
	}

	public function update()
	{
		$this->validate([
			'placa' => 'required',
			'value' => 'required',
			'empresa' => 'required',
			'operario' => 'required',
			'status' => 'required',
			'cliente_id' => 'required',
			'servicio_id' => 'required',
			'operario_id' => 'required',
			'empresa_id' => 'required',
		]);

		if ($this->selected_id) {
			$record = Factura::find($this->selected_id);
			$record->update([
				'placa' => $this->placa,
				'value' => $this->value,
				'empresa' => $this->empresa,
				'operario' => $this->operario,
				'status' => $this->status,
				'cliente_id' => $this->cliente_id,
				'servicio_id' => $this->servicio_id,
				'operario_id' => $this->operario_id,
				'empresa_id' => $this->empresa_id,
				'fecha' => $this->fechax
			]);

			$this->resetInput();
			$this->updateMode = false;
			session()->flash('message', 'Factura Successfully updated.');
		}
	}

	public function destroy($id)
	{
		if ($id) {
			$record = Factura::where('id', $id);
			$record->delete();
		}
	}
	public function ckeking($id, $check)
	{
		$record = Factura::find($id);
		$record->update([
			'status' => $check
		]);
	}
}
