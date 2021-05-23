@extends('base')

@section('title')
<title>Detail</title>
@endsection

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="row my-4">
            <div class="col-lg-4 mx-4 mt-3">
                <div id="demo" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                      <li data-target="#demo" data-slide-to="0" class="active"></li>
                      <?php
                      for($i = 1; $i <= $countimage; $i++){
                        echo "<li data-target='#demo' data-slide-to='$i'></li>";
                      }
                      ?>
                    </ul>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ asset('/productimages') }}/{{ $product['product_thumb'] }}" alt="Denim Jeans" style="width: 100%; height: 550px;" class="mb-2">
                      </div>
                      @foreach ($image as $image)
                      <div class="carousel-item">
                        <img src="{{ asset('/productimages') }}/{{ $image['image_name'] }}" alt="Denim Jeans" style="width: 100%; height: 550px;" class="mb-2">
                      </div>
                      @endforeach
                    </div>
                  </div>
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-4 mx-4 mt-3">
                <h1>{{ $product['product_name'] }}</h1>
                <br>
                    @if($product['product_quantity'] == 0)
                      <h4 class="text-danger">Out of Stock</h4>
                    @elseif($product['product_quantity'] < 6)
                      <h4 class="text-danger">Only {{ $product['product_quantity']}} Left</h4>
                    @else
                      <h4>In Stock</h4>
                    @endif
                <br>
                <form method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product['product_id'] }}">
                    <div class="form-group">
                    <label for="sel1">Color:</label>
                    <select class="form-control" name="color_id" style="width: 120px;">
                        @foreach ($color as $color)
                        <option value="{{ $color['color_id'] }}">{{ $color['color_name'] }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="sel1">Size:</label>
                    <select class="form-control" name="size_id" style="width: 120px;">
                        @foreach ($size as $size)
                        <option value="{{ $size['size_id'] }}">{{ $size['size_name'] }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="sel1">Quantity:</label>
                    <select class="form-control" name="quantity" style="width: 120px;">
                        @for ($i = 1; $i <= 10; $i++)
                        <option>{{ $i }}</option>
                        @endfor
                    </select>
                    </div>
                    <h4><strong>Price:</strong> {{ $product['product_price'] }}/-</h4>
                    <br>
                    <button type="submit" formaction="/buynow" class="btn">Buy Now</button>
                    <button type="submit" formaction="/addtocart" class="btn">Add To Cart</button>
                </form>
            </div>
        </div>
        <div class="mx-4">
            <p><strong>Description:</strong> {{ $product['product_description'] }}</p>
        </div>
    </div>
</div>
@endsection
