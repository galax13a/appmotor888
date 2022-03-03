<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleStar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
          
              <div class="modal-header bg-primary text-dark">
                <i class="fa fa-car" aria-hidden="true"></i> MotorBike App 
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user" aria-hidden="true"></i> {{Str::upper($operario_name)}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
            
				<form>
            <div class="form-group " >
                <h5 class="text-right"> Calificar Nuestro Servicio 
                    
                    <i class="btn btn-primary fa fa-star  " ></i> {{$this->calificar_puntaje}} a 10</h5> 
                    <hr>
                <div class="container m-2 p-2" >
                 
               
                   
                  </div>
            
            </div>
         
            <h6 class="bold text-center"> El servicio sera calificado para / {{$this->calificar_name}} </h6>
        
         @if ($this->calificar_puntaje == 0)
                
                 @for ($i=1; $i<=10; $i++)
                
                 <i class="btn btn-light fa fa-star p-1 m-4" wire:click='votar({{$this->calificar_id}},<?php echo $i; ?>)''>{{$i}} </i> 
                 @endfor
            @endif
        
            @if ($this->calificar_puntaje <= 10 )
                @for ($i=1; $i<=$this->calificar_puntaje; $i++)
                <i class="btn btn-warning fa fa-star " wire:click='votar({{$this->calificar_id}},<?php echo $i; ?>)''></i> 
               
                @endfor
               
                @if ($this->calificar_puntaje > 0 )
                @for ($i=$this->calificar_puntaje; $i<10; $i++)
                             <i class="btn btn-light fa fa-star " wire:click='votar({{$this->calificar_id}},<?php echo $i+1; ?>)''></i> 
                    @endfor
                    @endif
                
        @endif
<hr>
        <h4 class="text-center bold"> Servicio : <strong>  {{$this->calificar_name_servicio}} </strong> </h4>

            </div>
           
                @if ($this->calificar_puntaje == 0 )
                <button type="button" class="btn btn-danger p-2 m-2" >
                <strong> Calificar el Servicio <i class="fa fa-shower" aria-hidden="true"></i> </strong> 
                @else ($this->calificar_puntaje > 0 )
                <button type="button" class="btn btn-warning p-2 m-2" >
                <strong> Gracias x calificar el servicio {{$this->calificar_puntaje }} <i class="fa fa-shower" aria-hidden="true"></i> </strong> 

                @endif
            </button>
            
            <div class="modal-footer">
                <img class="img-responsive centrar " wire:loading src="/css/icons/save.gif" width="20%" height="20%"alt="" >
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
               
            </form>
            </div>
        </div>
    </div>
</div>