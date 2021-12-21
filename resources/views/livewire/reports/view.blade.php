<div>
    @section('title', __('Reports'))
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                            <ul class="nav nav-tabs m-1">
                                <li class="nav-item">
                                <a class="nav-link 
                                @if ($menu == 1)
                                    active
                                @endif " 
                                wire:click="menu(1)"
                                href="javascript:void(0)"
                                aria-current="page" ><strong>Ventas x Servicio </strong> </a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link @if ($menu ==2)  active @endif" 
                                wire:click="menu(2)"
                                href="javascript:void(0)">Ventas x Operario</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link @if ($menu ==3)  active @endif" 
                                href="javascript:void(0)"
                                wire:click="menu(3)"
                                href="#">Ventas x Cars</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link @if ($menu ==4)  active @endif" 
                                href="javascript:void(0)"
                                wire:click="menu(4)"
                                >Ventas vs Gastos</a>
                                </li>
                            </ul>

                           <div class="container m-4">
                    @switch($menu)
                        @case(1)
                        <h3>Ventas por Servicio</h3>
                            @break
                            @case(2)
                            <h3>Ventas por Operario</h3>
                            @break
                            @case(3)
                            <h3>Ventas por Cars</h3>
                            @break
                            @case(4)
                            <h3>Ventas por fechas</h3>
                            @break
                        @default
                            
                    @endswitch
                            

                            <div class="container">
                                <div class="row">
                                  <div class="col">
                                    
                                    <strong>Desde</strong>
                                    <div class="input-group input-group-lg m-1 p-1">
                                    
                                        <input autocomplete="off" wire:model='entre1' type="text" class="form-control input-lg" name="entre1"
                                            id="entre1" placeholder="Buscar por Inicio">
                                    </div>
                                  </div>
                                  <div class="col">
                                    <strong>Hasta</strong>
                                   
                                    <div class="input-group input-group-lg m-1">
                                
                                        <input autocomplete="off" wire:model='entre2' type="text" class="form-control input-lg" name="entre2"
                                            id="entre2" placeholder="Buscar por Fecha">
                                    </div>
                                  </div>
                                  <div class="col">
                                  
                                    <button type="button"  wire:click.prevent="buscar()" title="Buscar x Fechas" class="btn btn-warning btn-lg m-4 w-100">Buscar</button>
                                  
                                  </div>
                                </div>
                              </div>
                              <img wire:loading src="/css/icons/save.gif" width="120px" height="90px"alt="" >
                              @switch($menu)
                                 @case(1)
                                     @include('livewire.reports.ventas1')
                                  @break
                                  @case(2)
                                      @include('livewire.reports.ventas2')
                                  @break
                                  @case(3)
                                      @include('livewire.reports.ventas3')
                                  @break
                                  @case(4)
                                         @include('livewire.reports.ventas4')
                                  @break
                              @default
                                  
                          @endswitch

                          
                </div>
            </div>
        </div>
    </div>

      
</div>


<script>
    document.addEventListener('livewire:load', function() {

        $.noConflict();
                    
                    $( "#entre1" ).datepicker({
                                dateFormat : 'yy-mm-dd',
                                changeMonth : true,
                                changeYear : true,
                                yearRange: '-100y:c+nn',
                                maxDate: '-1d'
                            });

                            $( "#entre2" ).datepicker({
                                dateFormat : 'yy-mm-dd',
                                changeMonth : true,
                                changeYear : true,
                                yearRange: '-100y:c+nn',
                                maxDate: '+1d'
                            });

                            $('#entre1').change(function(){
                                var thisDate = $(this).val();
                                 @this.set('entre1', thisDate);
                            });
                        
                            $('#entre2').change(function(){
                                var thisDate = $(this).val();
                                 @this.set('entre2', thisDate);
                            });
                        
          

    })
</script>