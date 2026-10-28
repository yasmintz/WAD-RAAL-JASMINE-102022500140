<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenerbitSupplierController;

Route::get('/', function () {
    return redirect()->route('penerbit.index');
});

Route::resource('penerbit', PenerbitSupplierController::class)->except('show');
Route::patch('penerbit/{penerbit}/status', [PenerbitSupplierController::class, 'updateStatus'])->name('penerbit.status');