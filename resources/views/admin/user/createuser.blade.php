@extends('adminbase')

@section('title')
<title>Create User</title>
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
                <form action="/admin/createuser" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Email address:</label>
                      <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                      <label>Full Name:</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number:</label>
                        <input type="number" class="form-control" name="phoneno" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name='type'>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">Create User</button>
                  </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
