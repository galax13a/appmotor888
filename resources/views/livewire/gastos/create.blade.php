<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Contable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="name">Describa Nombre Contable</label>
                <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="value">Valor Contable</label>
                <input wire:model.defer="value"  type="text" class="form-control" id="value" placeholder="value">@error('value') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="natu">Describa la Naturaleza Contable</label>
               <select wire:model.defer="natu" id="natu" required="" name="natu" class="form-control">
                <option  value=""  select > Select Contable </option> 
                  <option  value="1"  select > Ingreso </option> 
                  <option  value="0" > Gasto </option> 
                </select>  
                      @error('natu') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group d-none">
                <label for="status"></label>
                <input wire:model="status" type="text" class="form-control" id="status" placeholder="Status">@error('status') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group d-none">
                <label for="empresa_id"></label>
                <input wire:model="empresa_id" type="text" class="form-control" id="empresa_id" placeholder="Empresa Id">@error('empresa_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
         document.addEventListener('livewire:load', function(){
                    @this.set('empresa_id', {{Auth::user()->empresa_id}});
            })
</script>