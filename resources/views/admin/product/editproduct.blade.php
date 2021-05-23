@extends('adminbase')

@section('title')
<title>Edit Product</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Edit Product</h1>
    </header>
    <div class="row py-4">
      <div class="col-lg-12 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <a href="/admin/image/{{ $product['product_id'] }}" class="btn">Add\Remove Image</a>
            <a href="/admin/size/{{ $product['product_id'] }}" class="btn">Add\Remove Size</a>
            <a href="/admin/color/{{ $product['product_id'] }}" class="btn">Add\Remove Color</a>
            <hr>
            <div>
                <form action="/admin/updateproduct" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-md-6">
                      <input type="hidden" name="id" value="{{ $product['product_id'] }}">
                    <div class="form-group">
                      <label>Product Brand name</label>
                      <input type="text" class="form-control" name="brand_name" placeholder="Enter Product Brand Name" value="{{ $product['product_brand_name'] }}" required>
                    </div>
                    <div class="form-group">
                      <label>Product Name:</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Product Name" value="{{ $product['product_name'] }}" required>
                    </div>
                    <div class="form-group">
                        <label>Category Name:</label>
                        <select class="form-control" name='category_id'>
                            <option value="{{$product['product_category_id']}}" selected>{{$product['category_name']}}</option>
                            @foreach ($category as $category)
                            @if($product['product_category_id'] == $category['category_id'])
                            @continue
                            @else
                            <option value="{{$category['category_id']}}">{{$category['category_name']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>SubCategory Name:</label>
                        <select class="form-control" name='subcategory_id'>
                            <option value="{{$product['product_subcategory_id']}}" selected>{{$product['subcategory_name']}}</option>
                            @foreach ($subcategory as $subcategory)
                            @if($product['product_subcategory_id'] == $subcategory['subcategory_id'])
                            @continue
                            @else
                            <option value="{{$subcategory['subcategory_id']}}">{{$subcategory['subcategory_name']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Description:</label>
                        <textarea class="form-control" rows="4" name="description" placeholder="Enter Product Description" required>{{ $product['product_description'] }}</textarea>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Price:</label>
                        <input type="number" class="form-control" name="price" placeholder="Enter Product Price" value="{{ $product['product_price'] }}" required>
                    </div>
                    <div class="form-group">
                        <label>Product Quantity:</label>
                        <input type="number" class="form-control" name="quantity" placeholder="Enter Product Quantity" value="{{ $product['product_quantity'] }}" required>
                    </div>
                    <div class="form-group">
                        <label>Product Main Image:</label>
                        <input type="file" class="form-control" name="thumb" placeholder="Upload Product Image" onchange="previewFile(this)">
                        <img id="previewImg" src="{{ asset('/productimages') }}/{{ $product['product_thumb'] }}" alt="profile image" style="max-width: 130px; margin-top: 20px;" >
                    </div>
                    <div class="form-group">
                        <label>Product Status:</label>
                        <select class="form-control" name='status'>
                            @if ($product['product_status'] == "Active")
                            <option value="Active" selected>Active</option>
                            <option value="Inactive">Inactive</option>
                            @else
                            <option value="Active">Active</option>
                            <option value="Inactive" selected>Inactive</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn">Update Product</button>
                  </form>
                </div>
                </div>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
    function previewFile(input){
        var file=$("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $('#previewImg').attr("src",reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
