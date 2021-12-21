@section('title', __('Cajas'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div wire:poll.60s>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4 class="mr-2">
                                Caja </h4>
                        </div>
                        <div class="input-group input-group-lg p-1">
                            <input wire:model='keyWord' type="text" class="form-control input-lg" name="search"
                                id="search" placeholder="Buscar por Fecha">
                        </div>
                        
                        <div class="container" class="form-group bg-danger">
                            <strong>Desde</strong>
                                <div class="input-group input-group-lg m-1 p-1">
                                
                                    <input autocomplete="off" wire:model='entre1' type="text" class="form-control input-lg" name="entre1"
                                        id="entre1" placeholder="Buscar por Inicio">
                                </div>
                                <strong>Hasta</strong>
                                <div class="input-group input-group-lg m-1">
                            
                                    <input autocomplete="off" wire:model='entre2' type="text" class="form-control input-lg" name="entre2"
                                        id="entre2" placeholder="Buscar por Fecha">
                                </div>
                                <button type="button"  wire:click.prevent="buscar()" title="Buscar x Fechas" class="btn btn-warning m-3">Buscar</button>
                                <img wire:loading src="/css/icons/save.gif" width="30%" height="30%"alt="" >
                            </div>
                    </div>
                </div>
                <hr>
                
                @if (session()->has('message'))
                    <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                        {{ session('message') }} </div>
                @endif
                <div id="contaner" class="container">
                    <div class="row">
                        <div class="col">
                            Contable : 
                            <div class="form-group" wire:ignore>
                                <select class="select2" id="gastos_id" wire:model="gastos_id">
                                    <option value=""> Seleccione Contable: </option>
                                    @foreach ($gastos as $gasto)
                                        <option value="{{ $gasto->id }}-{{ $gasto->value }}-{{ $gasto->natu }}">
                                            {{ $gasto->id }} {{ Str::upper($gasto->name) }} -
                                            {{ number_format($gasto->value, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('gastos_id') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="col">
                            Valor :
                            <div class="form-group">

                                <input wire:model="value" type="text" class="form-control" id="value"
                                    placeholder="value">@error('value') <span
                                    class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col">
                            Description
                            <div class="form-group">
                                <input wire:model="name" type="text" class="form-control" id="name"
                                    placeholder="Describa">@error('name') <span
                                    class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col">
                            <button type="button"  wire:click.prevent="store()" class="btn btn-dark m-3">Guadar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('livewire.cajas.create')
                    @include('livewire.cajas.update')
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead">
                                <tr>
                                    <td>#</td>
                                    <th>Des</th>
                                    <th>Fecha</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Contable</th>
                                    <th>Empresa</th>
                                    <td>ACTIONS</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cajas as $row)
                                <?php 
                                if($row->gasto->natu == 0)  {
                                    $total_gasto = $row->valor + $total_gasto;
                                }else{
                                    $total_ingreso = $row->valor + $total_ingreso;
                                }
                                
                                ?>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-center">{{ $row->fecha }}</td>
                                        <td class="text-center">
                                            @if ($row->gasto->natu == 0)
											<h4><span class="badge bg-danger text-light">$  {{ number_format($row->valor) }}</span>
											</h4> 
                                            @elseif ($row->gasto->natu == 1)
											<h4><span class="badge bg-success text-light">$  {{ number_format($row->valor) }}</span>
											</h4> 
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($row->status == 0)
                                                <button type="button" class="btn btn-outline-warning">Sin
                                                    Verificar</button>
                                            @else
                                                <button type="button" class="btn btn-outline-primary">ok Validado</button>

                                            @endif

                                        </td>
										@if ($row->gasto->natu == 0)
                                        <td class="text-center text-danger">{{ Str::upper($row->gasto->name) }}</td>
                                       @else
									   <td class="text-center text-success">{{ Str::upper($row->gasto->name) }}</td>
                                      
									   @endif
										<td>{{ Str::upper($row->empresa->name) }}</td>
                                        <td width="90">
                                            <a class="" data-toggle="modal" data-target="#updateModal"
                                            wire:click="edit({{ $row->id }})"> 
                                            <li class="fa fa-edit"></li> Edit</a>
                                            <a @if (1 == 2)
                                            wire:click="destroy({{ $row->id }})" 
                                            @endif 
                                            onclick="confirm('Confirm Delete Caja id {{ $row->id }}? \nDeleted Cajas cannot be recovered!')||event.stopImmediatePropagation()"
                                             class="">
                                             <li class="fa fa-trash">         
                                                </li> </a>
                                           
                                        </td>
									
                                @endforeach
                                <?php
                                  $total_caja = $total_ingreso - $total_gasto;
                                ?>
                            </tbody>
                        </table>
                        {{ $cajas->links() }}
                    </div>

                    <div id="totales" class="card text-right align-right m-3" style="width: 22rem; float:right; margin-right:24px;">
                        <div class="card-header bg-warning">
                          <h4>Estadisticas Caja {{ $this->fecha_serve}}</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item bg-danger-50"><h5>Cierre Gastos / {{ number_format($total_gasto) }} </h5></li>
                          <li class="list-group-item bg-indigo-50"><h5>Cierre Ingresos / {{number_format($total_ingreso) }}</h5> </li>
                          <li class="list-group-item bg-success"><h4>Totales  / $ {{ number_format($total_caja)}}</h4> </li>
                        </ul>
                      </div>

                </div>
            </div>
        </div>
        </div>
            </div>
        </div>

       

<script>
    document.addEventListener('livewire:load', function() {

        $("#gastos_id").select2();


        $("#gastos_id").on("change", function() {
            @this.set('gastos_id', this.value);
            var res = this.value.split("-")[1];
			var cod = this.value.split("-")[0];
          
            @this.set('value', res);
			@this.set('id_gasto', cod);

			
        })


        window.livewire.on('combos', () => {
            //$('#exampleModal').modal('hide');
            $("#gastos_id").select2();

        });

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
                                maxDate: '-1d'
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
