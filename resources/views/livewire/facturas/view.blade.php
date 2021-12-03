@section('title', __('Facturas'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div wire:poll.60s>
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                        </div>
                        @if (session()->has('message'))
                            <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                                {{ session('message') }} </div>
                        @endif
						<div class="container">

                            
                            <div class=" grid grid-cols-1 md:grid-cols-2  lg:grid-cols-6 gap-4">
                                <div class="row m-2 md:grid-cols-2">
                                    @foreach ($operarios as $operario)
                                  <div class="col float-right" data-toggle="modal" data-target="#exampleModal" wire:click="servicios_operador({{$operario->id}}, '{{$operario->name}}')">
                                    <button type="button" class="btn btn-dark float-center" style=" margin-top: -15px;">
                                        {{ substr(Str::upper($operario->name),0,8) }} 
                                         <span class="badge bg-danger" >
                                             @foreach ($this->get_servicios($operario->id) as $dato )
                                            {{ $dato->allservice }}
                                             @endforeach
                                        
                                        </span>
                                      </button>
                                  </div>
                                  @endforeach
                                </div>
                              </div>
                        </div>

                      
                          <div class="container p-1">
                            <div class="row">
                              <div class="col">
                                #Factory
                              </div>
                              <div class="col">
                                Date
                              </div>
                              <div class="col">
                                <span  class="badge rounded-pill bg-warning text-dark p-2">  {{ $fecha}}</span>
                           
                              </div>
                              <div class="col">
                                <div class="input-group input-group-sm">
                               
                                    <input size="6" wire:model="daty" type="text" class="input-group-text sm" id="daty" placeholder="Date">@error('daty') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                              </div>
                            </div>
                          </div>


                        <div class="container lg">
                            <div class="row align-items-start">
                              <div class="row">
                                <div class="col">
                                    <div class="form-group" wire:ignore>
                                        <select class="form-select form-select-lg mb-3"" id="servicio_id" wire:model="servicio_id">
											<option value=""> Seleccione Servicio: </option>
                                            @foreach ($servicios as $servicio)
                                                <option value="{{ $servicio->id }}-{{$servicio->value}}-{{$servicio->porcentaje}}">
                                                    {{ Str::upper($servicio->name) }} - {{ number_format($servicio->value,2) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('servicio_id') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group" wire:ignore>
                                        <select class="select2" id="placa" wire:model="placa">
											<option value=""> Seleccione Placa: </option>
                                            @foreach ($mycarrs as $mycar)
                                                <option value="{{ $mycar->name }}-{{ $mycar->cliente_ids }}-{{$mycar->cliente_ids}}"> {{ Str::upper($mycar->name) }} -
                                                    {{ Str::upper($mycar->cliente) }} </option>
                                            @endforeach
                                        </select>
									
                                    </div>
                                    @error('placa') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col">
                                
									<div class="form-group" wire:ignore >
                                        <select class="select2" id="operario_id" wire:model="operario_id">
											<option value=""> Seleccione Operario: </option>
                                            @foreach ($operarios as $operario)
                                                <option value="{{ $operario->id }}"> {{ Str::upper($operario->name) }} 
                                                   </option>
                                            @endforeach
                                        </select>
										
                                    </div>
                                    @error('operario_id') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
																
								<div class="col">
			
                                    <button wire:click="save()"  type="button" class="btn btn-dark btn-sm bg-danger"><i class="fa fa-plus-circle p-1 bg-danger" ></i></button>
                                </div>
                              </div>
                              <div class="col">
                           
                               
                              
                              </div>

                            
                            </div>
                        </div>

                        <div class="input-group input-group-lg">
                            <input wire:model='keyWord' type="text" class="form-control input-lg" name="search"
                                id="search" placeholder="Search">
                        </div>
                       
                    </div>
                </div>
			

                <div class="card-body">
                    @include('livewire.facturas.create')
                    @include('livewire.facturas.update')
                    @include('livewire.facturas.new')
                    @include('livewire.facturas.vista')
                   
                 
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead">
                                <tr>
                                    <td>#</td>
                                    <th>Placa</th>
                                    <th>Precio</th>
                                    <th>Empresa</th>
                                    <th>Operario</th>
                                    <th>Status</th>
                                    <th>Cliente</th>
                                    <th>Wsp</th>
                                    <th>Servicio</th>
                                    <th>Operario</th>
                                    <th>Date</th>
                                    <td>ACTIONS</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facturas as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="/css/cars/bike{{ $row->service->carstype->icon }}.svg " width="33" height="33"alt="">
                                            <strong>{{ Str::upper($row->placa) }}</strong>
                                        </td>
                                        <td><strong> {{ number_format($row->value, 2) }}</strong></td>
                                        <td> {{ number_format($row->empresa, 2) }}</td>
                                        <td>{{ number_format($row->operario, 2) }} 
                                            
                                            @if ($row->service->porcentaje == 100)
                                            <button type="button" class="btn btn-warning">Free Service</button>
                                            @else % {{ $row->service->porcentaje }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-check form-switch ml-4">
                                                @if ($row->status == 0)
                                                    <input class="form-check-input btn-danger" type="checkbox"
                                                        role="switch" id="status"
                                                        wire:click="ckeking({{ $row->id }}, 1)">
                                                    <span class="badge bg-danger p-1">Sin pago</span>
                                                @elseif ($row->status == 1)
                                                    <input class="form-check-input btn-warning" type="checkbox"
                                                        role="switch" id="status" checked
                                                        wire:click="ckeking({{ $row->id }}, 0)">
                                                    <span class="badge bg-warning  p-1">Pagado!</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ Str::substr($row->cliente->name,0,6) }}</td>
                                        <td>{{ $row->cliente->wsp1 }}</td>
                                        <td>{{ Str::upper($row->service->name) }}
                                            
                                            </td>
                                        <td>{{ substr(Str::upper($row->operarios->name),0,6) }} </td>
                                        <td>{{ $row->fecha }}</td>
                                        <td width="90">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a data-toggle="modal" data-target="#updateModal"
                                                        class="dropdown-item"
                                                        wire:click="edit({{ $row->id }})"><i
                                                            class="fa fa-edit"></i> Edit </a>
                                                    <a class="dropdown-item"
                                                        onclick="confirm('Confirm Delete Factura id {{ $row->id }}? \nDeleted Facturas cannot be recovered!')||event.stopImmediatePropagation()"
                                                        wire:click="destroy({{ $row->id }})"><i
                                                            class="fa fa-trash"></i> Delete </a>
                                                </div>
                                            </div>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $facturas->links() }}
                    </div>
                </div>

				<div class="container">
                    <div class="row">
                     @foreach ($empresa_totales as $empresa_total)
                      <div class="col order-last">
                        <button type="button" class="btn btn-outline-info">
                            <strong>
                                Totales : $ {{ number_format($empresa_total->total,2)}}
                              </strong>
                        </button>
                        
                      </div>
                   
                      <div class="col">
                        <button type="button" class="btn btn-outline-success">
                            <strong>
                                   Empresa : $ {{  number_format($empresa_total->empresa,2)}}</button>
                    </strong>
                      </div>
                      <div class="col order-first">
                          <button type="button" class="btn btn-outline-dark">  Operarios  : $ {{ number_format($empresa_total->operario,2)}}</button>
                    <strong>
                      
                    </strong>
                      </div>

                      <div class="col order">
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#vistaModal" wire:click="get_nopayment()">  No Payment</button>
                  <strong>
                    
                  </strong>
                    </div>
                      

                      @endforeach

                    </div>
                  </div>
                    <br>
            </div> 
        </div>
    </div>
</div>


<script>
    document.addEventListener('livewire:load', function() {
       
     

		$("#servicio_id").select2();
        $("#placa").select2();
		$("#operario_id").select2();

        $("#mfecha").attr('value', "misfechas");

        $("#servicio_id").on("change", function() {
            @this.set('servicio_id', this.value);
			
        })
		$("#placa").on("change", function() {
            @this.set('placa', this.value);
        })
		$("#operario_id").on("change", function() {
            @this.set('operario_id', this.value);
        })
        
       
        $("#daty").on('keypress',function(e) {
            if(e.which == 13) {
               // alert('Change Date');
                //@this.set('fecha', $("#daty").val());
            }
        });

      

		window.livewire.on('combos', () => {
		//$('#exampleModal').modal('hide');
                $("#servicio_id").select2();
                $("#placa").select2();
                $("#operario_id").select2();
                //alert('combos');
            });

                $.noConflict();
                    
              $( "#daty" ).datepicker({
                                dateFormat : 'yy/mm/dd',
                                changeMonth : true,
                                changeYear : true,
                                yearRange: '-100y:c+nn',
                                maxDate: '+1d'
                            });

                            $('#daty').change(function(){
                                var thisDate = $(this).val();
                                 @this.set('fecha', thisDate);
                            });
                        

    })
</script>
