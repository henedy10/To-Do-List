@extends('layouts.app')

@section('title') Login @endsection
@section('content')
<form class="p-5" style="border: solid red 2px" action="{{route('accounts.check')}}" method="get">
    @csrf
    <div class="mb-3" >
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <div class="mb-5">
        <button type="submit" class="btn btn-primary mb-3" style="width: 100%">Login</button>
        <span>Forget Password ? <a href="{{route('accounts.edit')}}">Click Here</a></span>
    </div>
    <div>
        <span style=" display:block; text-align:center">Not a member yet? <a href="{{route('accounts.create')}}">Sign Up</a></span>
    </div>
</form>
</div>
@endsection
