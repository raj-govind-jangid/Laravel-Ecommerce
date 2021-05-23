@extends('adminbase')

@section('title')
<title>Edit Order</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Edit Order</h1>
    </header>
    <div class="row py-4">
      <div class="col-lg-12 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/orderupdate" method="POST">
                    @csrf
                    <div class="row">
                    <div class="col-md-6">
                      <input type="hidden" name="id" value="{{ $order['order_id'] }}">
                    <div class="form-group">
                      <label>First Name:</label>
                      <input type="text" class="form-control" name="firstname" value="{{ $order['order_first_name'] }}" required>
                    </div>
                    <div class="form-group">
                      <label>Last Name:</label>
                      <input type="text" class="form-control" name="lastname" value="{{ $order['order_last_name'] }}" required>
                    </div>
                    <div class="form-group">
                      <label>Phone Number:</label>
                      <input type="text" class="form-control" name="phoneno" value="{{ $order['order_phoneno'] }}" required>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Shipping Address:</label>
                        <textarea class="form-control" rows="4" name="shipping_address"  required>{{ $order['order_shipping_address'] }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Order Status:</label>
                        <select class="form-control" name='status'>
                            @if($order['order_status'] == "Active")
                            <option value="Active" selected>Active</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Pending">Pending</option>
                            <option value="Rejected">Rejected</option>
                            @elseif($order['order_status'] == "Delivered")
                            <option value="Active">Active</option>
                            <option value="Delivered" selected>Delivered</option>
                            <option value="Pending">Pending</option>
                            <option value="Rejected">Rejected</option>
                            @elseif($order['order_status'] == "Pending")
                            <option value="Active">Active</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Pending" selected>Pending</option>
                            <option value="Rejected">Rejected</option>
                            @elseif($order['order_status'] == "Rejected")
                            <option value="Active">Active</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Pending">Pending</option>
                            <option value="Rejected" selected>Rejected</option>
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

@endsection
