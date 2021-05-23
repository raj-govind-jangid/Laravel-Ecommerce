@extends('adminbase')

@section('title')
<title>Order Page</title>
@endsection

@section('content')
<div class="container-fluid">
    <header class="text-center">
      <h1 class="display-4">Order Lists</h1>
      <h4 class="lead mb-0" style="font-size: 30px;">Total Result : {{ $totalorder }}</h4>
    </header>
    <div class="row py-5">
      <div class="col-lg-12 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <button type="button" class="btn" data-toggle="modal" data-target="#myModal">Search Order</button>
            <br>
            <br>
            <div class="table-responsive">
              <table id="example" style="width:100%" class="table table-striped text-center">
                <thead style="background-color: rgb(106, 90, 205); color: #fff;">
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>User Email id</th>
                        <th>Order Quantity</th>
                        <th>Shipping Address</th>
                        <th>Payment Method</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($order) && count($order) > 0)
                    @foreach ($order as $order)
                    <tr>
                        <td>{{ $order['order_id'] }}</td>
                        <td>{{ $order['product_name'] }}</td>
                        <td>{{ $order['user_email'] }}</td>
                        <td>{{ $order['order_quantity'] }}</td>
                        <td>{{ $order['order_shipping_address'] }}</td>
                        <td>{{ $order['order_payment_method'] }}</td>
                        <td><?php echo date('d-m-Y', strtotime($order['order_date']));?></td>
                      <td>
                        <a href="/admin/acceptorder/{{ $order['order_id'] }}"><img src="https://img.icons8.com/metro/344/checkmark.png" width="25px"></a>
                        <a href="/admin/rejectorder/{{ $order['order_id'] }}"><img src="https://img.icons8.com/metro/344/multiply.png" width="25px"></a>
                        <a href="/admin/orderdetail/{{ $order['order_id'] }}"><img src="https://img.icons8.com/material/344/view-file--v1.png" width="25px"></a>
                        <a href="/admin/orderedit/{{ $order['order_id'] }}"><img src="https://img.icons8.com/android/452/edit.png" width="25px"></a>
                        <a href="/admin/orderdelete/{{ $order['order_id'] }}"><img src="https://img.icons8.com/metro/344/trash.png" width="25px"></a>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <td colspan="8">No Order Found</td>
                    @endif
                </tbody>
              </table>
            </div>
            <div class="table-responsive">
                <ul class="pagination">
                    @if($page >= 2)
                    <li class="page-item"><a class="page-link" href="/admin/orderlist/{{ $page-1 }}">Previous</a></li>
                    @endif
                    @for($i = 1; $i <= $number_of_page; $i++)
                    @if($page == $i)
                    <li class="page-item active"><a class="page-link" href="/admin/orderlist/{{ $i }}">{{$i}}</a></li>
                    @continue
                    @endif
                    <li class="page-item"><a class="page-link" href="/admin/orderlist/{{ $i }}">{{$i}}</a></li>
                    @endfor
                    @if($page < $number_of_page)
                    <li class="page-item"><a class="page-link" href="/admin/orderlist/{{ $page+1 }}">Next</a></li>
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
          <h4 class="modal-title">Search User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="/admin/searchorderlist" method="GET">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" placeholder="Enter Email ID" name="email">
                </div>
                <div class="form-group">
                  <label>Product Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="productname">
                </div>
                <div class="form-group">
                  <label>Shipping Address:</label>
                  <input type="text" class="form-control" placeholder="Enter Phone Number" name="shippingaddress">
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

