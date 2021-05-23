@extends('adminbase')

@section('title')
<title>Category</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Category Lists</h1>
      <h4 class="lead mb-0" style="font-size: 30px;">Total Result : {{ $totalcategory }}</h4>
    </header>
    <div class="row py-5">
      <div class="col-lg-12 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <a href="/admin/createcategory" class="btn mb-4 mr-auto">Create Category</a>
            <div class="table-responsive">
              <table id="example" style="width:100%" class="table table-striped text-center">
                <thead style="background-color: rgb(106, 90, 205); color: #fff;">
                    <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $category)
                    <tr>
                      <td>{{ $category['category_name'] }}</td>
                      <td>
                          <a href="/admin/editcategory/{{ $category['category_id'] }}"><img src="https://img.icons8.com/android/452/edit.png" width="25px"></a>
                          <a href="/admin/deletecategory/{{ $category['category_id'] }}"><img src="https://img.icons8.com/metro/344/trash.png" width="25px"></a>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

