<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Operario ::</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="name">Name</label>
                <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="dni">Dni</label>
                <input wire:model="dni" type="text" class="form-control" id="dni" placeholder="Dni">@error('dni') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="wsp">Whatsap</label>
                <input wire:model="wsp" type="text" class="form-control" id="wsp" placeholder="Wsp">@error('wsp') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
           
   <div class="form-group">
    <label for="status"> Status</label>
   <select wire:model="status" id="status" required="" name="status" class="form-control">
      <option  value="1"  select > Active </option> 
      <option  value="0" > Desactive </option> 
    </select>  
          @error('status') <span class="error text-danger">{{ $message }}</span> @enderror
</div>
            <div class="form-group d-none">
                <label for="empresa_id"></label>
                <input wire:model="empresa_id" type="text" class="form-control" id="empresa_id" placeholder="Empresa Id">@error('empresa_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
               
                <label for="gasto_id">Asigne Gasto Operario</label>
                @error('gasto_id') <span class="error text-danger">{{ $message }}</span> @enderror
                <select    class="form-control"  id="gasto_id" wire:model="gasto_id">
                    <option value=""> Seleccione  : </option>
                    @foreach ($gastos as $gasto)
                    <option  value="{{ $gasto->id }}" > {{ Str::upper($gasto->name) }} </option>
                    @endforeach    
                </select>
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
       </div>
    </div>
</div>

<script>
         document.addEventListener('livewire:load', function(){
                    @this.set('empresa_id', {{Auth::user()->empresa_id}});
            })
</script>