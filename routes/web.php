<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[AccountController::class,'index'])->name('accounts.index');
Route::get('/accounts/{account}/edit',[AccountController::class,'edit'])->name('accounts.edit');
