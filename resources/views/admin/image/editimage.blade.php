@extends('adminbase')

@section('title')
<title>Edit Image</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Edit Image</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/updateimage" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="image_id" value="{{$image['image_id']}}">
                    <div class="form-group">
                        <label>Product Image:</label>
                        <input type="file" class="form-control" name="image" placeholder="Upload Product Image" onchange="previewFile(this)">
                        <span>Left it Blank If You don't want to change image</span>
                        <br>
                        <img id="previewImg" src="{{ asset('/productimages') }}/{{ $image['image_name'] }}" alt="profile image" style="max-width: 130px; margin-top: 20px;" >
                    </div>
                    <button type="submit" class="btn">Update Image</button>
                  </form>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
    function previewFile(input){
        var file=$("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $('#previewImg').attr("src",reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
