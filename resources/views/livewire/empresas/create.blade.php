<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="name"></label>
                <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="nit"></label>
                <input wire:model="nit" type="text" class="form-control" id="nit" placeholder="Nit">@error('nit') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="dir"></label>
                <input wire:model="dir" type="text" class="form-control" id="dir" placeholder="Dir">@error('dir') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="tel"></label>
                <input wire:model="tel" type="text" class="form-control" id="tel" placeholder="Tel">@error('tel') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="logo"></label>
                <input wire:model="logo" type="text" class="form-control" id="logo" placeholder="Logo">@error('logo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="img"></label>
                <input wire:model="img" type="text" class="form-control" id="img" placeholder="Img">@error('img') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="wsp1"></label>
                <input wire:model="wsp1" type="text" class="form-control" id="wsp1" placeholder="Wsp1">@error('wsp1') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="wsp2"></label>
                <input wire:model="wsp2" type="text" class="form-control" id="wsp2" placeholder="Wsp2">@error('wsp2') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group d-none">
                <label for="status"></label>
                <input wire:model="status" type="text" class="form-control" id="status" placeholder="Status">@error('status') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group d-none">
                <label for="users_id"></label>
                <input wire:model="users_id" type="text" class="form-control" id="users_id" placeholder="Users Id">@error('users_id') <span class="error text-danger">{{ $message }}</span> @enderror
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
                    @this.set('users_id', {{Auth::user()->id}});
            })
</script>