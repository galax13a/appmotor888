<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="name">Name Cliente</label>
                <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="wsp1">Numero WhatsApp 1</label>
                <input wire:model.defer="wsp1" type="text" class="form-control" id="wsp1" placeholder="Wsp1">@error('wsp1') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="wsp2">Numero WhatsApp 2</label>
                <input wire:model.defer="wsp2" type="text" class="form-control" id="wsp2" placeholder="Wsp2">@error('wsp2') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="status"> Status</label>
               <select wire:model.defer="status" id="status" required="" name="status" class="form-control">
                  <option  value="1"  select > Active </option> 
                  <option  value="0" > Desactive </option> 
                </select>  
                      @error('status') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="Cumple2"></label>
                <input wire:model.defer="cumple2" type="text" class="form-control" id="cumple2" placeholder="Cumpleaños">@error('cumple') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group d-none">
                <label for="empresa_id"></label>
                <input wire:model="empresa_id" type="text" class="form-control" id="empresa_id" placeholder="Empresa Id">@error('empresa_id') <span class="error text-danger">{{ $message }}</span> @enderror
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
              
        $.noConflict();
                    
                    $( "#cumple2" ).datepicker({
                                dateFormat : 'yy-mm-dd',
                                changeMonth : true,
                                changeYear : true,
                                yearRange: '-100y:c+nn',
                                maxDate: '-1d'
                            });

                            $('#cumple2').change(function(){
                                var thisDate = $(this).val();
                                 @this.set('cumple2', thisDate);
                            });

                          
       })
</script>