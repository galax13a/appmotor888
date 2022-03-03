@section('title', __('Clientes'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4 class="mr-2">
							Clientes </h4>
						</div>
						<div class="input-group input-group-lg">
							<input wire:model='keyWord' type="text" class="form-control input-lg" name="search" id="search" placeholder="Search">
						</div>
						<div class="input-group input-group-lg p-2">
							<button wire:click="menu(0, 'Todos los Cars')" type="button" class="btn btn-warning"><i class="fa fa-users" aria-hidden="true"></i>
								<span class="badge bg-light bold">{{ $this->mis_clientes()[0]->cuantos }}</span> Clientes 
								@All
								
							</button>
						</div>
						<div class="btn btn-sm btn-success m-2" data-toggle="modal" data-target="#exampleModal">
							<i class="fa fa-plus p-2 btn-success data-bs-toggle="tooltip" data-bs-placement="top" title="Create New"></i>  
							</div>
					</div>
				</div>
				@if (session()->has('message'))
				<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
				@endif
				
				<div class="card-body">
					@include('livewire.clientes.update')
						@include('livewire.clientes.create')
					
						@include('livewire.clientes.addmycars')
				<div class="table-responsive">
			
			<div class="container m-2 p-2">
			
				@foreach ($mys_carros as $carros)
					
				<button type="button" class="btn btn-light  m-1" wire:click="menu({{$carros->id}},'{{$carros->name}}')">
					<img src="/css/cars/bike{{$carros->icon}}.svg " class="shadown"  width="36" height="36" alt="">
					{{$carros->name}} <span class="badge bg-primary">{{$carros->cuantos}}</span>
					
				  </button>

				@endforeach



			</div>


					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>+</td></td> 
								<th>Name</th>
								<th>placas</th>
								<th>Phone</th>
								<th>Cumpleaños</th>
								<th>Eliminar</th>
							@php /*
									<th>Empresa Id</th>
									*/
							@endphp
							
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
					     {{$this->nuevo_clientes}}
							@foreach($clientes as $row)
							<tr>
								<td>
								<i class="fa fa-car p-2  "></i>
								</i>
							<button type="button" class="btn btn-dark"><i class="fa fa-plus-circle p-1 bg-dark" data-toggle="modal" data-target="#addModal"  wire:click="addcars({{$row->id}}, '{{$row->name}}')"></i></button>
							</td> 
								<td><strong>{{ $loop->iteration }} - {{ Str::ucfirst($row->name) }}</strong> </td>
								<td>
							
								@foreach($this->getplaca($row->id) as $placa)
										<span class="badge  btn btn-success "><img src="/css/cars/bike{{$placa->icon}}.svg " class="shadown"  width="36" height="36" alt="">	{{ Str::upper($placa->name) }}
										<a class="btn btn-dark " onclick="confirm('Confirm Delete placa id {{$placa->name}}? \nDeleted placa cannot be recovered!')||event.stopImmediatePropagation()" wire:click="deleteplaca({{$placa->id}})"><i class="fa fa-times" title="Eliminar ({{$placa->name}})"></i>  </a>   
										</span>
								@endforeach
							</td>
								<td><strong>{{ $row->wsp1 }}</strong></td>
								<td><strong>{{ $row->cumple }}</strong></td>
							
							<td>
							<div class="form-check form-switch ml-4">
								@if($row->status == 0)
								<input  class="form-check-input btn-danger" type="checkbox" role="switch" id="status" wire:click="ckeking({{$row->id}}, 1)" >
								@elseif ($row->status == 1)
								<input onclick="confirm('Confirm Delete Factura id {{ $row->id }}? \nDeleted cliente cannot be recovered!')||event.stopImmediatePropagation()" class="form-check-input" type="checkbox" role="switch" id="status" checked wire:click="ckeking({{$row->id}}, 0)">
								@endif
							</div>
							</div>
								</td>
								@php
									
							 	/*
								<td>{{$row->empresa_id}} - <strong>{{ $row->empresa->name }}</strong></td>
								*/
								@endphp
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Cliente id {{$row->id}}? \nDeleted Clientes cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $clientes->links() }}
					</div>
		
					<button type="button" class="btn btn-info btn-lg d-none" data-toggle="modal" data-target="#miModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="miModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
       
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
				</div>
			</div>
		</div>
	</div>
</div>
