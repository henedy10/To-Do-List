<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/',[AccountController::class,'index'])->name('accounts.index');
Route::get('/accounts/edit',[AccountController::class,'edit'])->name('accounts.edit');
Route::get('/accounts/create', [AccountController::class,'create'])->name('accounts.create');
Route::get('/accounts',[AccountController::class,'check'])->name('accounts.check');
Route::put('/accounts',[AccountController::class,'update'])->name('accounts.update');
Route::post('/accounts',[AccountController::class,'store'])->name('accounts.store');
