<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\ClientPetController;
use App\Http\Controllers\Client\AppointmentController as ClientAppointmentController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\QRCodeController;  // <-- ADD THIS

Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('pets/{pet}/medical-records/create', [\App\Http\Controllers\Vet\MedicalRecordController::class, 'create'])->name('vet.medical-records.create');
    Route::post('pets/{pet}/medical-records', [\App\Http\Controllers\Vet\MedicalRecordController::class, 'store'])->name('vet.medical-records.store');
    Route::get('medical-records/{medicalRecord}/edit', [\App\Http\Controllers\Vet\MedicalRecordController::class, 'edit'])->name('vet.medical-records.edit');
    Route::put('medical-records/{medicalRecord}', [\App\Http\Controllers\Vet\MedicalRecordController::class, 'update'])->name('vet.medical-records.update');
    Route::delete('medical-records/{medicalRecord}', [\App\Http\Controllers\Vet\MedicalRecordController::class, 'destroy'])->name('vet.medical-records.destroy');

    // Reports
    Route::get('/reports/today-appointments', [ReportController::class, 'todayAppointments'])
        ->name('admin.reports.today-appointments');
    Route::get('/reports/pets-multiple-records', [ReportController::class, 'petsWithMultipleRecords'])
        ->name('admin.reports.pets-multiple-records');

    // QR Code download for admin
    Route::get('/pets/{pet}/qrcode-png', [QRCodeController::class, 'downloadAdminPng'])
        ->name('admin.pets.qrcode-png');
});

// PDF download routes
Route::middleware(['auth'])->group(function () {
    Route::get('/client/appointments/{appointment}/pdf', [PDFController::class, 'downloadAppointmentReceipt'])
        ->name('client.appointments.pdf')
        ->middleware('role:Client');

    Route::get('/admin/reports/appointments/pdf', [PDFController::class, 'downloadAppointmentsReport'])
        ->name('admin.reports.appointments.pdf')
        ->middleware('role:Admin|Vet');

    Route::get('/admin/reports/pets-multiple-records/pdf', [PDFController::class, 'downloadPetsMultipleRecordsReport'])
        ->name('admin.reports.pets-multiple-records.pdf')
        ->middleware('role:Admin|Vet');
});

// Client group
Route::middleware(['auth', 'role:Client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
    Route::resource('pets', ClientPetController::class);
    Route::resource('appointments', ClientAppointmentController::class);

    // QR Code download for client
    Route::get('/pets/{pet}/qrcode-png', [QRCodeController::class, 'downloadClientPng'])
        ->name('client.pets.qrcode-png');
});

require __DIR__.'/auth.php';
