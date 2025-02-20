<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CRUDControler;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'loginpage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/tasks/create', [CRUDControler::class, 'getcreate'])->name('tasks.create');

    Route::post('/tasks/store', [CRUDControler::class, 'store'])->name('tasks.store')->middleware('auth');
    Route::delete('/tasks/{id}', [CRUDControler::class, 'destroy'])->name('tasks.destroy');

    Route::get('/tasks/{id}/edit', [CRUDControler::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [CRUDControler::class, 'update'])->name('tasks.update');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    ////apii router
    Route::post('/logout', [TaskController::class, 'logout']);
    Route::get('/tasks', [TaskController::class, 'index']); // Get all tasks
    Route::post('/tasks', [TaskController::class, 'store']); // Create task
    Route::get('/tasks/{id}', [TaskController::class, 'show']); // Get task by ID
    Route::put('/tasks/{id}', [TaskController::class, 'update']); // Update task
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']); // Delete tas

});
