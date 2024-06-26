<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
	return view('welcome');
});


Auth::routes();


Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});






//protección de las rutas para que solo los usuarios autenticados tengan acceso
Route::middleware(['auth'])->group( function() {

	Route::get('/dash', 'DashController@data')->name('home');

	Route::view('empresa', 'empresa'); 
	Route::view('cajones', 'cajones'); 
	Route::view('tipos', 'tipos'); 
	Route::view('tarifas', 'tarifas'); 
	Route::view('cortes', 'cortes'); 
	Route::view('usuarios', 'usuarios'); 

	Route::view('cajas', 'cajas');
	Route::view('rentas', 'rentas'); 	
	Route::view('cotizaciones', 'cotizaciones'); 
	Route::view('usuarios', 'usuarios'); 
	Route::view('clientes', 'clientes'); 

	Route::view('pagos', 'pagos'); 
	Route::view('ventasdiarias', 'ventasdiarias'); 
	Route::view('ventasporfechas', 'ventasporfechas'); 
	Route::view('proximasrentas', 'proximasrentas'); 
	Route::view('movimientos', 'movimientos'); 	
	Route::view('dashboard', 'dashboard'); 
});

//print routes
Route::get('print/order/{id}', 'PrinterController@TicketVista');
Route::get('ticket/pension/{id}', 'PrinterController@TicketPension');






//tests
Route::get('print', 'HomeController@PrintReceipt');
Route::get('print/receipt/{id}', 'PrinterController@PrintOrder');




