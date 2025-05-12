<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationData;
use Symfony\Contracts\Service\Attribute\Required;

class AccountController extends Controller
{
    public function index(){
        request()->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        return view('accounts.index');
    }
    public function edit(){
        return view('accounts.edit');
    }
    public function create(){
        return view('accounts.create');
    }
    public function show($id){
        // $email=request()->email;
        // $password=request()->password;

        // $user=User::where('email',$email)->first();
        // return $id;
    }
}
