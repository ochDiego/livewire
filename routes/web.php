<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MostrarEmpleados;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('empleados',MostrarEmpleados::class)->middleware('can:empleados.index')->name('empleados.index');

Route::get('export',[ExportController::class,'export'])->name('export');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
