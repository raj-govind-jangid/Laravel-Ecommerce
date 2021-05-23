@extends('adminbase')

@section('title')
<title>Create Product</title>
@endsection

@section('content')
<div class="container">
    <header class="text-center">
      <h1 class="display-4">Create Product</h1>
    </header>
    <div class="row py-4">
      <div class="col-lg-12 mx-auto">
        <div class="card rounded shadow border-0">
          <div class="card-body p-4 bg-white rounded">
            <div>
                <form action="/admin/createproduct" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                      <label>Product Brand Name</label>
                      <input type="text" class="form-control" name="brand_name" placeholder="Enter Brand Name" required>
                    </div>
                    <div class="form-group">
                      <label>Product Name:</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Product Name" required>
                    </div>
                    <div class="form-group">
                        <label>Category Name:</label>
                        <select class="form-control" name='category_id'  id="category_id">
                            @foreach ($category as $category)
                            <option value="{{$category['category_id']}}">{{$category['category_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>SubCategory Name:</label>
                        <select class="form-control" name='subcategory_id' id="subcategory">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Description:</label>
                        <textarea class="form-control" rows="4" name="description" placeholder="Enter Product Description" required></textarea>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Price:</label>
                        <input type="number" class="form-control" name="price" placeholder="Enter Product Price" required>
                    </div>
                    <div class="form-group">
                        <label>Product Quantity:</label>
                        <input type="number" class="form-control" name="quantity" placeholder="Enter Product Quantity" required>
                    </div>
                    <div class="form-group">
                        <label>Product Main Image:</label>
                        <input type="file" class="form-control" name="thumb" placeholder="Upload Product Image" onchange="previewFile(this)" required>
                        <img id="previewImg" alt="profile image" style="max-width: 130px; margin-top: 20px;">
                    </div>
                    <div class="form-group">
                        <label>Product Status:</label>
                        <select class="form-control" name='status'>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">Create Product</button>
                    <p id="demo"></p>
                  </form>
                </div>
                </div>
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
    $(document).ready(function(){

        function getsubcategory(){
            var ca_id = $('#category_id').val();
            document.getElementById('demo').innerHTML = ca_id;
            output = "";
            $.ajax({
                url: '/admin/getsubcategory',
                method: 'GET',
                data: {ca_id:ca_id},
                success: function(data){
                    x = data;
                    var i;
                    for (i = 0; i < x.length; i++) {
                        output += '<option value='+ x[i].subcategory_id +'>'+ x[i].subcategory_name + '</option>';
                    }
                    $("#subcategory").html(output);
                },
            })
            }
        getsubcategory()

        $('#category_id').click(function(){
            getsubcategory();
        })

    })
</script>
@endsection
