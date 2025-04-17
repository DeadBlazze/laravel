<?php

use App\Http\Controllers\RecordController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [AuthController::class, 'register']);

Route::get('/getRecords', [RecordController::class, 'getRecords']);

