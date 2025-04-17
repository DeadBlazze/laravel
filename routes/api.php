<?php

use App\Http\Controllers\RecordController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/auth', [AuthController::class, 'auth']);

Route::get('/getRecords', [RecordController::class, 'getRecords'])->middleware(AuthMiddleware::class);
Route::post('/setRecord', [RecordController::class, 'setRecord'])->middleware(AuthMiddleware::class);

