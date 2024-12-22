<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
  Route::get('/login', 'showLoginForm');
  Route::get('/register', 'showRegistrationForm');
  Route::get('/logout', 'logout')->name('logout');
  Route::post('/login', 'login')->name('login');
  Route::post('/register', 'register')->name('register');
});

Route::middleware('auth')->group(function () {
  Route::controller(TaskController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/tasks/history', 'history');
    Route::get('/tasks/filter', 'filter');
    Route::get('/task/share/{uuid}', 'share')->name('task.share')->withoutMiddleware('auth');
    Route::post('/task/create', 'create')->name('task.create');
    Route::post('/task/update/{task}', 'update');
    Route::post('/task/delete/{task}', 'delete');
    Route::post('/task/share/{task}', 'getSharableLink');
  });
});
