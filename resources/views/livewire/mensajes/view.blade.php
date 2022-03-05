@section('title', __('Mensajes'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4 class="mr-2">
							Mensajes </h4>
						</div>
						<div class="input-group input-group-lg">
							<input wire:model='keyWord' type="text" class="form-control input-lg" name="search" id="search" placeholder="Search">
						</div>
						
						<div class="btn btn-sm btn-success m-2" data-toggle="modal" data-target="#exampleModal">
							<i class="fa fa-plus p-2 btn-success data-bs-toggle="tooltip" data-bs-placement="top" title="Create New"></i>  
							</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.mensajes.create')
						@include('livewire.mensajes.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Titulo</th>
								<th>Mensaje</th>
								<th>Img</th>
								<th>Link</th>
								<th>Status</th>
								<th>Empresa</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($mensajes as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td class="font-weight-bold">
									<button class="btn btn-success"><i class="fa fa-comments" aria-hidden="true"></i> </button>
									

									{{ $row->name }}
								</td>
								<td class="font-italic">{{ $row->mensaje }}</td>
								<td>{{ $row->img }}</td>
								<td>{{ $row->link }}</td>
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
									<button data-toggle="modal" data-target="#updateModal"  wire:click="edit({{$row->id}})" class="btn btn-success p-1 ">✔️</button>
							        <button onclick="confirm('Confirm Delete Mensaje id {{$row->id}}? \nDeleted Mensajes cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})" class="btn btn-danger p-1">➖</button>
							</td>
							@endforeach
						</tbody>
					</table>						
					{{ $mensajes->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>