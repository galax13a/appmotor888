<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleMsg" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
          
              <div class="modal-header bg-success text-dark">
                <i class="fa fa-car" aria-hidden="true"></i> MotorBike App 
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-comment m-1" aria-hidden="true"></i> WhatsApp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group " >
                <h5 class="text-right"> Envia un mensaje a {{$this->msg_cliente;}} / WhatsApp </h5>
                    <hr>
                <div class="container " >
                    <div class="form-group" wire:ignore>
                        <select    class="form-control"  id="mssg_id" wire:model="msg_id">
                            <option value=""> Seleccione  Mensaje : </option>
                            @foreach ($mensajes as $msg)
                            <option  value="{{ $msg->id }}" > {{ Str::upper($msg->name) }} </option>
                            @endforeach    
                        </select>
                        </div>
                
                        @if ($this->msg_contenido)
                        @php
                            $this->msg_msg = $this->msg_contenido[0]->mensaje;
                            $sentence =  $this->msg_msg;
                            $search = "@placa";
                            $replace = $this->msg_placa;
                            $new_sentence1 = str_replace($search, $replace, $sentence);
                            $search = "@cliente";
                            $replace = $this->msg_cliente;
                            $new_sentence = str_replace($search, $replace, $new_sentence1);
                            $search = "@operario";
                            $replace = $this->msg_operario;
                            $new_sentence = str_replace($search, $replace, $new_sentence);
                            $search = "@servicio";
                            $replace = $this->msg_servicio;
                            $new_sentence = str_replace($search, $replace, $new_sentence);
                            $this->msg_msg = $new_sentence;
                        @endphp

                       
                        <div class="form-group">
                            <label for="mensaje"></label>
                            <textarea wire:model="msg_msg" class="form-control" id="msg_msg" rows="5" placeholder="Mensaje"></textarea>
                           
                            <div class="form-group m-2 p-2 text-center">
                                <a href="https://api.whatsapp.com/send?phone=57{{$this->msg_phone}}&amp;text={{$this->msg_msg}}" target="_blank">
                                    <button type="button" title="Enviar un mensaje Whatsap" class="btn btn-sm btn-outline-success">
                                         <i class="fa fa-phone text-center" aria-hidden="true"></i>
                                       Enviar  Mensaje {{$this->msg_phone}}
                                        </button>
                                       
                                    </a>
                            </div>
                        </div>
                        @endif
                        </div>
                  </div>
            </div>
        <div class="modal-footer">
                <img class="img-responsive centrar " wire:loading src="/css/icons/save.gif" width="20%" height="20%"alt="" >
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
               
            </form>
         </div>
        </div>
    </div>
</div>

<script>

    document.addEventListener('livewire:load', function(){
        $('#mssg_id').on('change', function(){
          //alert('mensaje contenido del id :  ' + this.value );
            @this.set('msg_id', this.value)
        
            
        })
    })
</script> 