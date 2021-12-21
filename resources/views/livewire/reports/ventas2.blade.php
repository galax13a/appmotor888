<div>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Operarios</th>
            <th scope="col">Total</th>
            <th scope="col">Empresa</th>
            <th scope="col">Venta Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
       

         @foreach ($data2 as $row) 
        <?php 
               $this->data_total = $row->value + $this->data_total;
               $this->empresa_value = $row->empresa + $this->empresa_value;
               $this->operario_value = $row->operario + $this->operario_value;
        ?>
            <th scope="row">{{ $loop->iteration }}</th>
           
            <td><strong>{{ Str::upper($row->name) }}</strong> </td>
            <td> <strong> $ {{number_format($row->operario,0)}} </strong></td>
            <td><strong> $ {{number_format($row->empresa,0)}} </strong></td>
            <td><strong> $ {{number_format($row->value,0)}} </strong></td>
          
          </tr>
          @endforeach
        </tbody>
      </table>
   </div>


   <div class="card m-2 p-2">
    <div class="card-body">
        <button type="button" class="btn btn-warning">
            Ventas Totales <span class="badge bg-danger"> $ {{ number_format($this->data_total,0)}}</span>
          </button>
          <button type="button" class="btn btn-primary">
            Venta x Empresa <span class="badge bg-danger"> $ {{ number_format($this->empresa_value,0)}}</span>
          </button>

          <button type="button" class="btn btn-info">
            Ventas x Operarios <span class="badge bg-danger"> $ {{ number_format($this->operario_value,0)}}</span>
          </button>
 
          <?php
              $this->data_total = 0;
              $this->empresa_value = 0;
              $this->operario_value = 0;
          ?>
      
    </div>
  </div>
</div>