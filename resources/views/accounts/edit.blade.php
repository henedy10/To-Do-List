@extends('layouts.app')

@section('title') Update @endsection
@section('content')
<form class="p-5" style="border: solid red 2px;width:25%" action="{{route('accounts.update')}}" method="POST">
    @method('PUT')
    @csrf
    <div class="mb-3" >
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">New_Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Confirm_Password</label>
        <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-5">
        <button type="submit" class="btn btn-primary mb-3" style="width: 100%">Update</button>
        <a href="{{route('accounts.index')}}">Back</a>
    </div>
</form>
</div>
@endsection
