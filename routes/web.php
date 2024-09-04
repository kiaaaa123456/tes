<?php

use App\Http\Controllers\PendudukController;
use Illuminate\Support\Facades\Route;

Route::resource('penduduk', PendudukController::class);
