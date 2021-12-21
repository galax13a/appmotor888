<div>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Caja Contable</th>
            <th scope="col">Total Contable</th>
            <th scope="col">Naturaleza</th>
          </tr>
        </thead>
        <tbody>
          <tr>
       
            @foreach ($data4 as $row )
           
           <?php 
            if($row->natu == 1) {
              $this->data_total = $row->value + $this->data_total;
            }else{
              $this->empresa_gasto = $row->value + $this->empresa_gasto;
            }
         
             ?>
            <th scope="row">{{ $loop->iteration }}</th>
            <td><strong>{{ Str::upper($row->name) }}</strong> </td>
            <td><strong> $ {{number_format($row->value,0)}} </strong></td>
            <td>
              @if ($row->natu == 1)
              <button type="button" class="btn btn-info">Ingresos</button>
              @else
              <button type="button" class="btn btn-danger">Gastos</button>
              @endif
            </td>

          </tr>
          @endforeach
     
        </tbody>
      </table>
   </div>


   <div class="card m-2 p-2">
    <div class="card-body">
        <button type="button" class="btn btn-info">
            Ventas Ingresos <span class="badge bg-danger"> $ {{ number_format($this->data_total,0)}}</span>
          </button>
          <button type="button" class="btn btn-danger">
            Ventas Gastos <span class="badge bg-danger"> $ {{ number_format($this->empresa_gasto,0)}}</span>
          </button>
        
      
    </div>
  </div>
</div>