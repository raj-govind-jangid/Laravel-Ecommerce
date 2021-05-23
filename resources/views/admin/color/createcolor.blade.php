@extends('adminbase')

@section('title')
<title>Add Color</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Add Color</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/createcolor" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $id }}">
                    <div class="form-group">
                      <label>Color Name:</label>
                      <input type="text" class="form-control" name="color_name" placeholder="Enter Color Name" required>
                    </div>
                    <button type="submit" class="btn">Add Color</button>
                  </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
