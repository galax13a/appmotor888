<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-car data-bs-toggle="tooltip" data-bs-placement="top" ></i> {{ $name_cliente }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           
           <div class="modal-body">
				<form>
                <div class="form-group">
                    <label for="placa"></label>
                    <input type="text" wire:model.defer="placa_id" class="form-control capitalise" id="placa_id" placeholder="placa">@error('placa_id') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
		  <div class="form-group">
                <select wire:model.defer="cars_id"   class="form-control"  id="cars_id" >
                    <option value=""> type cars  : </option>
                    @foreach ($cars as $car)
                    <option  value="{{ $car->id }}" >{{  Str::upper($car->name) }} </option>
                    @endforeach    
                </select>
            @error('cars_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            </form>
            @if($name_cliente)
                @foreach($mycars as $mycar)
                    <span class="badge bg-success m-2 p-2 ">
                    <strong class="btn btn bg-success shadow-lg text-yellow">{{ Str::upper($mycar->name) }}</strong>
                    </span>
                @endforeach
            @endif
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="save_add({{$selected_id}})" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
         document.addEventListener('livewire:load', function(){
                    @this.set('empresa_id', {{Auth::user()->empresa_id}});
                    $('#placa_id').val($(this).val().toUpperCase());
                    $('#placa_id').addClass('capitalise');
                 
            })
</script>