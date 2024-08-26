<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Admin\ContratosController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\EventController;
use Illuminate\Support\Facades\Artisan;



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

    //return view('welcome');
    return redirect()->route('eventosIndex');

});

Route::get('/slidervideo', function () {

    return view('admin.eventos.slidervideo');
    //return redirect()->route('eventosIndex');

});


//verAtril
Route::get('/pantalla', [App\Http\Controllers\Admin\EventController::class, 'verAtril'])->name('pantalla');
//Route::get('/pantalla', [App\Http\Controllers\Admin\EventController::class, 'pantalla'])->name('pantalla');


Route::get('/politica-privacidad', function () {

    return view('privacidadeventapp');

});

Route::get('/politica-privacidad-turismapp', function () {

    return view('privacidadturismapp');

});



//estados prueba js qr registro
Route::post('/store-asistencias', [App\Http\Controllers\Admin\EventController::class, 'storeAsistencias'])->name('storeAsistencias');
Route::get('/registroqr', [App\Http\Controllers\Admin\EventController::class, 'regAsistenciaView'])->name('regAsistencia');




Route::get('/instrucciones', function () {

    return view('welcome');
    //return redirect()->route('eventosIndex');

});

Route::get('/loginBeneficiario', function () {

    return view('auth.loginbeneficiarios');
    //return redirect()->route('eventosIndex');

});


Route::get('/apoyoPersona', function () {

    return view('admin.eventos.personaapoyo');
    //return redirect()->route('eventosIndex');

});



Route::get('/reportar', [App\Http\Controllers\MailController::class, 'contactForm'])->name('reportar');
Route::post('/reportar', [App\Http\Controllers\MailController::class, 'storeContactForm'])->name('contact-form.store');
//Route::get('/contact-form', [App\Http\Controllers\MailController::class, 'storeContactForm'])->name('contact-form.store');
Route::post('/subir-archivo', [App\Http\Controllers\MailController::class, 'subirArchivo'])->name('subirArchivo');



Route::get('/encuesta-ai-grupo', function () {

    return view('areas.encuestasaintegral');
    //return redirect()->route('eventosIndex');

})->name('encuesta-ai-grupo');


Route::get('/encuesta-ai-induc', function () { return view('areas.encaintegralind');//return redirect()->route('eventosIndex');
	})->name('encuesta-ai-induc');










Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/seleccionar/proyecto/{id}', [App\Http\Controllers\HomeController::class, 'seleccionarProyecto'])->name('seleccionarProyecto');

Route::get('/seleccionar/orden/{img}/{id}', [App\Http\Controllers\HomeController::class, 'seleccionarOrden'])->name('seleccionarOrden');

//Route::get('/reportar', [App\Http\Controllers\HomeController::class, 'getReportar'])->name('reportar');
//Route::post('/reportar', [App\Http\Controllers\HomeController::class, 'postReportar'])->name('reportar');





Route::group(['middleware' => 'admin'], function () {

	Route::get('/private/{path}/{file}', [App\Http\Controllers\MailController::class, 'verArchivo'])->name('verArchivo');

	//Administracion Usuarios
	Route::get('/usuarios', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('usuarios');
	Route::post('/usuarios', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('usuarios');

	Route::get('/usuarios/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('usuarioEditar');
	Route::post('/usuarios/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('usuarioActualizar');

	Route::get('/usuarios/{id}/eliminar', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('usuarioEliminar');
	//SelectAnidado
	Route::post('/get-proyectos', [App\Http\Controllers\Admin\UserController::class, 'getProyectos']);
	
	Route::get('/usuario/{id}/corresp/{corresp}', [App\Http\Controllers\Admin\UserController::class, 'asignarCorresp'])->name('asignarCorresp');

	Route::get('/usuario/{id}/estado/{estado}', [App\Http\Controllers\Admin\UserController::class, 'asignarEstado'])->name('asignarEstado');

	//Administracion Proyectos
	Route::get('/proyectos', [App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('proyectos');
	Route::post('/proyectos', [App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('proyectos');

	Route::get('/proyectos/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('proyectoEditar');
	Route::post('/proyectos/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('proyectoActualizar');

	Route::get('/proyectos/{id}/eliminar', [App\Http\Controllers\Admin\ProjectController::class, 'delete'])->name('proyectoEliminar');

	Route::get('/proyectos/{id}/restaurar', [App\Http\Controllers\Admin\ProjectController::class, 'restore'])->name('proyectoRestaurar');

	
	

	//Actividades
	Route::get('/actividades/{id}/archivar', [App\Http\Controllers\Admin\EventController::class, 'actividadArchivar'])->name('actividadArchivar');
	Route::get('/actividades/{id}/restaurar', [App\Http\Controllers\Admin\EventController::class, 'actividadRestaurar'])->name('actividadRestaurar');
	Route::get('/actividades/{id}/asistencia', [App\Http\Controllers\Admin\EventController::class, 'actividadAsistencia'])->name('actividadAsistencia');
	Route::get('/actividades/{id}/eliminar', [App\Http\Controllers\Admin\EventController::class, 'actividadEliminar'])->name('actividadEliminar');


	
	//Admin Categorias
	Route::post('/categorias', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categorias');
	Route::post('/categorias/editar', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categoriaActualizar');
	Route::get('/categorias/editar', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categoriaActualizar');
	Route::get('/categorias/{id}/eliminar', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('categoriaEliminar');

	Route::get('proyectos/categoriasjson/{project_id}/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'indexItem'])->name('categoriasjson');


    //ADmin Apoyos
    Route::get('/apoyos/create', [App\Http\Controllers\Admin\GestionController::class, 'apoyosCreate'])->name('apoyosCreate');
    Route::post('/apoyos/store', [App\Http\Controllers\Admin\GestionController::class, 'apoyoStore'])->name('apoyoStore');
    Route::get('/apoyos/{id}/archivar', [App\Http\Controllers\Admin\GestionController::class, 'apoyoArchivar'])->name('apoyoArchivar');
	Route::get('/apoyos/{id}/restaurar', [App\Http\Controllers\Admin\GestionController::class, 'apoyoRestaurar'])->name('apoyoRestaurar');
	Route::get('/apoyos/{id}/eliminar', [App\Http\Controllers\Admin\GestionController::class, 'apoyoEliminar'])->name('apoyoEliminar');
	Route::get('/apoyos/{id}/reserva', [App\Http\Controllers\Admin\GestionController::class, 'activarReserva'])->name('activarReserva');
	Route::get('/apoyos/{user_id}/tarifa/{tarifa}', [App\Http\Controllers\Admin\GestionController::class, 'cambiarTarifa'])->name('cambiarTarifa');
	Route::get('/apoyos/servicios', [App\Http\Controllers\Admin\GestionController::class, 'contarServicios'])->name('contarServicios');
	Route::get('/apoyos/asistencias', [App\Http\Controllers\Admin\GestionController::class, 'asistenciasIndex'])->name('asistenciasIndex');
	   Route::get('/apoyos/asistencias/{id}', [App\Http\Controllers\Admin\GestionController::class, 'asistenciaDetalle'])->name('asistenciaDetalle');
	Route::get('/asistencias/{id}/eliminar', [App\Http\Controllers\Admin\GestionController::class, 'asistenciaEliminar'])->name('asistenciaEliminar');
	Route::get('/apoyos/{id}/editar', [App\Http\Controllers\Admin\GestionController::class, 'editarApoyo'])->name('editarApoyo');
	//Admin Reservas Usuario
	Route::post('/reservausuario', [App\Http\Controllers\Admin\GestionController::class, 'reservaUsuario'])->name('reservaUsuario');
	Route::get('/reservausuario/{id}/eliminar', [App\Http\Controllers\Admin\GestionController::class, 'reservaEliminar'])->name('reservaEliminar');
	Route::get('/apoyos/{id}/servicios', [App\Http\Controllers\Admin\GestionController::class, 'selectServicios'])->name('selectServicios');
	Route::get('/apoyos/{id}/lugar', [App\Http\Controllers\Admin\GestionController::class, 'selectCafeteria'])->name('selectCafeteria');

	Route::get('/saldo/{id}/aprobar', [App\Http\Controllers\Admin\GestionController::class, 'saldoAprobar'])->name('saldoAprobar');

	Route::get('/saldo/{id}/eliminar', [App\Http\Controllers\Admin\GestionController::class, 'saldoEliminar'])->name('saldoEliminar');
	
	
	

	Route::post('/apoyo/reservar', [App\Http\Controllers\Admin\GestionController::class, 'apoyoReservar'])->name('apoyoReservar');
	
	
	Route::post('/saldoUsuario', [App\Http\Controllers\Admin\GestionController::class, 'saldoUsuario'])->name('saldoUsuario');
	
	Route::get("/buscarDiaReserva",[App\Http\Controllers\Admin\GestionController::class,'buscarDiaReserva'])->name('buscarDiaReserva');

	
	Route::get('corresp-export', [App\Http\Controllers\Admin\GestionController::class, 'exportCorrespon'])->name('correspon.export');

	Route::get('apoyosfull-export', [App\Http\Controllers\Admin\GestionController::class, 'exportApoyosFull'])->name('apoyosfull-export');



	//Admin Niveles
	Route::post('/niveles', [App\Http\Controllers\Admin\LevelController::class, 'store'])->name('niveles');
	Route::post('/niveles/editar', [App\Http\Controllers\Admin\LevelController::class, 'update'])->name('nivelesActualizar');
	Route::get('/niveles/{id}/eliminar', [App\Http\Controllers\Admin\LevelController::class, 'delete'])->name('nivelesEliminar');


	//ProyectoUsuario
	Route::post('/proyecto-usuario', [App\Http\Controllers\Admin\ProjectUserController::class, 'store'])->name('proyectoUsuario');
	Route::get('/proyecto-usuario/{id}/eliminar', [App\Http\Controllers\Admin\ProjectUserController::class, 'delete'])->name('proyectoUsuarioEliminar');
	Route::post('/proyecto-usuario/{id}', [App\Http\Controllers\Admin\UserController::class, 'getProyectosUsuario'])->name('getProyectosUsuario');
	
	//MenuUsuario
	Route::post('/menu-usuario', [App\Http\Controllers\Admin\UserController::class, 'storeMenu'])->name('storeMenu');
	Route::get('/menu-usuario/{id}/eliminar', [App\Http\Controllers\Admin\UserController::class, 'deleteMenu'])->name('deleteMenu');
	Route::get('/token/{id}/eliminar', [App\Http\Controllers\Admin\UserController::class, 'deleteToken'])->name('deleteToken');	


	Route::get('/configuracion', [App\Http\Controllers\Admin\ConfigController::class, 'index'])->name('configuracion');	


	//Eventos
	//Route::get('/eventos', 'EventController@index')->name('eventos.index');
	Route::get('/eventos/create', [App\Http\Controllers\Admin\EventController::class, 'create'])->name('eventoCreate');
	Route::get('/eventos/{id}/cambiarEstado', [App\Http\Controllers\Admin\EventController::class, 'cambiarEstadoEvento'])->name('cambiarEstadoEvento');
	//Seleccionar tipo de evento
	Route::get('eventos/{id}/cambiarTipo', [App\Http\Controllers\Admin\EventController::class, 'selectTipo'])->name('selectTipo');
	Route::get('eventos/{id}/cambiarCategoria', [App\Http\Controllers\Admin\EventController::class, 'cambiarCategoria'])->name('cambiarCategoria');

	Route::get('/actividades/{evid}/{id}/editar', [App\Http\Controllers\Admin\EventController::class, 'actividadEdit'])->name('eventoEditar');
	//Route::post('/actividad/{id}', [App\Http\Controllers\Admin\EventController::class, 'actividadUpdate'])->name('eventoActualizar');
	Route::get('actividades/{id}/selectHorasC', [App\Http\Controllers\Admin\EventController::class, 'selectHorasC'])->name('selectHorasC');
	//Route::post('/usuarios', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('usuarios');

	Route::get('/eventos/{id}', [App\Http\Controllers\Admin\EventController::class, 'editarEvento'])->name('editarEvento');
	Route::post('/eventos/{id}', [App\Http\Controllers\Admin\EventController::class, 'eventoActualizar'])->name('eventoActualizar');


	Route::get('/eventos/{id}/eliminar', [App\Http\Controllers\Admin\EventController::class, 'eventoEliminar'])->name('eventoEliminar');


	//ATRIL
	Route::get('/indexAtril', [App\Http\Controllers\Admin\EventController::class, 'indexAtril'])->name('eventos.indexAtril');
	Route::get('/imgatril/{id}/cambiarEstado', [App\Http\Controllers\Admin\EventController::class, 'cambiarEstadoImagenAtril'])->name('cambiarEstadoImagenAtril');
	Route::get('/imgatril/create', [App\Http\Controllers\Admin\EventController::class, 'createImgAtril'])->name('createImgAtril');
	Route::post('/imgAtrilStore', [App\Http\Controllers\Admin\EventController::class, 'storeImgAtril'])->name('imgAtrilStore');
	
	//SelectAnidado
	Route::view('/selectAnidado', 'livewire.select-anidado');



	Route::get('asistencias-export', [App\Http\Controllers\Admin\EventController::class, 'export'])->name('asistencias.export');

	
	Route::get('/pdfview/{id}', [App\Http\Controllers\Admin\EventController::class, 'pdfview'])->name('pdfview');

	Route::get('/eventos/{id}/asistencia', [App\Http\Controllers\Admin\EventController::class, 'generatePDF'])->name('generatePDF');

	Route::get('/actividades/{id}/{fecha}/asistencia', [App\Http\Controllers\Admin\EventController::class, 'generatePDFActividad'])->name('generatePDFActividad');
	
	Route::get('/obtener-ubicacion', [App\Http\Controllers\Admin\EventController::class, 'obtenerUbicacionActual'])->name('obtenerUbicacionActual');


	//FullCalendar
	Route::get('fullcalendar', [CalendarController::class, 'index']);
	Route::post('fullcalendarAjax', [CalendarController::class, 'ajax']);

	//Contratos
	/*Route::get('contratos', function () {
        return view('admin.contratos.ingreso');
    })->name('contratos');*/

	Route::get('contratos', [ContratosController::class, 'ingreso'])->name('contratos');
	Route::get('vercontratos', [ContratosController::class, 'contratos'])->name('vercontratos');
	Route::post('contratos', [ContratosController::class, 'create'])->name('contratospost');
	Route::get("/buscarContratista",[ContratosController::class,'buscarContratista'])->name('buscarContratista');
	Route::post('regObjeto', [ContratosController::class, 'regObjeto'])->name('regObjeto');
	Route::post('/obligaciones', [ContratosController::class, 'obligaciones'])->name('obligaciones');
	Route::post('/deleteObligacion', [ContratosController::class, 'deleteObligacion'])->name('deleteObligacion');
	Route::get('contrato/{id}', [ContratosController::class, 'contratoEdit'])->name('contratoEdit');

	
	/////Inventarios
	Route::get('inventarios', [InventoryController::class, 'regInventarios'])->name('regInventarios');
	Route::get('verinventarios', [InventoryController::class, 'controlInventarios'])->name('controlInventarios');
	Route::post('inventarios', [InventoryController::class, 'create'])->name('inventariospost');
	Route::get('pedidoCliente', [InventoryController::class, 'pedidoCliente'])->name('pedidoCliente');
	Route::post('regClienteInv', [InventoryController::class, 'regClienteInv'])->name('regClienteInv');
	Route::get("/buscarClienteInv",[InventoryController::class,'buscarClienteInv'])->name('buscarClienteInv');
	Route::post('editarClienteInv', [InventoryController::class, 'editarClienteInv'])->name('editarClienteInv');
	Route::post('precioClienteInv', [InventoryController::class, 'precioClienteInv'])->name('precioClienteInv');
	Route::get("/buscarProductoInv",[InventoryController::class,'buscarProductoInv'])->name('buscarProductoInv');
	Route::get("/buscarExistenciaProducto",[InventoryController::class,'buscarExistenciaProducto'])->name('buscarExistenciaProducto');
	Route::get("/detalleBodegasProducto",[InventoryController::class,'detalleBodegasProducto'])->name('detalleBodegasProducto');
	Route::post('/deleteProdOrden', [InventoryController::class, 'deleteProdOrden'])->name('deleteProdOrden');

	Route::get('/orden/{id}/vistapdf', [App\Http\Controllers\Admin\InventoryController::class, 'pdfPedidoCliente'])->name('pdfPedidoCliente');


	
	Route::get("/buscarInstitucionJS",[InventoryController::class,'buscarInstitucionJS'])->name('buscarInstitucionJS');

	Route::post('regOrden', [InventoryController::class, 'regOrden'])->name('regOrden');
	Route::post('/regProductoOrden', [InventoryController::class, 'regProductoOrden'])->name('regProductoOrden');
	//Route::post('/deleteObligacion', [ContratosController::class, 'deleteObligacion'])->name('deleteObligacion');
	Route::get('verordenes', [InventoryController::class, 'verordenes'])->name('verordenes');
	Route::get('ordenCliente/{id}', [InventoryController::class, 'ordenClienteEdit'])->name('ordenClienteEdit');
	Route::get("/buscarPedidoNum",[InventoryController::class,'buscarPedidoNum'])->name('buscarPedidoNum');
	Route::post('editarValoresOrden', [InventoryController::class, 'editarValoresOrden'])->name('editarValoresOrden');
	

	//Firmar
    Route::post('/firmar-osinstall/{id}', [InventoryController::class, 'dobleFactor'])->name('dobleFactor');

    //Firmar
    Route::post('/generarcod-osinstall/{id}', [InventoryController::class, 'generarCodigoDoble'])->name('generarCodigoDoble');

	//Firmar
    Route::post('/generarCodigoDobleApi', [InventoryController::class, 'generarCodigoDobleApi'])->name('generarCodigoDobleApi');
	Route::post('/dobleFactorApi', [InventoryController::class, 'dobleFactorApi'])->name('dobleFactorApi');


	//////IINVENTARIOS
	

	Route::get('/home-calendar', [App\Http\Controllers\CalendarController::class, 'homeCalendar'])->name('homeCalendar'); // {{ route('home') }}

	//Device
	Route::get('/deleteDevice/{id}/eliminar', [App\Http\Controllers\Admin\UserController::class, 'deleteDevice'])->name('deleteDevice');

	
	
	
});

Auth::routes();

Route::get("/buscarEstamentos",[EventController::class,'buscarEstamentos'])->name('buscarEstamentos');


//Incidencias
Route::get('/incidencia/{id}/atender', [App\Http\Controllers\IncidentController::class, 'atender'])->name('incidenciaAtender');
Route::get('/incidencia/{id}/resolver', [App\Http\Controllers\IncidentController::class, 'resolver'])->name('incidenciaResolver');
Route::get('/incidencia/{id}/abrir', [App\Http\Controllers\IncidentController::class, 'abrir'])->name('incidenciaAbrir');
Route::get('/incidencia/{id}/editar', [App\Http\Controllers\IncidentController::class, 'editar'])->name('incidenciaEditar');
Route::get('/incidencia/{id}/derivar', [App\Http\Controllers\IncidentController::class, 'avanzarNivel'])->name('avanzarNivel');
Route::get('/incidencia/{id}/eliminar', [App\Http\Controllers\IncidentController::class, 'eliminar'])->name('incidenciaEliminar');
Route::get('/incidencia/{id}/restaurar', [App\Http\Controllers\IncidentController::class, 'restaurar'])->name('incidenciaRestaurar');
Route::get('verIncidencia/{id}', [App\Http\Controllers\HomeController::class, 'verIncidencia'])->name('verIncidencia');

//Prestamos
Route::get('dashprestamos', [App\Http\Controllers\PrestamosController::class, 'dashprestamos'])->name('dashprestamos');
Route::get('devolverPrestamo/{id}', [App\Http\Controllers\HomeController::class, 'devolverPrestamo'])->name('devolverPrestamo');
Route::get('eliminarPrestamo/{id}/eliminar', [App\Http\Controllers\HomeController::class, 'eliminarPrestamo'])->name('eliminarPrestamo');
Route::get('verPrestamo/{id}', [App\Http\Controllers\PrestamosController::class, 'verPrestamo'])->name('verPrestamo');
Route::get('abrirPrestamo/{id}/abrir', [App\Http\Controllers\PrestamosController::class, 'abrirPrestamo'])->name('abrirPrestamo');
Route::get('restaurarPrestamo/{id}/restaurar', [App\Http\Controllers\PrestamosController::class, 'restaurarPrestamo'])->name('restaurarPrestamo');



//Mensajes
Route::post('/mensajes', [App\Http\Controllers\MensajesController::class, 'store'])->name('mensajeStore');


//PDF GENERAR
Route::get('pdf', [App\Http\Controllers\PrestamosController::class, 'invoice'])->name('pdf');


//Eventos
Route::get('/actividad_evento/{id_evento}', [App\Http\Controllers\Admin\EventController::class, 'get_activity_by_event'])->name('get_activity_by_event');

Route::get('/actividad_evento/detalle_actividad/{id_actividad}', [App\Http\Controllers\Admin\EventController::class, 'get_detail_activity'])->name('get_detail_activity');

Route::get('/eventos', [App\Http\Controllers\Admin\EventController::class, 'index'])->name('eventosIndex');
Route::post('/eventos', [App\Http\Controllers\Admin\EventController::class, 'store'])->name('eventoStore');

Route::get('eventosjson', [App\Http\Controllers\Admin\EventController::class, 'eventosjson'])->name('eventosjson');

Route::get('/actividades/create', [App\Http\Controllers\Admin\EventController::class, 'actividadCreate'])->name('actividadCreate');

Route::post('/actividades/store', [App\Http\Controllers\Admin\EventController::class, 'actividadStore'])->name('actividadStore');

Route::get('/actividades/index', [App\Http\Controllers\Admin\EventController::class, 'indexActividades'])->name('indexActividades');

Route::get('/actividades/lista', [App\Http\Controllers\Admin\EventController::class, 'listaActividades'])->name('listaActividades');


//web.php
Route::get('/qrtesting2', [App\Http\Controllers\QrController::class, 'qr']); //shows the QR cde on screen
Route::get('/qrscanner', [App\Http\Controllers\QrController::class, 'scanner']);// scan the qr code
Route::post('web/login/entry/login', [App\Http\Controllers\QrController::class, 'qrlogin']);//Check whether the login has been confirmed ,and return the token in response and redirect


Route::post('product',[App\Http\Controllers\ProductController::class, 'createProduct']);   //for creating product
Route::get('product/{id}',[App\Http\Controllers\ProductController::class, 'updateProduct']); //for updating product
Route::post('product/{id}',[App\Http\Controllers\ProductController::class, 'deleteProduct']);  // for deleting product
Route::get('product',[App\Http\Controllers\ProductController::class, 'index']); // for retrieving product

Route::view("qrcode", "qrcode");


Route::get('/clear-cache', function () {
    \Artisan::call('config:cache');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    //dd("Cache is cleared");
	//return redirect()->route('eventosIndex')->with('notification', 'El evento se editó Correctamente');
	return back()->with('notification', 'Cache Limpia');
})->name('clearCache');


Route::get('/asistenciasjson', [App\Http\Controllers\Admin\EventController::class, 'asistenciasjson'])->name('asistenciasjson');


Route::get('/tiposJson/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'tiposJson'])->name('tiposJson');


Route::get('/private/{user}/{file}', [App\Http\Controllers\IncidentController::class, 'documentoPDF'])->name('documento-pdf');