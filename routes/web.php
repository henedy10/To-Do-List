<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/',[AccountController::class,'index'])->name('accounts.index');
Route::get('/accounts/{account}/edit',[AccountController::class,'edit'])->name('accounts.edit');
Route::get('/accounts/create', [AccountController::class,'create'])->name('accounts.create');
Route::get('/accounts',[AccountController::class,'show'])->name('accounts.show');
