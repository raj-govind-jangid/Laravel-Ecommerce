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
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('title')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Ecommerce Panel</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="/admin">Home</a>
                </li>
                <li>
                    <a href="#productSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Product</a>
                    <ul class="collapse list-unstyled" id="productSubmenu">
                        <li>
                            <a href="/admin/product">All Product</a>
                        </li>
                        <li>
                            <a href="/admin/createproduct">Create Product</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#categorySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Category</a>
                    <ul class="collapse list-unstyled" id="categorySubmenu">
                        <li>
                            <a href="/admin/category">All Category</a>
                        </li>
                        <li>
                            <a href="/admin/createcategory">Create Category</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#subcategorySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">SubCategory</a>
                    <ul class="collapse list-unstyled" id="subcategorySubmenu">
                        <li>
                            <a href="/admin/subcategory">All SubCategory</a>
                        </li>
                        <li>
                            <a href="/admin/createsubcategory">Create SubCategory</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#orderSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Order</a>
                    <ul class="collapse list-unstyled" id="orderSubmenu">
                        <li>
                            <a href="/admin/orderlist">All Order</a>
                        </li>
                        <li>
                            <a href="/admin/activeorderlist">Active Order</a>
                        </li>
                        <li>
                            <a href="/admin/pendingorderlist">Pending Order</a>
                        </li>
                        <li>
                            <a href="/admin/deliveredorderlist">Delivered Order</a>
                        </li>
                        <li>
                            <a href="/admin/rejectorderlist">Rejected Order</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">User</a>
                    <ul class="collapse list-unstyled" id="userSubmenu">
                        <li>
                            <a href="/admin/user">All User</a>
                        </li>
                        <li>
                            <a href="/admin/createuser">Create User</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/logout">Logout</a>
                </li>
            </ul>
            <ul class="list-unstyled CTAs">
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <button type="button" id="sidebarCollapse" class="btn">
                <i class="fas fa-align-left"></i>
                <span>Toggle Sidebar</span>
            </button>
            <div>@include('alert')</div>
            @yield('content')
        </div>
    </div>
</body>
<script src="{{ asset('js/javascript.js') }}"></script>
</html>
