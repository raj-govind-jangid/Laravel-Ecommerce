@extends('adminbase')

@section('title')
<title>Edit SubCategory</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Edit SubCategory</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/updatesubcategory" method="POST">
                    @csrf
                    <input type="hidden" name="subcategory_id" value="{{ $subcategory['subcategory_id'] }}">
                    <div class="form-group">
                        <label>Category Name:</label>
                        <select class="form-control" name='category_id'>
                            <option value="{{$subcategory['subcategory_category_id']}}" selected>{{$subcategory['category_name']}}</option>
                            @foreach ($category as $category)
                            @if($category['category_id'] == $subcategory['subcategory_category_id'])
                            @continue
                            @endif
                            <option value="{{$category['category_id']}}">{{$category['category_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Subcategory Name:</label>
                        <input type="text" class="form-control" name="subcategory_name" value="{{ $subcategory['subcategory_name'] }}" required>
                    </div>
                    <button type="submit" class="btn">Update SubCategory</button>
                  </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
