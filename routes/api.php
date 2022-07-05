<?php

use App\Http\Controllers\RecorridosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('ingresarMovil', [RecorridosController::class, 'ingresarMovil'])->name('ingresarMovil');