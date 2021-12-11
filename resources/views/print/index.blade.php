
<!DOCTYPE html>
<!-- saved from url=(0040)https://parzibyte.github.io/ticket-js/3/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="/print/style.css">
    <script src="/print/script.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="ticket">
        <img src="/css/cars/bike{{$icon}}" width="80" height="60"alt="Logotipo">
        <p class="centrado">TICKET DE VENTA 
            Placa/{{$placa}}
            <br>
            <br> {{ config('app.name', 'MotorBike') }}
            <br>Nit: 0
            <br>{{$fecha}}</p>
        <table>
            <thead>
                <tr>
                    <th class="cantidad"></th>
                    <th class="producto">SERVICIO</th>
                    <th class="precio">$</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="cantidad">1</td>
                    <td class="producto">{{$service}}</td>
                    <td class="precio">${{$valor}}</td>
                </tr>
                <tr>
                    <td class="cantidad">Por:</td>
                    <td class="producto">{{$operario}}</td>
                    <td class="precio">Operario</td>
                </tr>
                <tr>
                    <td class="cantidad">A:</td>
                    <td class="producto">{{$cliente}}</td>
                    <td class="precio">{{$placa}}</td>
                </tr>
                <tr>
                    
                    <td class="cantidad"></td>
                    <td class="producto">TOTAL</td>
                    <td class="precio">${{$valor}}</td>
                </tr>
            </tbody>
        </table>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
            <br>  {{ config('app.url', 'Motorbike') }}</p>
            <p class="centrado">Contacto y sugerencias!
                <br>#</p><br> <br>
    </div>
    <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>


</body></html>