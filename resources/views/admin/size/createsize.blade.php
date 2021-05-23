@extends('adminbase')

@section('title')
<title>Add Size</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Add Size</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/createsize" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $id }}">
                    <div class="form-group">
                      <label>Size Name:</label>
                      <input type="text" class="form-control" name="size_name" placeholder="Enter Size Name" required>
                    </div>
                    <button type="submit" class="btn">Add Size</button>
                  </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
