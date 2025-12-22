<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    //Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('/tickets/create', [TicketController::class, 'create'])
        ->name('tickets.create');

    //Tickets Routes
    Route::get('/tickets', [TicketController::class, 'index'])
        ->name('tickets.index');
    Route::post('/tickets', [TicketController::class, 'store'])
        ->name('tickets.store');
    Route::patch('/tickets/{ticket}/status',
        [TicketController::class, 'updateStatus']
        )->name('tickets.updateStatus');
    
    //User Routes
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');    
    Route::patch('/profile', [UserController::class, 'update_profile'])
        ->name('profile.update');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])
    ->name('users.updateRole');


    //User Invitation
    Route::get('/users/invite', [UserController::class, 'create'])
        ->name('users.invite');

    Route::post('/users/invite', [UserController::class, 'store'])
        ->name('users.store');
});

require __DIR__.'/auth.php';
