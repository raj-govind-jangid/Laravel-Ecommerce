@extends('adminbase')

@section('title')
<title>Create SubCategory</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Create SubCategory</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/createsubcategory" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Category Name:</label>
                        <select class="form-control" name='category_id'>
                            @foreach ($category as $category)
                            <option value="{{$category['category_id']}}">{{$category['category_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Subcategory Name:</label>
                      <input type="text" class="form-control" name="subcategory_name" placeholder="Enter SubCategory" required>
                    </div>
                    <button type="submit" class="btn">Create SubCategory</button>
                  </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
