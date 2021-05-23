@extends('adminbase')

@section('title')
<title>Home</title>
@endsection

@section('content')
<div class="container-fluid">
<div class="row m-3 mt-4 text-center">
    <div class="col-md-3">
        <div class="cart shadow p-2 bg-white">
            <h3>Active Order</h3>
            <p class="card-text">
                <h2>{{ $totalactive }}</h2>
                <a href="/admin/activeorderlist" class="btn">View More</a>
            </p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="cart shadow p-2 bg-white">
            <h3>Pending Order</h3>
            <p class="card-text">
                <h2>{{ $totalpending }}</h2>
                <a href="/admin/pendingorderlist" class="btn">View More</a>
            </p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="cart shadow p-2 bg-white">
            <h3>Delivered Order</h3>
            <p class="card-text">
                <h2>{{ $totaldelivered }}</h2>
                <a href="/admin/deliveredorderlist" class="btn">View More</a>
            </p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="cart shadow p-2 bg-white">
            <h3>Reject Order</h3>
            <p class="card-text">
                <h2>{{ $totalreject }}</h2>
                <a href="/admin/rejectorderlist" class="btn">View More</a>
            </p>
        </div>
    </div>
</div>

<div class="row m-3 mt-5 text-center">
    <div class="col-md-6">
        <div class="cart shadow p-3 bg-white">
            <h2>Active Order</h2>
            <table class="table mt-4 table-striped">
                <thead style="background-color: rgb(106, 90, 205); color: #fff;">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Shipping Address</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($activeorder) && count($activeorder) > 0)
                    @foreach ($activeorder as $activeorder)
                    <tr>
                        <td>{{ $activeorder['product_name'] }}</td>
                        <td>{{ $activeorder['order_quantity'] }}</td>
                        <td>{{ $activeorder['order_shipping_address'] }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3">No Active Order Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="cart shadow p-3 bg-white">
            <h2>Pending Order</h2>
            <table class="table mt-4 table-striped">
                <thead style="background-color: rgb(106, 90, 205); color: #fff;">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Shipping Address</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($pendingorder) && count($pendingorder) > 0)
                    @foreach ($pendingorder as $pendingorder)
                    <tr>
                        <td>{{ $pendingorder['product_name'] }}</td>
                        <td>{{ $pendingorder['order_quantity'] }}</td>
                        <td>{{ $pendingorder['order_shipping_address'] }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3">No Pending Order Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
@endsection
