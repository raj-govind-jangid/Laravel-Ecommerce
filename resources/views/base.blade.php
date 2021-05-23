<?php
use App\Http\Controllers\HomeController;
$cartitem = HomeController::cartitem();
$categorylist = HomeController::categorylist();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <script src="{{ asset('js/base.js') }}"></script>

    @yield('title')
</head>
<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <div class="container">
        <a class="navbar-brand" href="/">Ecommerce</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item dropdown dmenu">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Category</a>
                <div class="dropdown-menu sm-menu">
                  <a class="dropdown-item" href="/category">All Category</a>
                  @foreach($categorylist as $categorylist)
                  <a class="dropdown-item" href="/category/{{ $categorylist['category_id'] }}">{{ $categorylist['category_name'] }}</a>
                  @endforeach
                </div>
            </li>
            @if (session()->get('user'))
            <li class="nav-item">
              <a class="nav-link" href="/profile">Hi, {{ session()->get('user')['user_name'] }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cart">
                  <span><img src="https://img.icons8.com/fluent-systems-regular/452/fast-cart.png" alt="Fast Cart icon" loading="lazy" width="25px"></span>
                  <span class="badge badge-pill bg-warning">{{ $cartitem }}</span>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/order">My Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/logout">Logout</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/register">Register</a>
            </li>
            @endif

          </ul>
        </div>
        </div>
      </nav>
      @include('alert')
      <div class="maindiv" style="margin-top: 100px;">
        @yield('content')
      </div>
</body>
<script src="{{ asset('js/javascript.js') }}"></script>
</html>
