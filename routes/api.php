<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PassportAuthController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GestionController;
//use App\Http\Controllers\Admin\EventapiController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//API PASsport
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::get('usuario/menu', [PassportAuthController::class, 'menuUsuario'])->name('menuUsuario');

Route::get('beneficiario/apoyo', [GestionController::class, 'editarApoyo'])->name('benApoyo');

Route::middleware('auth:api')->group(function () {
    
    Route::post('eventos/crear', [EventController::class, 'eventoCrear'])->name('eventoCrear');
    Route::post('actividades/crear', [EventController::class, 'actividadCrear'])->name('actividadCrear');
    Route::post('logout', [PassportAuthController::class, 'logoutall'])->name('logoutall');

    //Route::post('reservas/crear', [GestionController::class, 'reservaCrearApi'])->name('reservaCrearApi');
    Route::post('reservas/crear', [GestionController::class, 'reservaUsuario'])->name('reservaCrearApi');
    

});


Route::post('expiracion', [PassportAuthController::class, 'expiracionToken'])->name('expiracionToken');
Route::get('idtoken', [PassportAuthController::class, 'idAccessToken'])->name('idAccessToken');

Route::get('deleteidtoken', [PassportAuthController::class, 'deleteidtoken'])->name('deleteidtoken');

//Eventos para Registros desde la app
Route::get('getuserasistencia', [App\Http\Controllers\Admin\RegistrosappController::class, 'getUserAsistencia'])->name('getUserAsistencia');

Route::get('eventosJsonAll', [App\Http\Controllers\Admin\EventController::class, 'eventosJsonAll'])->name('eventosJsonAll');

Route::get('eventos', [EventController::class, 'eventosListar'])->name('eventosListar');

Route::get('especilistas', [App\Http\Controllers\Admin\UserController::class, 'espicialistasListar'])->name('espicialistasListar');

Route::get('lugares', [EventController::class, 'lugaresListar'])->name('lugaresListar');
Route::get('actividadesbyevent', [EventController::class, 'listaActividadesEvent'])->name('listaActividadesEvent');
Route::get('detalleActividad', [EventController::class, 'detalleActividad'])->name('detalleActividad');

Route::get('actividadArchivarAPI', [EventController::class, 'actividadArchivarAPI'])->name('actividadArchivarAPI');


Route::get('areas', [EventController::class, 'areasListar'])->name('areasListar');

Route::get('servicios/contar', [EventController::class, 'contarServicios'])->name('contarServicios');

//Registro asistencia desde web
Route::get('/evento/{id}/actividades', [App\Http\Controllers\Admin\EventController::class, 'actividadXEvento'])->name('actividadXEvento');



Route::get('/proyecto/{id}/niveles', [App\Http\Controllers\Admin\LevelController::class, 'levelByProyecto'])->name('getNivelProyecto');

//api doc : https://documenter.getpostman.com/view/6553325/UUy39SJv
//article: https://dev.to/sahilkashyap64/qr-login-in-php-2pgf
Route::post('/login/create/qrcode', [App\Http\Controllers\QrController::class, 'createQrcodeAction']);//creates QR and save it as png 
Route::post('/login/mobile/scan/qrcode', [App\Http\Controllers\QrController::class, 'mobileScanQrcodeAction']);//gets scaned by phone with key passed in header
Route::post('/login/qrcodedoLogin', [App\Http\Controllers\QrController::class, 'qrcodeDoLoginAction']); //this url is used when qr code is scanned successfully
Route::post('/login/scan/qrcode', [App\Http\Controllers\QrController::class, 'isScanQrcodeAction']); //Check whether the code has been scanned 



Route::get('publicaciones', [App\Http\Controllers\ProductController::class, 'indexall']);
Route::post('publicaciones', [App\Http\Controllers\ProductController::class, 'storeall']);




//Administracion Proyectos

Route::get('proyectosjson', [App\Http\Controllers\Admin\ProjectController::class, 'indexItem']);
Route::get('/proyectos', [App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('proyectos');
Route::post('/proyectosjson', [App\Http\Controllers\Admin\ProjectController::class, 'storeItem'])->name('proyectosjson');

Route::get('/proyectos/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('proyectoEditar');
Route::post('/proyectos/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('proyectoActualizar');

Route::get('/proyectos/{id}/eliminar', [App\Http\Controllers\Admin\ProjectController::class, 'delete'])->name('proyectoEliminar');

Route::get('/proyectos/{id}/restaurar', [App\Http\Controllers\Admin\ProjectController::class, 'restore'])->name('proyectoRestaurar');



Route::get('enviarurl', [App\Http\Controllers\Admin\ProjectController::class, 'enviarurl'])->name('enviarurl');

Route::post('checkbox', [App\Http\Controllers\Admin\ProjectController::class, 'checkbox'])->name('checkbox');

//EVENTOS//actividades
/*Route::group(['middleware' => 'Jwtauth'], function () {
    Route::post('eventos/crear', [App\Http\Controllers\Api\EventoController::class, 'eventoCrear'])->name('eventoCrear');
    Route::post('actividades/crear', [App\Http\Controllers\Api\EventoController::class, 'actividadCrear'])->name('actividadCrear');
    
});*/




//Route::post('eventos/crear', [App\Http\Controllers\Api\EventoController::class, 'eventoCrear'])->name('eventoCrear');

//Beneficiarios Apoyos Gestión y Fomento
Route::post('loginBeneficiario', [PassportAuthController::class, 'loginBeneficiario'])->name('loginBeneficiario');