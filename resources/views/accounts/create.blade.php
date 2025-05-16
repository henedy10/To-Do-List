@extends('layouts.app')

@section('title') Sign up @endsection

@section('content')
<form class="p-5" style="border: solid red 2px" action="{{route('accounts.store')}}" method="POST">
    @csrf
    <div class="mb-3" >
        <label for="name" class="form-label">User Name</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp">
    </div>
    <div class="mb-3" >
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3" style="width: 100%">Submit</button>
    </div>
</form>
</div>
@endsection

