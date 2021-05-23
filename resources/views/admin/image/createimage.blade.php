@extends('adminbase')

@section('title')
<title>Add Image</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Add Image</h1>
    </header>
    <div class="row py-5">
      <div class="col-lg-6 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/createimage" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $id }}">
                    <div class="form-group">
                        <label>Product Image:</label>
                        <input type="file" class="form-control" name="image" placeholder="Upload Product Image" onchange="previewFile(this)" required>
                        <img id="previewImg" alt="profile image" style="max-width: 130px; margin-top: 20px;">
                    </div>
                    <button type="submit" class="btn">Add Image</button>
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
