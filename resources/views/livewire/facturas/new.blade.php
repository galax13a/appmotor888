<!-- Modal -->
<div wire:ignore.self class="modal fade" id="newfactura" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
                <div class="form-group">
                <label for="servicio_id"></label>
        
                {{ $servicio_id }}
                <select    class="select2"  id="servicio_id" wire:model="servicio_id">
                <option value=""> Seleccione  : </option>
                @foreach ($servicios as $servicio) 
                <option  value="{{ $servicio->id }}" > {{ Str::upper($servicio->name) }} </option>
                @endforeach    
                     
            <div class="form-group">
                <label for="placa">placa</label>
                <input wire:model="placa" type="text" class="form-control" id="placa" placeholder="Placa">@error('placa') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="value"></label>
                <input wire:model="value" type="text" class="form-control" id="value" placeholder="Value">@error('value') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="empresa"></label>
                <input wire:model="empresa" type="text" class="form-control" id="empresa" placeholder="Empresa">@error('empresa') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="operario"></label>
                <input wire:model="operario" type="text" class="form-control" id="operario" placeholder="Operario">@error('operario') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="status"></label>
                <input wire:model="status" type="text" class="form-control" id="status" placeholder="Status">@error('status') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="cliente_id"></label>
                <input wire:model="cliente_id" type="text" class="form-control" id="cliente_id" placeholder="Cliente Id">@error('cliente_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
          
            <div class="form-group">
                <label for="operario_id"></label>
                <input wire:model="operario_id" type="text" class="form-control" id="operario_id" placeholder="Operario Id">@error('operario_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
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
    document.addEventListener('livewire:load', function() {
       
		$("#servicio_id").select2();
        $("#placa").select2();
		$("#operario_id").select2();

    })
</script>