@extends('adminbase')

@section('title')
<title>Change Password</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Create Password</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/changepassword" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user['user_id']}}">
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" name="confirmpassword" placeholder="Enter Confirm Password" required>
                    </div>
                    <button type="submit" class="btn">Change Password</button>
                </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

