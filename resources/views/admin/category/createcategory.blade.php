@extends('adminbase')

@section('title')
<title>Create Category</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Create Category</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/createcategory" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Category Name:</label>
                      <input type="text" class="form-control" name="category" placeholder="Enter Category" required>
                    </div>
                    <button type="submit" class="btn">Create Category</button>
                  </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
