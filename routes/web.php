<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as EventAdminController;
use App\Http\Controllers\Admin\PartnerController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

Route::get('/tentang', function () {
    return '<h1>Ini adalah Halaman Tentang Aplikasi Event Hub</h1>';
});

Route::get('/kontak', function () { return view('contact'); });
Route::get('/profile', function () { return view('profile'); });
Route::get('/katalog', function () { return view('katalog'); });
Route::get('/bantuan', function () { return view('bantuan'); });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/events', [EventAdminController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventAdminController::class, 'create'])->name('events.create');
    Route::post('/events/store', [EventAdminController::class, 'store'])->name('events.store');
    Route::get('/events/edit/{id}', [EventAdminController::class, 'edit'])->name('events.edit');
    Route::put('/events/update/{id}', [EventAdminController::class, 'update'])->name('events.update');
    Route::delete('/events/delete/{id}', [EventAdminController::class, 'destroy'])->name('events.destroy');
    Route::get('/transactions', [DashboardController::class, 'transactions'])->name('transactions.index');
    Route::resource('categories', CategoryController::class);
    Route::resource('partners', PartnerController::class);
});