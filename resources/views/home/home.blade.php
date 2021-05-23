@extends('base')

@section('title')
<title>Ecommerce Home</title>
<link rel="stylesheet" href="{{ asset('css/productlist.css') }}">
@endsection

@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-10 mx-auto">
    <div class="row">
        @foreach ($product as $product)
        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="{{ asset('/productimages') }}/{{ $product['product_thumb'] }}" alt="Denim Jeans" style="width:100%; height: 300px;" class="mb-2">
                <h3>{{ $product['product_name'] }}</h3>
                <p class="price"> <strong>Price:</strong> {{ $product['product_price'] }}/-</p>
                <p><a href="/viewdetail/{{ $product['product_id'] }}" class="btn">View Details</a></p>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</div>
</div>
@endsection
