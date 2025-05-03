<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/company-profile', function () {
    return view('company-profile');
});
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

use App\Http\Controllers\ReservationController;

Route::get('/reservation', [ReservationController::class, 'create'])->name('reservation.form');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/billing/{id}', [ReservationController::class, 'billing'])->name('billing');
