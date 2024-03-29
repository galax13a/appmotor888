<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Carstype</h5>
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
                <label for="status"> Status</label>
               <select wire:model.defer="status" id="status" required="" name="status" class="form-control">
                  <option  value="1"  select > Active </option> 
                  <option  value="0" > Desactive </option> 
                </select>  
                      @error('status') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
           <h3>Seleccione un Icono :</h3> <hr>
            @for ($i = 1; $i <=255; $i++)
               
                <button type="button" class="btn btn-@if ($icon == $i)danger @endif">
                    <img wire:click.prevent="select_img({{$i}},{{ $selected_id}})" src="/css/cars/bike{{$i}}.png " width="85" height="85"  title="{{ $i}}" alt="...">
                </button>
            @endfor
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
       </div>
    </div>
</div>