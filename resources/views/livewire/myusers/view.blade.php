@section('title', __('Myusers'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
			<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4 class="mr-2">
							Users </h4>
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
						@include('livewire.myusers.create')
						@include('livewire.myusers.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Name</th>
								<th>Email</th>
								<th>Avatar</th>
								<th>Two Factor Secret</th>
								<th>Two Factor Recovery Codes</th>
								<th>Current Team Id</th>
								<th>Profile Photo Path</th>
								<th>Empresa Id</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($myusers as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->name }}</td>
								<td>{{ $row->email }}</td>
								<td>{{ $row->avatar }}</td>
								<td>{{ $row->two_factor_secret }}</td>
								<td>{{ $row->two_factor_recovery_codes }}</td>
								<td>{{ $row->current_team_id }}</td>
								<td>{{ $row->profile_photo_path }}</td>
								<td>
								@if(is_null($row->empresa_id))
									<strong> NONE </strong>
									@elseif(!is_null($row->empresa_id))
									{{$row->empresa->name}}
								@endif
								</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Myuser id {{$row->id}}? \nDeleted Myusers cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $myusers->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>