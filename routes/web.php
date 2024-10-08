<?php

// BACKEND
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;

// FRONTEND
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Auth::routes();

// BACKEND ROUTE
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('training', TrainingController::class);
    Route::resource('sertifikat', SertifikatController::class);
    Route::get('/sertifikat/{id}/preview', [SertifikatController::class, 'printCertificate'])->name('sertifikat.preview')->defaults('isPreview', true);
    Route::get('/sertifikat/{id}/print', [SertifikatController::class, 'printCertificate'])->name('sertifikat.print');
    Route::post('/sertifikat/{id}/status', [SertifikatController::class, 'status'])->name('sertifikat.status');

    Route::get('/export-excel', [SertifikatController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export-pdf', [SertifikatController::class, 'exportPDF'])->name('export.pdf');

    Route::get('/export-training', [TrainingController::class, 'exportExcel'])->name('export.training');

    // USER
    Route::get('/user', function (Request $request) {
        $middleware = new CheckRole();
        // Menjalankan middleware secara manual dengan passing request
        $response = $middleware->handle($request, function ($request) {
            return app()->call('App\Http\Controllers\UserController@index');
        }, 2); // Ganti 2 dengan ID role untuk Super Admin
        return $response;
    })->name('user.index');

    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');

    // ROLE
    Route::get('/role', function (Request $request) {
        $middleware = new CheckRole();
        // Menjalankan middleware secara manual dengan passing request
        $response = $middleware->handle($request, function ($request) {
            return app()->call('App\Http\Controllers\RoleController@index');
        }, 2); // Ganti 2 dengan ID role untuk Super Admin

        return $response;
    })->name('role.index');
    Route::put('role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::get('role/{id}', [RoleController::class, 'show'])->name('role.show');

});

// FRONTEND ROUTE
Route::get('/pelatihan/{id}', [PelatihanController::class, 'pelatihan']);
Route::get('/more', [App\Http\Controllers\MoreController::class, 'index'])->name('more');
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/check-certificate', [WelcomeController::class, 'checkCertificate'])->name('checkCertificate');
Route::post('/check-certificate', [WelcomeController::class, 'checkCertificate'])->name('checkCertificate');
Route::get('/more', [App\Http\Controllers\MoreController::class, 'index'])->name('more');
Route::get('/pelatihan/{id}', [PelatihanController::class, 'pelatihan']);
