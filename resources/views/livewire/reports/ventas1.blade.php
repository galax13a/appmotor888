<div>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cars</th>
            <th scope="col">Servicios</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
         
         @foreach ($data1 as $row) 
        <?php 
               $this->data_total = $row->total + $this->data_total;
        ?>
            <th scope="row">{{ $loop->iteration }}</th>
            <td><img src="/css/cars/bike{{$row->icon}}.svg " class="shadown"  width="36" height="36" alt=""></td>
            <td><strong>{{ Str::upper($row->name) }}</strong> </td>
            <td> <strong> $ {{number_format($row->total,0)}} </strong></td>
          
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
          <?php
                $this->data_total = 0;
          ?>
    </div>
  </div>
</div>