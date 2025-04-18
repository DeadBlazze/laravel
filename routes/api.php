<?php

use App\Http\Controllers\RecordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/auth', [AuthController::class, 'auth']);

Route::get('/get-records', [RecordController::class, 'getRecords'])->middleware(AuthMiddleware::class);
Route::post('/set-record', [RecordController::class, 'setRecord'])->middleware(AuthMiddleware::class);

Route::get('/admin-get-records', [AdminController::class, 'adminGetRecords'])->middleware(AuthMiddleware::class);
Route::post('/admin-update-status', [AdminController::class, 'adminUpdateStatus'])->middleware(AuthMiddleware::class);

