<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          
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
                <div wire:loading class="text-center">
                  Processing Database...
              </div>
                <div class="container m-2 p-2" >
                    @if($myservicios)
                    @foreach ($myservicios as $service)
                    @php
                        $total = $service->operario + $total;
                        $total_empresa = $service->empresa + $total_empresa;
                        $total_all = $service->value + $total_all;
                    @endphp
                    <div class="row">
                      
                      <div class="col">
                        {{$service->servicio}}
                      </div>
                      <div class="col">
                        <button type="button"class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title=" $ {{number_format($service->value,2)}}">
                            {{ number_format($service->operario,2)}}
                          </button>
                        
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
                             Total @ pagar
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
                                <strong>$ {{ number_format($total_empresa,2) }}
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
                                <strong>$ {{ number_format($total_all,2) }}
                                </strong> 
                            </button>
                          </div>
                          
                        </div>
                      </div>

                    @endif
                  </div>
            
            </div>
            

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Pagar</button>
            </div>
        </div>
    </div>
</div>