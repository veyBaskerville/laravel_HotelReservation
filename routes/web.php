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


use App\Http\Controllers\AdminController;

Route::get('/admin-login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin-login', [AdminController::class, 'login'])->name('admin.login');
// Route::post('/admin/add-reservation', [AdminController::class, 'addReservation'])->name('admin.add.reservation');
// Route::post('/admin/edit-reservation', [AdminController::class, 'editReservation'])->name('admin.edit.reservation');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// / Reservation Routes
Route::post('/admin/reservations/add', [AdminController::class, 'addReservation'])->name('admin.reservations.add');
Route::post('/admin/reservations/edit', [AdminController::class, 'editReservation'])->name('admin.reservations.edit');
Route::delete('/admin/reservations/delete/{id}', [AdminController::class, 'deleteReservation'])->name('admin.reservations.delete');
// Route::get('/admin/reservations/{id}', [AdminController::class, 'getReservation'])->name('admin.reservations.get');

