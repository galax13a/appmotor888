@section('title', __('Facturas'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div wire:poll.60s>
                        <div style="display: flex; justify-content: space-between; align-items: center; ">

                        </div>
                      
						<div class="container  ">

                            <div class=" grid grid-cols-1 md:grid-cols-2  lg:grid-cols-6 gap-4 ">
                                <div class="row m-1 md:grid-cols-2">
                                    @foreach ($operarios as $operario)
                                  <div class="col float-right" data-toggle="modal" data-target="#exampleModal" wire:click="servicios_operador({{$operario->id}}, '{{$operario->name}}')">
                                    <button type="button" class="btn btn-dark float-center m-1" style=" margin-top: -15px;">
                                        {{ substr(Str::upper($operario->name),0,6) }} 
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

                      
                      
                      
                        <div class="container-fluid bg-secondary border  rounded ">
                          

                        <div class="container lg bg-secondary m-2 p-1 ">
                            <div class="row align-items-start  m-1 ">
                              <div class="row">
                                <div class="col">
                                    <div class="form-group" wire:ignore>
                                        <select class="select2"" id="servicio_id" wire:model="servicio_id">
											<option value=""> Seleccione Servicio: </option>
                                            @foreach ($servicios as $servicio)
                                                <option value="{{ $servicio->id }}/{{$servicio->value}}/{{$servicio->porcentaje}}">
                                                    {{ Str::upper($servicio->name) }} / {{ number_format($servicio->value,2) }}
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
                                    <button wire:click="save()"  type="button" class="btn btn-dark btn-sm bg-success"><i class="fa fa-plus-circle p-1 bg-success" ></i> Crear Factura</button>
                                </div>
                                @if (session()->has('message'))
                                <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                                    {{ session('message') }} </div>
                            @endif
                    
                              </div>
                        <div class="input-group input-group-lg ">
                            <input wire:model='keyWord' type="text" class="form-control input-lg bg-dark" name="search"
                                id="search" placeholder="Buscar x Placa">
                                <button type="button" class="btn btn-light m-1" wire:click="cambiar_tema()" ><i class="fa fa-adjust" aria-hidden="true"></i></button>
                                <button id="tema" type="button" class="btn btn-warning m-1" ><i class="fa fa-adjust" aria-hidden="true"></i></button>
                            </div>
                    </div>

                    <div class="container m-2 p-1 ">
                        <div class="row">
                          <div class="col">
                            <strong>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#vistaModal" wire:click="get_nopayment()">  <i class="fa fa-ban" aria-hidden="true"></i> No Pagos</button>
                            </strong>
                          </div>
                          <div class="col">
                            <strong>
                                <button type="button" class="btn btn-dark" wire:click="get_payment()">  <i class="fa fa-credit-card" aria-hidden="true"></i> Pagos Factory</button>
                            </strong>
                          
                          </div>

                          <div class="col m-1">
                            <div class="input-group input-group-sm">
                               <input size="6" wire:model="daty" type="text" style="cursor: pointer;" title="Change Date" class="input-group-text lg bg-light text-bold text-green-400" id="daty" placeholder="Date">@error('daty') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                          </div>

                          <div class="col m-1">
                            <span  class="badge rounded-pill bg-danger p-2 text-light">  Facturacion de {{ $fecha}} </span>
                           </div>
                          <div class="col">
                            <span  class="badge rounded-pill bg-light text-dark p-2">  {{ $fecha_server}} </span>
                          </div>
                        </div>
                      </div>

                      <hr>
           
                </div>
			
            </div>

                <div class="card-body">
                    @include('livewire.facturas.operario')
                    @include('livewire.facturas.update')
                    @include('livewire.facturas.empresa')
                    @include('livewire.facturas.payment')
                    @include('livewire.facturas.star')
                    @include('livewire.facturas.msg')
            
                    <div class="table-responsive rounded" style="margin-top:-55px;">
                        <table id="tabla_tema" class="table table-bordered table-sm {{ $this->thema_factu}}">
                            <thead class="thead ">
                                <tr>
                                    <td>#</td>
                                    <th>Placa Cliente</th>
                                    <th>Precio</th>
                                    <th>Empresa</th>
                                    <th>Operario</th>
                                    <th>Status</th>
                                    <th>Cliente</th>
                                    <th>Whatsap</th>
                                    <th>Servicio</th>
                                    <th>Operario</th>
                                    <th>Fecha Factory</th>
                                    <td>ACTIONS</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facturas as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}
                                          
                                        </td>
                                        <td class="text-sm-left">
                                       
                                         @if ($row->voto ==0)
                                                 <i class="btn btn-light fa fa-star  " aria-hidden="true" data-toggle="modal" data-target="#exampleStar" wire:click="carga_voto({{$row->id}},'{{ substr(Str::upper($row->operarios->name),0,6) }}', {{$row->voto}}, '{{ Str::upper($row->service->name) }}')">{{$row->voto}}</i>
                                        @elseif($row->voto <= 5)
                                                 <i class="btn btn-danger fa fa-star  " aria-hidden="true" data-toggle="modal" data-target="#exampleStar" wire:click="carga_voto({{$row->id}},'{{ substr(Str::upper($row->operarios->name),0,6) }}', {{$row->voto}},'{{ Str::upper($row->service->name) }}')">{{$row->voto}}</i>
                                        @elseif($row->voto>=9)
                                                <i class="btn btn-primary fa fa-star  " aria-hidden="true" data-toggle="modal" data-target="#exampleStar" wire:click="carga_voto({{$row->id}},'{{ substr(Str::upper($row->operarios->name),0,6) }}', {{$row->voto}},'{{ Str::upper($row->service->name) }}')">{{$row->voto}}</i>
                                        @elseif($row->voto >= 6 )
                                                 <i class="btn btn-warning fa fa-star  " aria-hidden="true" data-toggle="modal" data-target="#exampleStar" wire:click="carga_voto({{$row->id}},'{{ substr(Str::upper($row->operarios->name),0,6) }}', {{$row->voto}},'{{ Str::upper($row->service->name) }}')">{{$row->voto}}</i>
                                         @endif
                                         
                                    <img class=" btn-light p-1 rounded" src="/css/cars/bike{{ $row->service->carstype->icon }}.svg" width="33" height="33"alt="">
                                    <strong>{{ Str::upper($row->placa) }}</strong>
                                           
                                        </td>
                                        <td><strong> {{ number_format($row->value, 0) }}</strong></td>
                                        <td> {{ number_format($row->empresa, 0) }}</td>
                                        <td>
                                            @if($row->operario>0) {{ number_format($row->operario, 0) }}  @endif
                                            
                                            @if ($row->service->porcentaje == 100)
                                            <button type="button" class="btn btn-warning"> <strong> Free ❤ </strong></button>
                                            @else x{{ $row->service->porcentaje }}%
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
                                                    <span class="badge bg-warning text-dark  p-1">Pagado!</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ Str::upper($row->cliente->name,0,6) }}</td>
                                        <td class="text-center">
                                            @if ($row->cliente->wsp1 > 0)
                                           
                                           <p> {{ $row->cliente->wsp1 }} </p>
                                             @else <p> Sin Contacto </p>
                                            @endif
                                          
                                            <button wire:click="msg_carga('{{ Str::upper($row->cliente->name,0,6) }}', '{{ Str::upper($row->placa) }}','{{ substr(Str::upper($row->service->name),0,26) }}','{{Str::upper($row->operarios->name)}}',{{$row->cliente->wsp1 }})" data-toggle="modal" data-target="#exampleMsg" type="button" title="Enviar un mensaje WhatsApp" class="btn btn-sm btn-outline-success">
                                                 <i class="fa fa-phone text-center" aria-hidden="true"></i>
                                                Mensaje
                                                </button>
                                        </td>
                                        <td>{{ substr(Str::upper($row->service->name),0,26) }}
                                            
                                            </td>
                                        <td>{{ substr(Str::upper($row->operarios->name),0,7) }} </td>
                                        <td class="text-center">
                                            {{ $row->fecha }} 
                                            <a href="{{ url('/imprimir/') }}/333/{{Str::upper($row->operarios->name)}}/{{ Str::upper($row->service->name) }}/{{ Str::upper($row->placa) }}/{{ number_format($row->value, 0) }}/{{ Str::substr($row->cliente->name,0,6) }}/{{ $row->service->carstype->icon }}" 
                                                target="_blank" >
                                            <button type="button" title="imprimir servicio" class="btn btn-sm @if($this->thema_factu=="light")btn-outline-dark @else btn-outline-light @endif">
                                                 <i class="fa fa-print" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td width="90">
                                            <button data-toggle="modal" data-target="#updateModal"  wire:click="edit({{$row->id}})" class="btn btn-success p-1 ">✔️</button>
                                            <button onclick="confirm('Confirm Delete Factory id {{$row->id}}? \nDeleted Factory cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})" class="btn btn-danger p-1">➖</button>
                               </td>
                                      
                            </tbody>
                            
                         
                    @endforeach
                        </table>
                        
                        <hr>
                        {{ $facturas->links() }}
                    </div>
                </div>
                </div>
        
				<div class="container">
                    @if (!empty($facturas->count()<=0))
                   <div class="text-center text-capitalize m-2 p-4 ">
                    <h3>Sin Facturas, Esperemos tener un buen dia de ventas Hoy {{$fecha}} <br> 😀 Motorbike , Feliz Dia 🤑 🙏</h3>
                </div>
                @endif
                    <div class="row">
                       

                     @foreach ($empresa_totales as $empresa_total)
                      <div class="col order-last">
                        <button type="button" title="Hacer Cierre de caja" data-toggle="modal" data-target="#closefactura" class="btn btn-outline-info">
                            <strong>
                                Totales : $ {{ number_format($empresa_total->total,2)}}
                              </strong>
                        </button>
                        
                      </div>
                   
                      <div class="col">
                        <button type="button"  class="btn btn-outline-success">
                            <strong>
                                <?php
                                    $this->total_liquidar = $empresa_total->empresa;
                                ?>

                                   Empresa : $ {{  number_format($empresa_total->empresa,2)}}</button>
                    </strong>
                      </div>
                      <div class="col order-first">
                       
                          <button type="button" class="btn btn-outline-dark">  <strong> Operarios  : $ {{ number_format($empresa_total->operario,2)}}   </strong>
                        </button>                   
                  
                      </div>

                      <div class="col order">
                        <strong>
                        <button type="button"  class="btn btn-outline-danger" data-toggle="modal" data-target="#vistaModal" wire:click="get_nopayment()">  No Payment</button>
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

       let tema_color  = "table-light";
       let color = "black";
        $( "#tema" ).click(function() {
            
            if(color == "black"){
                          $("#tabla_tema").removeClass("table-dark");
                          color = "light";
                          tema_color = "table-light";                         
            }else  {
                alert("else");
                $("#tabla_tema").removeClass("table-light");
                 color = "black";
                 tema_color = "table-dark";
            }
             $("#tabla_tema").addClass(tema_color);
        });    

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

		window.livewire.on('combos', () => {
		//$('#exampleModal').modal('hide');
                $("#servicio_id").select2();
                $("#placa").select2();
                $("#operario_id").select2();
                //alert('combos');
            });

         $.noConflict();
                    
              $( "#daty" ).datepicker({
                                dateFormat : 'yy-mm-dd',
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
