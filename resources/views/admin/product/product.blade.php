@extends('adminbase')

@section('title')
<title>Product Lists</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Product Lists</h1>
      <h4 class="lead mb-0" style="font-size: 30px;">Total Result : {{ $totalproduct }}</h4>
    </header>
    <div class="row py-5">
      <div class="col-lg-12 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <a href="/admin/createproduct" class="btn mb-4 mr-auto">Create Product</a>
            <a href class="btn mb-4 mr-auto" data-toggle="modal" data-target="#myModal">Search Filter</a>
            <div class="table-responsive">
              <table id="example" style="width:100%" class="table table-striped text-center">
                <thead style="background-color: rgb(106, 90, 205); color: #fff;">
                    <tr>
                        <th>Image</th>
                        <th>Brand Name</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $product)
                    <tr>
                      <td><img style="width: 70px; height: 150px;" src="{{ asset('/productimages') }}/{{ $product['product_thumb'] }}"> </td>
                      <td>{{ $product['product_brand_name'] }}</td>
                      <td>{{ $product['product_name'] }}</td>
                      <td>{{ $product['product_quantity'] }}</td>
                      <td>{{ $product['product_price'] }}</td>
                      <td>{{ $product['product_status'] }}</td>
                      <td>
                        <a href="/admin/editproduct/{{ $product['product_id'] }}"><img src="https://img.icons8.com/android/452/edit.png" width="25px"></a>
                        <a href="/admin/deleteproduct/{{ $product['product_id'] }}"><img src="https://img.icons8.com/metro/344/trash.png" width="25px"></a>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="table-responsive">
                <ul class="pagination">
                    @if($page >= 2)
                    <li class="page-item"><a class="page-link" href="/admin/product/{{ $page-1 }}">Previous</a></li>
                    @endif
                    @for($i = 1; $i <= $number_of_page; $i++)
                    @if($page == $i)
                    <li class="page-item active"><a class="page-link" href="/admin/product/{{ $i }}">{{$i}}</a></li>
                    @continue
                    @endif
                    <li class="page-item"><a class="page-link" href="/admin/product/{{ $i }}">{{$i}}</a></li>
                    @endfor
                    @if($page < $number_of_page)
                    <li class="page-item"><a class="page-link" href="/admin/product/{{ $page+1 }}">Next</a></li>
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
          <h4 class="modal-title">Search Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="/admin/searchproduct" method="GET">
                <div class="form-group">
                  <label>Brand Name</label>
                  <input type="text" class="form-control" placeholder="Enter Brand Name" name="brandname">
                </div>
                <div class="form-group">
                  <label>Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" name="name">
                </div>
                <div class="form-group">
                  <label>Status:</label>
                  <select class="form-control" name="status">
                      <option value="All">All</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                  </select>
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
