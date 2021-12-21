@section('title', __('Operarios'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
			<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4 class="mr-2">
							Operarios </h4>
						</div>
						<div class="input-group input-group-lg">
							<input wire:model='keyWord' type="text" class="form-control input-lg" name="search" id="search" placeholder="Search">
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
						@include('livewire.operarios.create')
						@include('livewire.operarios.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Name</th>
								<th>Dni</th>
								<th>Wsp</th>
								<th>Status</th>
								<th>Empresa Id</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($operarios as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->name }}</td>
								<td>{{ $row->dni }}</td>
								<td>{{ $row->wsp }}</td>
								<td>
									
<div class="form-check form-switch ml-4">
								@if($row->status == 0)
								<input class="form-check-input btn-danger" type="checkbox" role="switch" id="status" wire:click="ckeking({{$row->id}}, 1)" >
								@elseif ($row->status == 1)
								<input class="form-check-input" type="checkbox" role="switch" id="status" checked wire:click="ckeking({{$row->id}}, 0)">
								@endif
							</div>

								</td>
								<td>{{ $row->empresa->name }}</td>
								<td width="90">
							
									
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Operario id {{$row->id}}? \nDeleted Operarios cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i>  </a>   
								
								
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $operarios->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>