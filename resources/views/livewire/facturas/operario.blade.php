<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
          
              <div class="modal-header bg-warning text-dark">
                <i class="fa fa-car" aria-hidden="true"></i> MotorBike App 
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user" aria-hidden="true"></i> {{Str::upper($operario_name)}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
            
				<form>
            <div class="form-group" >
                <h5 class="text-center">Services Today {{ $this->fecha}} </h5> 

                <div class="container m-2 p-2" >
                  <div wire:loading class="text-center">
                      <img src="/css/loder.gif" width="30%" height="30%"alt="">
                  </div>
               
                    @if($myservicios)
                    @foreach ($myservicios as $service)
                    @php
                        $total = $service->operario + $total;
                        $total_empresa = $service->empresa + $total_empresa;
                        $total_all = $service->value + $total_all;
                        $contador = $contador + 1;
                    @endphp
                    <div class="row">
                      
                      <div class="col">
                        {{ $contador}} 
                       ) {{ Str::upper($service->servicio)}}
                      
                      </div>
                      <div class="col">
                        <button type="button"class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title=" $ {{number_format($service->value,0)}}">
                            {{ number_format($service->operario,0)}}
                          </button>
                          <br>
                          <p class="text-center text-bold">
                            <strong>
                            Hace {{ \Carbon\Carbon::parse($service->created_at)->diffForHumans() }}
                          </strong>
                          </p>
                      </div>
                     
                      <div class="col">
                        <button type="button" class="btn btn-light">  
                          <img src="/css/cars/bike{{$service->icon}}.svg " width="33" height="33"alt="">
                                           
                          {{ Str::upper($service->cars)}}
                        </button>
                      </div>
                      <div class="col"> 
                        <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$service->porcentaje}} %">
                           <strong>{{ Str::upper($service->placa)}} </strong>
                          </button>
                         
                      </div>


                    </div>
                    <hr>
                    @endforeach
                    <div class="container p-1 bg-warning shadown">
                        <div class="row">
                          <div class="col">
                            <strong>
                            {{$operario_name}}
                          </strong>
                          </div>
                          <div class="col">
                           <strong> Total @ Pagar </strong> 
                          </div>
                          <div class="col"> 
                            <button type="button" class="btn btn-success">
                                <strong>$ {{ number_format($total) }}
                                </strong> 
                            </button>
                          </div>
                          
                        </div>
                      </div>
                      <hr>
                      <div class="container p-1">
                        <div class="row">
                          <div class="col">
                            Empresa : 
                          </div>
                          <div class="col">
                             Total
                          </div>
                          <div class="col"> 
                            <button type="button" class="btn btn-outline-warning">
                                <strong>$ {{ number_format($total_empresa,0) }}
                                </strong> 
                            </button>
                          </div>
                          
                        </div>
                      </div>

                      <div class="container p-1">
                        <div class="row">
                          <div class="col">
                           Services Totals :
                          </div>
                          <div class="col">
                             Total
                          </div>
                          <div class="col"> 
                            <button type="button" class="btn btn-outline-danger">
                                <strong>$ {{ number_format($total_all,0) }}
                                </strong> 
                            </button>
                          </div>
                          
                        </div>
                      </div>

                    @endif
                  </div>
            
            </div>
         
            <h4> Pago Contable Nomina | {{ $this->fecha}}</h4>
            @if (session()->has('message_pay_error'))
            <div wire:poll.4s class="btn btn-sm btn-danger" style="margin-top:2px; margin-bottom:2px;">
                {{ session('message_pay_error') }} </div>
              @endif

              @if (session()->has('message_pay'))
              <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:2px; margin-bottom:2px;">
                  {{ session('message_pay') }} </div>
                @endif
            <hr>
                   
            <?php $data = $this->get_caja($gasto_id, Str::upper($operario_name)); ?>

            {{ $this->get_contable($idoperario)}}
            @if (!empty($this->contables[0]->contable)) 
                      <?php $this->gasto_id = $this->contables[0]->id_gasto; ?>
                      <strong>Contable / {{ $this->contables[0]->contable }} /  {{Str::upper($operario_name)}} /
                      
                        @if (!empty($data->count()>0)) <button type="button" class="btn btn-sm btn-success">Pagado</button>
                      
                        <?php $this->btn_pay = false; ?>
                        @else     <button type="button" class="btn btn-sm btn-danger">Sin Pago</button>
                        <?php $this->btn_pay = true; ?>
                        @endif

                      </strong>
                    
                     
                      @elseif (empty($this->contables[0]->contable)) 
                          <strong>
                            No existe una contabilidad  Asignada para el operador <br> <br>
                            Actualice la informacion del operario !
                            <a href="{{ url('admin/operarios') }}" target="_blank" >Hacer Cambio en operador!</a>
                            <br>
                          <h6>Crea un registro contable con nombre (pago a operarios) <a href="{{ url('admin/contable') }}" target="_blank" >Ir a Crear</a> </h6>
                          </strong>
                          <?php 
                          /*
                          <img src="/recursos/contable-pago.jpg"  width="360" height="230" alt="">
                          <h6>Despues lo asignas al operario </h6>
                          <img src="/recursos/operarios.jpg"  width="360" height="200" alt="">
                          <hr>
                         */
                        ?>
                          <button type="button" class="btn btn-danger m-2 text-center align-center">Para Generar Pago debe de cumplir con los requisitos</button>
                          {{ $this->btn_pay = false;}}
                    
            @endif
             
            </div>
                

            <div class="modal-footer">
             
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
             
                <button type="button"
                   @if (!$this->btn_pay ) disabled="disabled" 
                   @endif 
                   @if ($total < 1 ) disabled="disabled" title="No hay nada que pagar"  
                   @endif 
                  wire:click.prevent="pay({{$this->gasto_id}}, '{{Str::upper($operario_name)}}', {{$total}} )" 
                   class="btn btn-primary close-modal">Pagar
            </button>
            <img wire:loading src="/css/icons/save.gif" width="30%" height="30%"alt="" >
        </form>
            </div>
        </div>
    </div>
</div>