@section('title', __('Empresas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
			<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4 class="mr-2">
							Empresa </h4>
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
						@include('livewire.empresas.create')
						@include('livewire.empresas.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Name</th>
								<th>Nit</th>
								<th>Dir</th>
								<th>Tel</th>
								<th>Logo</th>
								<th>Img</th>
								<th>Wsp1</th>
								<th>Wsp2</th>
								<th>Status</th>
								<th>Users Id</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($empresas as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td><strong>{{ ucfirst($row->name) }}</strong></td>
								<td>{{ $row->nit }}</td>
								<td>{{ $row->dir }}</td>
								<td>{{ $row->tel }}</td>
								<td>{{ $row->logo }}</td>
								<td>{{ $row->img }}</td>
								<td>{{ $row->wsp1 }}</td>
								<td>{{ $row->wsp2 }}</td>
								<td>
									
								<div class="form-check form-switch ml-4">
								@if($row->status == 0)
								<input class="form-check-input btn-danger" type="checkbox" role="switch" id="status" wire:click="ckeking({{$row->id}}, 1)" >
								@elseif ($row->status == 1)
								<input class="form-check-input" type="checkbox" role="switch" id="status" checked wire:click="ckeking({{$row->id}}, 0)">
								@endif
							</div>

								</td>
								<td>{{ $row->user->name }}</td>
								<td width="90">
									<button data-toggle="modal" data-target="#updateModal"  wire:click="edit({{$row->id}})" class="btn btn-success p-1 ">✔️</button>
							        <button onclick="confirm('Confirm Delete Mensaje id {{$row->id}}? \nDeleted Mensajes cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})" class="btn btn-danger p-1">➖</button>
						
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $empresas->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>