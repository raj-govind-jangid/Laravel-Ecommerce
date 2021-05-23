@extends('base')

@section('title')
<title>Order</title>
<style>
    body{
        color: rgb(106, 90, 205) !important;
    }
</style>
@endsection

@section('content')
<div class="container text-center">
    <div class="card shadow">
    <h1 class="my-3">Your Order</h1>
    <hr>
    <div class="row my-1" style="background-color: rgb(106, 90, 205); color: #fff;">
        <div class="col-4">
            <h3>Product</h3>
        </div>
        <div class="col-4">
            <h3>Quantity</h3>
        </div>
        <div class="col-4">
            <h3>Total Price</h3>
        </div>
    </div>
    <hr>
    @if (isset($order) && count($order) > 0)
    @foreach ($order as $order)
    <div class="row my-3">
        <div class="col-4">
            <img src="{{ asset('productimages') }}/{{ $order['product_thumb'] }}" width="35px" height="50px">
            <h4><strong>{{ $order['product_name'] }}</strong></h4>
            <p><strong>Price: {{ $order['product_price'] }}/-</strong></p>
            <p><strong>Your Order Status is {{ $order['order_status'] }}</strong></p>
        </div>
        <div class="col-4">
            <br>
            <br>
            <p>
            <strong style="font-size: 25px;"> {{ $order['order_quantity'] }} </strong>
            </p>
            <br>
        </div>
        <div class="col-4">
            <br>
            <br>
            <h4><strong>&#8377;</strong> {{ $order['order_total_price'] }}/-</h2>
        </div>
    </div>
    <hr>
    @endforeach
    @else
    <div><h2>Your Order List Is Empty</h2></div>
    <br>
    @endif
    <div class="row my-1" style="background-color: rgb(106, 90, 205); color: #fff;">

    </div>
    <br>
    </div>
    </div>
</div>
<br>
<br>
<br>
@endsection
