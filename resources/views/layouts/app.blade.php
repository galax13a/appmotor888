<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'MotorBike') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />

	 @livewireStyles
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <i class="fa fa-motorcycle m-1" aria-hidden="true"></i>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Motorbike') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                   
					@auth()
                    <ul class="navbar-nav mr-auto">
						<!--Nav Bar Hooks - Do not delete!!-->
						<li class="nav-item">
                            <a href="{{ url('admin/cajas') }}" class="nav-link"><i class="fa fa-university text-warning"></i> Caja</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('admin/factury') }}" class="nav-link"><i class="fa fa-bookmark   @if(Request::path() === 'admin/factury') text-info @endif  "></i> Factury</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('admin/operarios') }}" class="nav-link"><i class="fa fa-user-plus @if(Request::path() === 'admin/operarios') text-info @endif aria-hidden="true"></i> Operarios</a> 
                        </li>
                        @php
                        /*
                            	<li class="nav-item">
                            <a href="{{ url('admin/myusers') }}" class="nav-link"><i class="fa fa-user @if(Request::path() === 'admin/myusers') text-info @endif" aria-hidden="true"></i> Users</a> 
                        </li>
                        */
                        @endphp
					
				
						<li class="nav-item">
                            <a href="{{ url('admin/clientes') }}" class="nav-link"><i class="fa fa-users @if(Request::path() === 'admin/clientes') text-info @endif" aria-hidden="true"></i> Clientes</a> 
                        </li>
					
						<li class="nav-item">
                            <a href="{{ url('admin/contable') }}" class="nav-link"><i class="fa fa-calendar @if(Request::path() === 'admin/contable') text-info @endif" aria-hidden="true"></i> Contable</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('admin/empresa') }}" class="nav-link"><i class="fa fa-briefcase @if(Request::path() === 'admin/empresa') text-info @endif"></i> Empresa</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('admin/services') }}" class="nav-link"><i class="fa fa-paper-plane @if(Request::path() === 'admin/services') text-info @endif"></i> Services</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('admin/cars') }}" class="nav-link"><i class="fa fa-car @if(Request::path() === 'admin/cars') text-info @endif"></i> Cars</a> 
                        
                    </ul>
					@endauth()
					
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                             
                            @endif
                            
                            @if (Route::has('register1'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                                <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                 
                                    <a class="dropdown-item"  href="{{ url('admin/reports') }}">Reportes</a>

                                        <a class="dropdown-item"  href="{{ url('admin/inventario') }}">Inventario</a>
                                   
                                        <a class="dropdown-item" href="{{ url('admin/proveedores') }}">Proveedores</a>
                                   
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-2">
            @yield('content')
        </main>
    </div>
    @livewireScripts
<script type="text/javascript">
	window.livewire.on('closeModal', () => {
		$('#exampleModal').modal('hide');
	});
    //$('#cars_id').val(1);
</script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}" defer></script>


<link type="text/css" rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>


</body>
</html>