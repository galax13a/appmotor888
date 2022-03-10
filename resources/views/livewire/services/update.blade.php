<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="name">Nombre del Servicio</label>
                <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="value">Valor del Servicio</label>
                <input wire:model.defer="value" type="text" class="form-control" id="value" placeholder="Value">@error('value') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="porcentaje">Porcentaje Operario %</label>
                <input wire:model.defer="porcentaje" type="text" class="form-control" id="porcentaje" placeholder="porcentaje">@error('porcentaje') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select wire:model.defer="status" id="status" required="" name="status" class="form-control">
              
                        <option  value="{{ $status}}" > Desactivar </option> 
                        <option  value="1" > Activar </option> 
                  
                  </select>
 </div>
          
            @foreach($cars as $row)
           
            @endforeach
           
            <div class="form-group" >
                <label for="tipo"> Tipo de carro</label>
            <select class="form-control" name ="carss_id" id="carss_id" wire:model="cars_id">
           
                @foreach ($cars as $car)
                 <option  value="{{ $car->id }}" >{{ $car->name }} </option>   
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
            $('#msg_id').on('change', function(){
               alert('mensaje Editar 2.0  ' + this.value );
                //@this.set('cars_id', this.value)
            // $('#carss_id').append('selected')
             // $('#carss_id').append('<option value="5" selected >One</option>');
                
            })
        })
</script> 