@extends('adminbase')

@section('title')
<title>SubCategory</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">SubCategory Lists</h1>
      <h4 class="lead mb-0" style="font-size: 30px;">Total Search Result : {{ $totaldata }}</h4>
    </header>
    <div class="row py-5">
      <div class="col-lg-12 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <a href="/admin/createsubcategory" class="btn mb-4 mr-auto">Create SubCategory</a>
            <a href class="btn mb-4 mr-auto" data-toggle="modal" data-target="#myModal">Search Filter</a>
            <div class="table-responsive">
              <table id="example" style="width:100%" class="table table-striped text-center">
                <thead style="background-color: rgb(106, 90, 205); color: #fff;">
                    <tr>
                        <th>Category Name</th>
                        <th>SubCategory Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $data)
                    <tr>
                      <td>{{ $data['category_name'] }}</td>
                      <td>{{ $data['subcategory_name'] }}</td>
                      <td>
                          <a href="/admin/editsubcategory/{{ $data['subcategory_id'] }}"><img src="https://img.icons8.com/android/452/edit.png" width="25px"></a>
                          <a href="/admin/deletesubcategory/{{ $data['subcategory_id'] }}"><img src="https://img.icons8.com/metro/344/trash.png" width="25px"></a>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="table-responsive">
                <ul class="pagination">
                    @if($page >= 2)
                    <li class="page-item"><a class="page-link" href="/admin/searchsubcategory/{{ $page-1 }}?searchcategory={{$searchcategory}}&searchsubcategory={{$searchsubcategory}}">Previous</a></li>
                    @endif
                    @for($i = 1; $i <= $number_of_page; $i++)
                    @if($page == $i)
                    <li class="page-item active"><a class="page-link" href="/admin/searchsubcategory/{{ $i }}?searchcategory={{$searchcategory}}&searchsubcategory={{$searchsubcategory}}">{{$i}}</a></li>
                    @continue
                    @endif
                    <li class="page-item"><a class="page-link" href="/admin/searchsubcategory/{{ $i }}?searchcategory={{$searchcategory}}&searchsubcategory={{$searchsubcategory}}">{{$i}}</a></li>
                    @endfor
                    @if($page < $number_of_page)
                    <li class="page-item"><a class="page-link" href="/admin/searchsubcategory/{{ $page+1 }}?searchcategory={{$searchcategory}}&searchsubcategory={{$searchsubcategory}}">Next</a></li>
                    @endif
                </ul>
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
          <h4 class="modal-title">Search Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="/admin/searchsubcategory" method="GET">
                <div class="form-group">
                  <label>Category</label>
                  <input type="text" class="form-control" placeholder="Enter Category Name" name="searchcategory">
                </div>
                <div class="form-group">
                  <label>Subcategory:</label>
                  <input type="text" class="form-control" placeholder="Enter Subcategory Name" name="searchsubcategory">
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

