<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()  {
        return view('accounts.index');
    }
    public function edit(){
        return view('accounts.edit');
    }
    public function create(){
        return view('accounts.create');
    }
}
