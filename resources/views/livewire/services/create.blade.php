<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Service</h5>
               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="name">Name Service</label>
                <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="value">Valor</label>
                <input wire:model.defer="value" type="text" class="form-control" id="value" placeholder="Value">@error('value') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="porcentaje">Porcentaje Operario % </label>
                <input wire:model.defer="porcentaje" type="text" class="form-control" id="porcentaje" placeholder="porcentaje">@error('porcentaje') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            
            
            <div class="form-group">
                <label for="status"> Tipo de Cars</label>
            <select    class="form-control"  id="cars_id" wire:model.defer="cars_id">
                <option value=""> Seleccione  : </option>
                @foreach ($cars as $car)
                <option  value="{{ $car->id }}" > {{ Str::upper($car->name) }} </option>
                @endforeach    
            </select>
            @error('cars_id') <span class="error text-danger">{{ $message }}</span> @enderror
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
$(document).ready(function(){

      

});
     document.addEventListener('livewire:load', function(){
                @this.set('status', 1);
        })
</script>