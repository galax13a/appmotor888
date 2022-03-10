<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Contable</h5>
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
              
               <select wire:model.defer="natu" id="natu" required="" name="natu" class="form-control">
                <option  value=""  select > Select Gasto </option> 
                  <option  value="1"  select > Ingreso </option> 
                  <option  value="0" > Gasto </option> 
                </select>  
                      @error('natu') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="value">Valor</label>
                <input wire:model.defer="value"  type="text" class="form-control" id="value" placeholder="value">@error('value') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="status"> Status</label>
               <select wire:model.defer="status" id="status" required="" name="status" class="form-control">
                  <option  value="1"  select > Active </option> 
                  <option  value="0" > Desactive </option> 
                </select>  
                      @error('status') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group d-none ">
                <label for="empresa_id"></label>
                <input wire:model="empresa_id" type="text" class="form-control" id="empresa_id" placeholder="Empresa Id">@error('empresa_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <h4>Marque si es modulo de Factury </h4>
                <h6>Solo se permite una asignacion de  cierre de caja</h6>
                @if (session()->has('message'))
				<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
				@endif
                <div class="form-check form-switch">
                        @if($this->contable == 0)
                               <input class="form-check-input btn-danger m-4" type="checkbox" role="switch" id="contable" wire:click="ckeking_contable({{$this->selected_id}}, 1)">
                               @elseif ($contable == 1)
                                 <input class="form-check-input m-4" type="checkbox" role="switch" id="contable" checked wire:click="ckeking_contable({{$this->selected_id}}, 0)">      
                        @endif 
                </div>
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