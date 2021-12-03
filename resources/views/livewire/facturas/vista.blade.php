<!-- Modal -->
<div wire:ignore.self class="modal fade" id="vistaModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Services Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body" >
				<form>
            <div class="form-group" >
                <h5 class="text-center">Services Today {{ $this->fecha}} </h5> 
                <div wire:loading>
                    Processing Payment...
                </div>
                <div class="container m-2 p-2" >
                    @if($array_nopayment)
                    @foreach ($array_nopayment as $service)
                    @php
                      // print_r($array_nopayment);
                        $total_all = $service->value + $total_all;
                         $contador = $contador + 1 ;
                    @endphp
                    <div class="row">
                      
                      <div class="col">
                          {{ $contador}} )
                        {{$service->servicio}}
                      </div>
                      <div class="col">
                        <button type="button"class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title=" $ {{number_format($service->value,2)}}">
                            {{ number_format($service->value,2)}}
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
                    <div class="container p-1 bg-danger shadown">
                        <div class="row">
                          <div class="col">
                            <strong>
                           Not Payment
                          </strong>
                          </div>
                          <div class="col">
                          <strong> Servicios sin pagar </strong>  
                          </div>
                          <div class="col"> 
                            <button type="button" class="btn btn-warning">
                                <strong>$ {{ number_format($total_all) }}
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