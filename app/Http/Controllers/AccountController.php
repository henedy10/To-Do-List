<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationData;
use Symfony\Contracts\Service\Attribute\Required;

class AccountController extends Controller
{
    public function index(){
        return view('accounts.index');
    }
    public function edit(){
        return view('accounts.edit');
    }
    public function create(){
        return view('accounts.create');
    }
    public function check(){
        $email=request()->email;
        $password=request()->password;
        request()->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $user=User::where('email',$email)
        ->where('password',$password)
        ->first();
        request()->validate([
            'email'=>'exists:users,email',
            'password'=>'exists:users,password'
        ]);
        if(!is_null($user)){
            return "hello ".$user->name;
        }
    }
public function update(){
    return 'hello';
}
}
