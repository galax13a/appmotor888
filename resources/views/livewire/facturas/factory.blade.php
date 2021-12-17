<!-- Modal -->
<div wire:ignore.self class="modal fade" id="closefactura" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cierre Factury - Date  {{ $this->fecha}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
              
            <div class="form-group text-center">
            
               
              @if (session()->has('message'))
              <div wire:poll.6s class="btn btn-sm btn-warning" style="margin-top:2px; margin-bottom:2px;">
                  {{ session('message') }} </div>
                @endif

        <span class="badge bg-warning p-4 m-2">
            <h5>Esta apunto de liquidar  y hacer cierre de caja <br> 
                    <button type="button" class="btn btn-success">  $ {{number_format($total_liquidar,2)}} </button>
            </h5>
        </span>
              <br>
              <hr>
              <?php $this->contable_service_name = $this->get_name_liquis() ?>

              @if (!empty($this->contable_service_name->count()>0))
             
               <?php $this->contable_service_id = $this->contable_service_name[0]->id ?>
               
               <?php $data = $this->get_caja_factory($this->contable_service_name[0]->id); ?>


              <h5>Servicio Contable / {{$this->contable_service_name[0]->name}} / 
                
              @if (empty($data->count() > 0) )
              <button type="button" class="btn btn-danger">No Pago</button>
              <?php $this->btn_pay = true; ?>
              @else 
              <button type="button" class="btn btn-success">Pago</button>
            
              <?php $this->btn_pay = false; ?>
              @endif
            
            </h5>
           

                         @else  <h5>Error !! Debe configurar en contable el modulo Factory  </h5>
                         <br>
                         <strong>Debe editar y asingar modulo Factory</strong>
                         <a href="{{ url('admin/contable') }}" target="_blank" >Ir a Actualizar</a> 
                         <br> <br>
                         <strong>Sugerencia :: Cree una contable con algun nombre : <br>
                             Cierre de caja <br>
                             Ingreso x Ventas <br>
                             Ventas operacionales <br>
                             Ingreso facturacion <br>
                             Ventas Diarias<br>
                             Facturacion <br>
                            </strong> <br>
                            <h6> Una Vez configurado puede liquidar el ingreso a las ventas</h6>
                            <?php $this->btn_pay = false; ?>
              @endif
           

                <input wire:model="total_liquidar" type="text" class="form-control d-none" id="value" placeholder="Value">
            </div>
            
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button"
                 @if (!$this->btn_pay ) disabled="disabled" @endif  

                 wire:click.prevent="pay_empresa({{$this->contable_service_id}},'{{$this->contable_service_name[0]->name}}', {{$total_liquidar}})"
                  class="btn btn-primary close-modal">Pagar en Caja
         
                </button>
                <img wire:loading src="/css/icons/save.gif" width="30%" height="30%"alt="">
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