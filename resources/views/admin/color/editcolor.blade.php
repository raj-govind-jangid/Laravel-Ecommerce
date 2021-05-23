@extends('adminbase')

@section('title')
<title>Edit Color</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Edit Color</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/updatecolor" method="POST">
                    @csrf
                    <input type="hidden" name="color_id" value="{{ $color['color_id'] }}">
                    <div class="form-group">
                        <label>Color Name:</label>
                        <input type="text" class="form-control" name="color_name" value="{{ $color['color_name'] }}" required>
                    </div>
                    <button type="submit" class="btn">Update Color</button>
                  </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
