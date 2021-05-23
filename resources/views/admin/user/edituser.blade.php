@extends('adminbase')

@section('title')
<title>Edit User</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Create User</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/updateuser" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user['user_id'] }}">
                    <div class="form-group">
                      <label>Email address:</label>
                      <input type="email" class="form-control" name="email" value="{{ $user['user_email'] }}" required disabled>
                    </div>
                    <div class="form-group">
                      <label>Full Name:</label>
                      <input type="text" class="form-control" name="name" value="{{ $user['user_name'] }}" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number:</label>
                        <input type="number" class="form-control" name="phoneno" value="{{ $user['user_phoneno'] }}" required>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name='type'>
                            @if($user['user_type']=='User')
                            <option value="User" selected>User</option>
                            <option value="Admin">Admin</option>
                            @elseif($user['user_type']=='Admin')
                            <option value="Admin" selected>Admin</option>
                            <option value="User" selected>User</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn">Update User</button>
                    <a href="/admin/changepassword/{{$user['user_id']}}" class="btn">Change Password</a>
                  </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
