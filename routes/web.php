<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\ClientPetController;
use App\Http\Controllers\Client\AppointmentController as ClientAppointmentController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;

Route::get('/', function () {
    return view('welcome');
});

// Role-based dashboard redirection
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('Admin')) {
        return redirect()->route('admin.dashboard');
    }
    if (auth()->user()->hasRole('Vet')) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('client.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin group (Admin & Vet roles)
Route::middleware(['auth', 'role:Admin|Vet'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('pets', \App\Http\Controllers\Admin\PetController::class)->names('admin.pets');
    Route::resource('appointments', AdminAppointmentController::class)->names('admin.appointments');
});

// Client group (only role Client)
Route::middleware(['auth', 'role:Client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
    Route::resource('pets', ClientPetController::class);
    Route::resource('appointments', ClientAppointmentController::class);
});

require __DIR__.'/auth.php';
