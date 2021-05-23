<?php
use App\Http\Controllers\UserController;
?>

@extends('adminbase')

@section('title')
<title>User Lists</title>
@endsection

@section('content')

<div class="container">
    <header class="text-center">
      <h1 class="display-4">User Lists</h1>
      <h4 class="lead mb-0" style="font-size: 30px;">Total Result : {{ $totaldata }}</h4>
    </header>
    <div class="row py-5">
      <div class="col-lg-12 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <a href="/admin/createuser" class="btn mb-4 mr-auto">Create User</a>
            <a href class="btn mb-4 mr-auto" data-toggle="modal" data-target="#myModal">Search Filter</a>
            <div class="table-responsive">
              <table id="example" style="width:100%" class="table table-striped text-center">
                <thead style="background-color: rgb(106, 90, 205); color: #fff;">
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $user)
                    <tr>
                      <td>{{ $user['user_email'] }}</td>
                      <td>{{ $user['user_name'] }}</td>
                      <td>{{ $user['user_phoneno'] }}</td>
                      <td>{{ $user['user_type'] }}</td>
                      <td><b><?php echo UserController::userstatus($user['user_email']) ?></b></td>
                      <td>
                        <a href="/admin/edituser/{{ $user['user_id'] }}"><img src="https://img.icons8.com/android/452/edit.png" width="25px"></a>
                        <a href="/admin/deleteuser/{{ $user['user_id'] }}"><img src="https://img.icons8.com/metro/344/trash.png" width="25px"></a>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <div>
            <ul class="pagination">
                @if($page >= 2)
                <li class="page-item"><a class="page-link" href="/admin/searchuser/{{ $page-1 }}?email={{$email}}&name={{$name}}&phoneno={{$phoneno}}">Previous</a></li>
                @endif
                @for($i = 1; $i <= $number_of_page; $i++)
                @if($page == $i)
                <li class="page-item active"><a class="page-link" href="/admin/searchuser/{{ $i }}?email={{$email}}&name={{$name}}&phoneno={{$phoneno}}">{{$i}}</a></li>
                @continue
                @endif
                <li class="page-item"><a class="page-link" href="/admin/searchuser/{{ $i }}?email={{$email}}&name={{$name}}&phoneno={{$phoneno}}">{{$i}}</a></li>
                @endfor
                @if($page < $number_of_page)
                <li class="page-item"><a class="page-link" href="/admin/searchuser/{{ $page+1 }}?email={{$email}}&name={{$name}}&phoneno={{$phoneno}}">Next</a></li>
                @endif
            </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Search User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="/admin/searchuser" method="GET">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" placeholder="Enter Email ID" name="email">
                </div>
                <div class="form-group">
                  <label>Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="name">
                </div>
                <div class="form-group">
                  <label>Phone Number:</label>
                  <input type="text" class="form-control" placeholder="Enter Phone Number" name="phoneno">
                </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn">Apply Search</button>
          </form>
          <button type="button" class="btn" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

@endsection
