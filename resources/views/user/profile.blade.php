@extends('base')

@section('title')
<title>Profile Details</title>
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<script src="{{ asset('js/form.js') }}"></script>
@endsection

@section('content')
<div class="login-form">
    <form action="" method="post">
        @csrf
        <h2 class="text-center">Profile Details</h2>
        <input type="hidden" class="form-control" placeholder="id" name="id" value="{{ $user['user_id'] }}" required>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $user['user_name'] }}" required>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $user['user_email'] }}" required>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" placeholder="Number" name="number" value="{{ $user['user_phoneno'] }}" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block">Update Profile</button>
        </div>
    </form>
    <p class="text-center"><a href="/changeuserpassword">Change Password</a></p>
</div>
@endsection
