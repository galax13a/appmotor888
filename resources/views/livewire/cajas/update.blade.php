<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Caja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="name"></label>
                <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fecha"></label>
                <input wire:model.defer="fecha" type="text" class="form-control" id="fecha" placeholder="Fecha">@error('fecha') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group d-none">
                <label for="valor"></label>
                <input wire:model.defer="valor" type="text" class="form-control" id="valor" placeholder="Valor">@error('valor') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="status"> Status</label>
                <select wire:model.defer="status" id="status" required="" name="status" class="form-control">
                   <option  value="1"  select > Verificado </option> 
                   <option  value="0" > Sin verificar </option> 
                 </select>  
                       @error('status') <span class="error text-danger">{{ $message }}</span> @enderror
             </div>

             <div class="form-group" >
                <label for="tipo"> Tipo Contable</label>
            <select class="form-control" name ="gastos_id" id="gastos_id" wire:model.defer="gastos_id">
                @foreach ($data_contable as $contable)
                <option  value="{{ $contable->id }}" > {{ Str::upper($contable->name) }} </option>   
                @endforeach    
            </select>
  
            </div>

            
            <div class="form-group d-none">
                <label for="empresa_id"></label>
                <input wire:model.defer="empresa_id" type="text" class="form-control" id="empresa_id" placeholder="Empresa Id">@error('empresa_id') <span class="error text-danger">{{ $message }}</span> @enderror
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