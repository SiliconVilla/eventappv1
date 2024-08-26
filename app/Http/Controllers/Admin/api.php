<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


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
    Route::post('/proyectosjson', [App\Http\Controllers\Admin\ProjectController::class, 'storeItem'])->name('proyectos');

    Route::get('/proyectos/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('proyectoEditar');
    Route::post('/proyectos/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('proyectoActualizar');

    Route::get('/proyectos/{id}/eliminar', [App\Http\Controllers\Admin\ProjectController::class, 'delete'])->name('proyectoEliminar');

    Route::get('/proyectos/{id}/restaurar', [App\Http\Controllers\Admin\ProjectController::class, 'restore'])->name('proyectoRestaurar');

