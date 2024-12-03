<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TarjetaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Ruta de Página inicial
Route::get('/', function () {
    return view('welcome');
});



// Rutas de Autenticación
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('mostrarLogin');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    
    Route::middleware(['auth'])->group(function() {
        // Administradores
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        
        Route::get('/admin/crear_usuario', [AdminController::class, 'mostrarCrearUsuario'])->name('admin.mostrarCrearUsuario');
        Route::post('/admin/crear_usuario', [AdminController::class, 'crearUsuario'])->name('admin.crearUsuario');
        Route::get('/admin/editar_usuario/{id}', [AdminController::class, 'mostrarActualizarUsuario'])->name('admin.mostrarActualizarUsuario');
        Route::put('/admin/editar_usuario/{id}', [AdminController::class, 'actualizarUsuario'])->name('admin.actualizarUsuario');
        Route::delete('/admin/borrar_usuario/{id}', [AdminController::class, 'borrarUsuario'])->name('admin.borrarUsuario');
        
        Route::get('/admin/crear_tarjeta', [AdminController::class, 'mostrarCrearTarjeta'])->name('admin.mostrarCrearTarjeta');
        Route::post('/admin/crear_tarjeta', [AdminController::class, 'crearTarjeta'])->name('admin.crearTarjeta');

        Route::post('/tarjetas/{id}/habilitar', [AdminController::class, 'habilitar'])->name('admin.habilitar');
        Route::post('/tarjetas/{id}/deshabilitar', [AdminController::class, 'deshabilitar'])->name('admin.deshabilitar');


        // Operadores
        Route::get('/operador', [OperadorController::class, 'index'])->name('operador.dashboard');
        
        Route::get('/operador/recargar', [OperadorController::class, 'mostrarRecargar'])->name('operador.mostrarRecargar');
        Route::post('/operador/recargar', [OperadorController::class, 'recargar'])->name('operador.recargar');

        Route::get('/operador/consultar-saldo', [OperadorController::class, 'mostrarConsultarSaldo'])->name('operador.mostrarConsultarSaldo');
        Route::post('/operador/consultar-saldo', [OperadorController::class, 'consultarSaldo'])->name('operador.consultarSaldo');


        // Todos los roles
        Route::get('/{id}/perfil', [UserController::class, 'mostrarPerfil'])->name('perfil');


    });

    Route::get('/simular_uso', [TarjetaController::class, 'mostrarSimularUso'])->name('mostrarSimularUso');
    Route::post('/simular_uso', [TarjetaController::class, 'simularUsoTarjeta'])->name('simularUsoTarjeta');


    // Ruta para manejar el enlace de verificación
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/dashboard');
    })->middleware(['auth', 'signed'])->name('verification.verify');



    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/login');
    })->middleware(['signed'])->name('verification.verify');
    