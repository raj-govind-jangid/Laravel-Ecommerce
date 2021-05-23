@extends('base')

@section('title')
<title>Cart</title>
<style>
    body{
        color: rgb(106, 90, 205) !important;
    }
</style>
@endsection

@section('content')
<div class="container text-center">
    <div class="card shadow">
    <h1 class="my-3">Your Cart</h1>
    <hr>
    <div class="row my-1" style="background-color: rgb(106, 90, 205); color: #fff;">
        <div class="col-4">
            <h3>Product</h3>
        </div>
        <div class="col-4">
            <h3>Quantity</h3>
        </div>
        <div class="col-4">
            <h3>Subtotal</h3>
        </div>
    </div>
    <hr>
    @if (isset($product) && count($product) > 0)
    @foreach ($product as $product)
    <div class="row my-3">
        <div class="col-4">
            <img src="{{ asset('productimages') }}/{{ $product['product_thumb'] }}" width="35px" height="50px">
            <h4><strong>{{ $product['product_name'] }}</strong></h4>
            <p><strong>Price: {{ $product['product_price'] }}/-</strong></p>
            <p><strong><a href="/removefromcart/{{ $product['cart_id'] }}" style="color:  rgb(106, 90, 205)">Remove</a></strong></p>
        </div>
        <div class="col-4">
            <p>
            <div><a href="/increasequantity/{{ $product['cart_id'] }}"><img src="https://img.icons8.com/metro/452/plus.png" width="25px"></a></div>
            <strong style="font-size: 25px;"> {{ $product['cart_product_quantity'] }} </strong>
            <div><a href="/decreasequantity/{{ $product['cart_id'] }}"><img src="https://img.icons8.com/metro/344/minus.png" width="25px"></a></div>
            </p>
        </div>
        <div class="col-4">
            <br>
            <br>
            <h4><strong>&#8377;</strong> {{ $product['cart_total_price'] }}/-</h2>
        </div>
    </div>
    <hr>
    @endforeach
    @else
    <div><h2>Your Cart Is Empty</h2></div>
    <br>
    @endif
    <div class="row my-1" style="background-color: rgb(106, 90, 205); color: #fff;">
        <div class="col-4">
            <h3>Total Amount</h3>
        </div>
        <div class="col-4">
        </div>
        <div class="col-4">
            <h3><strong>&#8377;</strong> {{  $totalprice }}/-</h3>
        </div>
    </div>
    <hr>
    <div style="color: black; text-align: left;" class="row p-2">
        <div class="col-md-6">
        <form action="/checkout" method="POST">
        @csrf
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" class="form-control" placeholder="Enter First Name" name="firstname">
          </div>
          <div class="form-group">
            <label>Last Name:</label>
            <input type="text" class="form-control" placeholder="Enter Last Name" name="lastname">
          </div>
          <div class="form-group">
            <label>Mobile Number:</label>
            <input type="text" class="form-control" placeholder="Enter Mobile Number" name="phoneno">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Shipping Address:</label>
            <textarea class="form-control" rows="5" name="shippingaddress">Enter Shipping Address</textarea>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="payment" value="COD" checked>Cash On Delivery
            </label>
          </div>
            <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="payment" value="ONLINE">Credit/Debit Or NetBanking
            </label>
          </div>
          <br>
          <br>
          <button type="submit" class="btn">Checkout All</button>
        </form>
        </div>
    </div>
    <br>
    </div>
</div>
<br>
<br>
<br>
@endsection
