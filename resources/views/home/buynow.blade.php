@extends('base')

@section('title')
<title>Place Order</title>
@endsection

@section('content')
<div class="container">
    <div class="cart shadow bg-white p-4">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="text-center">Place Order</h2>
                <form action="/placeorder" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product['product_id'] }}">
                    <input type="hidden" name="color_id" value="{{ $color['color_id'] }}">
                    <input type="hidden" name="size_id" value="{{ $size['size_id'] }}">
                    <input type="hidden" name="quantity_id" value="{{ $quantity }}">
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
                    <button type="submit" class="btn">Place Order</button>
                  </form>
            </div>
            <div class="col-lg-6">
                <h3 class="text-center">Product Detail</h3>
                <div class="row">
                    <div class="col-lg-4">
                        <br>
                    <img src="{{ asset('/productimages') }}/{{ $product['product_thumb'] }}" alt="Denim Jeans" style="width: 60%; height: 200px;" class="mb-2">
                    </div>
                    <div class="col-lg-8">
                        <br>
                        <h3>{{ $product['product_name'] }}</h3>
                        <br>
                        <p><strong>Color: </strong>{{ $color['color_name'] }}</p>
                        <br>
                        <p><strong>Size: </strong>{{ $size['size_name'] }}</p>
                        <br>
                        <p><strong>Quantity: </strong>{{ $quantity }}</p>
                        <br>
                        <h2>Total Price: {{ $totalprice }}/-</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
