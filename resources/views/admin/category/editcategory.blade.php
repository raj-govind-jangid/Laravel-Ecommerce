@extends('adminbase')

@section('title')
<title>Edit Category</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Edit Category</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/updatecategory" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $category['category_id'] }}">
                    <div class="form-group">
                      <label>Category Name:</label>
                      <input type="text" class="form-control" name="category" value="{{ $category['category_name'] }}" required>
                    </div>
                    <button type="submit" class="btn">Update Category</button>
                  </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
