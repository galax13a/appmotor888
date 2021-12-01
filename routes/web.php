<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::view('admin/clientes', 'livewire.clientes.index')->middleware('auth');
	Route::view('admin/gastos', 'livewire.gastos.index')->middleware('auth');
	Route::view('admin/empresa', 'livewire.empresa.index')->middleware('auth');
	Route::view('admin/services', 'livewire.services.index')->middleware('auth');
	Route::view('admin/cars', 'livewire.carstypes.index')->middleware('auth');
   
    

//Route Hooks - Do not delete//
	Route::view('admin/cajas', 'livewire.cajas.index')->middleware('auth');
	Route::view('admin/facturas', 'livewire.facturas.index')->middleware('auth');
	Route::view('admin/operarios', 'livewire.operarios.index')->middleware('auth');
	Route::view('admin/myusers', 'livewire.myusers.index')->middleware('auth');

	Route::view('admin/placa/', 'livewire.placas.index');
