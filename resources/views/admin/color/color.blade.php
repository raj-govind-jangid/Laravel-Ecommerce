@extends('adminbase')

@section('title')
<title>Product Color</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Product Color</h1>
      <h4 class="lead mb-0" style="font-size: 30px;">Total Result : {{ $totalcolor }}</h4>
    </header>
    <div class="row py-5">
      <div class="col-lg-12 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <a href="/admin/createcolor/{{ $id }}" class="btn mb-4 mr-auto">Add Color</a>
            <div class="table-responsive">
              <table id="example" style="width:100%" class="table table-striped text-center">
                <thead style="background-color: rgb(106, 90, 205); color: #fff;">
                    <tr>
                        <th>Color Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($color) && count($color) > 0)
                    @foreach ($color as $color)
                    <tr>
                        <td>{{ $color['color_name'] }}</td>
                      <td>
                          <a href="/admin/editcolor/{{ $color['color_id'] }}"><img src="https://img.icons8.com/android/452/edit.png" width="25px"></a>
                          <a href="/admin/deletecolor/{{ $color['color_id'] }}"><img src="https://img.icons8.com/metro/344/trash.png" width="25px"></a>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="2">Your Product Don't have any Color</td>
                    </tr>
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

