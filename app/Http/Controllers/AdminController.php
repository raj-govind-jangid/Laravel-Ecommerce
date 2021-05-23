<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use PDF;

class AdminController extends Controller
{
    public function admin(){
        $totalactive = Order::where(['order_status'=>'Active'])->get()->count();
        $totalpending = Order::where(['order_status'=>'Pending'])->get()->count();
        $totaldelivered = Order::where(['order_status'=>'Delivered'])->get()->count();
        $totalreject = Order::where(['order_status'=>'Reject'])->get()->count();
        $activeorder = Order::join('products','product_id','=','order_product_id')
            ->join('users','user_id','=','order_user_id')
            ->orderBy('order_id', 'DESC')
            ->where(['order_status'=>'Active'])
            ->limit(5)
            ->get();
        $pendingorder = Order::join('products','product_id','=','order_product_id')
            ->join('users','user_id','=','order_user_id')
            ->orderBy('order_id', 'DESC')
            ->where(['order_status'=>'Pending'])
            ->limit(5)
            ->get();

        return view('admin.home.home',['totalactive' => $totalactive,
            'totalpending' => $totalpending,
            'totaldelivered' => $totaldelivered,
            'totalreject' => $totalreject,
            'activeorder' => $activeorder,
            'pendingorder' => $pendingorder,
        ]);
    }

    public function product($page = null){
        $product = Product::query()->orderBy('product_id', 'DESC');
        $totaldata = $product->get()->count();
        $number_of_result = $product->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 2;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $product->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.product.product',['product'=>$data,'totalproduct'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page]);
    }

    public function searchproduct(Request $request,$page = null){
        $brandname = $request->brandname;
        $name = $request->name;
        $status = $request->status;

        $product = Product::query();
        if(!$brandname == null){
            $product->where('product_brand_name','Like','%'.$brandname.'%');
        }
        if(!$name == null){
            $product->where('product_name','Like','%'.$name.'%');
        }
        if($status == "Active" || $status == "Inactive"){
            $product->where('product_status','Like','%'.$status.'%');
        }
        $totaldata = $product->get()->count();
        $number_of_result = $product->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 5;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $product->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.product.searchproduct',['data'=>$data,'totaldata'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page,'brandname'=>$brandname,'name'=>$name,'status'=>$status]);
    }

    public function createproduct(){
        $category = Category::All();
        return view('admin.product.createproduct',['category'=>$category]);
    }

    public function saveproduct(Request $request){
        $image = $request->file('thumb');
        $imageName = uniqid().'.'.$image->extension();
        $image->move(public_path('productimages'),$imageName);
        $product = new Product;
        $product->product_brand_name = $request->brand_name;
        $product->product_name = $request->name;
        $product->product_category_id = $request->category_id;
        $product->product_subcategory_id = $request->subcategory_id;
        $product->product_description = $request->description;
        $product->product_price = $request->price;
        $product->product_quantity = $request->quantity;
        $product->product_thumb = $imageName;
        $product->product_status = $request->status;
        $product->save();
        session()->put('success','Created Successfully');
        return redirect('/admin/product');
    }

    public function editproduct($id){
        $product = Product::join('categories','category_id','=','product_category_id')
            ->join('subcategories','subcategory_id','=','product_subcategory_id')
            ->where(['product_id'=>$id])->first();
        $category = Category::All();
        $subcategory = Subcategory::All();
        return view('admin.product.editproduct',['product'=>$product,'category'=>$category,'subcategory'=>$subcategory]);
    }

    public function updateproduct(Request $request){
        $product = Product::where(['product_id'=>$request->id])->first();
        if($request->file('thumb') == null){

        }
        else{
            $imagepath = public_path("\productimages\\").$product['product_thumb'];
            File::delete($imagepath);
            $image = $request->file('thumb');
            $imageName = uniqid().'.'.$image->extension();
            $image->move(public_path('productimages'),$imageName);
            $product->update([
                'product_thumb' => $imageName
            ]);
        }
        $product->update([
            'product_brand_name' => $request->brand_name,
            'product_name' => $request->name,
            'product_category_id' => $request->category_id,
            'product_subcategory_id' => $request->subcategory_id,
            'product_description' => $request->description,
            'product_price' => $request->price,
            'product_quantity' => $request->quantity,
            'product_status' => $request->status,
        ]);
        session()->put('success','Updated Successfully');
        return redirect('/admin/product');
    }

    public function deleteproduct($id){
        $product = Product::where(['product_id'=>$id])->first();
        $imagepath = public_path("\productimages\\").$product['product_thumb'];
        File::delete($imagepath);
        $totalimage = Image::where(['image_product_id'=>$id])->get();
        if($totalimage->count() >= 1){
            foreach($totalimage as $image){
                $productimagepath = public_path("\productimages\\").$image['image_name'];
                File::delete($productimagepath);
                $image->delete();
            }
        }
        $totalsize = Size::where(['size_product_id'=>$id])->get();
        if($totalsize->count() >= 1){
            foreach($totalsize as $size){
                $size->delete();
            }
        }
        $totalcolor = Color::where(['color_product_id'=>$id])->get();
        if($totalcolor->count() >= 1){
            foreach($totalcolor as $color){
                $color->delete();
            }
        }
        $product->delete();
        session()->put('success','Deleted Successfully');
        return redirect('/admin/product');
    }

    public function image($id){
        $image = Image::where(['image_product_id'=>$id])->get();
        $totalimage = $image->count();
        return view('admin.image.image',['id'=>$id,'image'=>$image,'totalimage'=>$totalimage]);
    }

    public function createimage($id){
        return view('admin.image.createimage',['id'=>$id]);
    }

    public function saveimage(Request $request){
        $image = $request->file('image');
        $imagename = uniqid().'.'.$image->extension();
        $image->move(public_path('productimages'),$imagename);
        $image = new Image;
        $image->image_product_id = $request->product_id;
        $image->image_name = $imagename;
        $image->save();
        session()->put('success','Created Successfully');
        return redirect()->back();
    }

    public function editimage($id){
        $image = Image::where(['image_id'=>$id])->first();
        return view('admin.image.editimage',['image'=>$image]);
    }

    public function updateimage(Request $request){
        $image = Image::where(['image_id'=>$request->image_id])->first();
        if($request->file('image') == null){

        }
        else{
            $imagepath = public_path("\productimages\\").$image['image_name'];
            File::delete($imagepath);
            $newimage = $request->file('image');
            $imageName = uniqid().'.'.$newimage->extension();
            $newimage->move(public_path('productimages'),$imageName);
            $image->update([
                'image_name' => $imageName
            ]);
        }

        session()->put('success','Updated Successfully');
        return redirect()->back();
    }

    public function deleteimage($id){
        $image = Image::where(['image_id'=>$id])->first();
        $imagepath = public_path("\productimages\\").$image['image_name'];
        File::delete($imagepath);
        $image->delete();
        session()->put('success','Deleted Successfully');
        return redirect()->back();
    }

    public function size($id){
        $size = Size::where(['size_product_id'=>$id])->get();
        $totalsize = $size->count();
        return view('admin.size.size',['id'=>$id,'size'=>$size,'totalsize'=>$totalsize]);
    }

    public function createsize($id){
        return view('admin.size.createsize',['id'=>$id]);
    }

    public function savesize(Request $request){
        $size = new Size;
        $size->size_product_id = $request->product_id;
        $size->size_name = $request->size_name;
        $size->save();
        session()->put('success','Created Successfully');
        return redirect()->back();
    }

    public function editsize($id){
        $size = Size::where(['size_id'=>$id])->first();
        return view('admin.size.editsize',['size'=>$size]);
    }

    public function updatesize(Request $request){
        $size = Size::where(['size_id'=>$request->size_id])->first();
        $size->update([
            'size_name'=>$request->size_name
        ]);
        session()->put('success','Updated Successfully');
        return redirect()->back();
    }

    public function deletesize($id){
        $size = Size::where(['size_id'=>$id])->first();
        $size->delete();
        session()->put('success','Deleted Successfully');
        return redirect()->back();
    }

    public function color($id){
        $color = Color::where(['color_product_id'=>$id])->get();
        $totalcolor = $color->count();
        return view('admin.color.color',['id'=>$id,'color'=>$color,'totalcolor'=>$totalcolor]);
    }

    public function createcolor($id){
        return view('admin.color.createcolor',['id'=>$id]);
    }

    public function savecolor(Request $request){
        $color = new Color;
        $color->color_product_id = $request->product_id;
        $color->color_name = $request->color_name;
        $color->save();
        session()->put('success','Created Successfully');
        return redirect()->back();
    }

    public function editcolor($id){
        $color = Color::where(['color_id'=>$id])->first();
        return view('admin.color.editcolor',['color'=>$color]);
    }

    public function updatecolor(Request $request){
        $color = Color::where(['color_id'=>$request->color_id])->first();
        $color->update([
            'color_name'=>$request->color_name
        ]);
        session()->put('success','Updated Successfully');
        return redirect()->back();
    }

    public function deletecolor($id){
        $color = Color::where(['color_id'=>$id])->first();
        $color->delete();
        session()->put('success','Deleted Successfully');
        return redirect()->back();
    }

    public function category(){
        $category = Category::orderBy('category_id', 'DESC')->get();
        $totalcategory = $category->count();
        return view('admin.category.category',['category'=>$category,'totalcategory'=>$totalcategory]);
    }

    public function createcategory(){
        return view('admin.category.createcategory');
    }

    public function savecategory(Request $request){
        $category = new Category;
        $category->category_name = $request->category;
        $category->save();
        session()->put('success','Created Successfully');
        return redirect('/admin/category');
    }

    public function editcategory($id){
        $category = Category::where(['category_id'=>$id])->first();
        return view('admin.category.editcategory',['category'=>$category]);
    }

    public function updatecategory(Request $request){
        $category = Category::where(['category_id'=>$request->id])->first();
        $category->update([
            'category_name'=>$request->category
        ]);
        session()->put('success','Updated Successfully');
        return redirect('/admin/category');
    }

    public function deletecategory($id){
        $category = Category::where(['category_id'=>$id])->first();
        $category->delete();
        session()->put('success','Deleted Successfully');
        return redirect('/admin/category');
    }

    public function getsubcategory(Request $request){
        $subcategory = Subcategory::where(['subcategory_category_id'=>$request->ca_id])->get();
        return $subcategory;
    }

    public function subcategory($page = null){
        $subcategory = Subcategory::join('categories','category_id','=','subcategory_category_id')->orderBy('subcategory_id', 'DESC');
        $totaldata = $subcategory->get()->count();
        $number_of_result = $subcategory->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 10;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $subcategory->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.subcategory.subcategory',['data'=>$data,'totaldata'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page]);

    }

    public function searchsubcategory(Request $request,$page = null){
        $searchcategory = $request->searchcategory;
        $searchsubcategory = $request->searchsubcategory;

        $subcategory = Subcategory::join('categories','category_id','=','subcategory_category_id');
        if(!$searchcategory == null){
            $subcategory->where('category_name','Like','%'.$searchcategory.'%');
        }
        if(!$searchsubcategory == null){
            $subcategory->where('subcategory_name','Like','%'.$searchsubcategory.'%');
        }
        $totaldata = $subcategory->get()->count();
        $number_of_result = $subcategory->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 10;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $subcategory->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.subcategory.searchsubcategory',['data'=>$data,'totaldata'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page,'searchcategory'=>$searchcategory,'searchsubcategory'=>$searchsubcategory]);

    }

    public function createsubcategory(){
        $category = Category::all();
        return view('admin.subcategory.createsubcategory',['category'=>$category]);
    }

    public function savesubcategory(Request $request){
        $subcategory = new Subcategory;
        $subcategory->subcategory_category_id = $request->category_id;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->save();
        session()->put('success','Created Successfully');
        return redirect('/admin/subcategory');
    }

    public function editsubcategory($id){
        $subcategory = Subcategory::join('categories','category_id','=','subcategory_category_id')
            ->where(['subcategory_id'=>$id])
            ->first();
        $category = Category::all();
        return view('admin.subcategory.editsubcategory',['category'=>$category,'subcategory'=>$subcategory]);
    }

    public function updatesubcategory(Request $request){
        $subcategory = Subcategory::where(['subcategory_id'=>$request->subcategory_id])->first();
        $subcategory->update([
            'subcategory_category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
        ]);
        session()->put('success','Updated Successfully');
        return redirect('/admin/subcategory');
    }

    public function deletesubcategory($id){
        $subcategory = Subcategory::where(['subcategory_id'=>$id])->first();
        $subcategory->delete();
        session()->put('success','Deleted Successfully');
        return redirect('/admin/subcategory');
    }

    public function orderlist($page = null){
        $order = Order::join('products','product_id','=','order_product_id')
            ->join('users','user_id','=','order_user_id')
            ->orderBy('order_id', 'DESC');

        $totaldata = $order->get()->count();
        $number_of_result = $order->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 3;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $order->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.order.order',['order'=>$data,'totalorder'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page]);
    }

    public function searchorder(Request $request,$page = null){
        $email = $request->email;
        $productname = $request->productname;
        $shippingaddress = $request->shippingaddress;

        $order = Order::join('products','product_id','=','order_product_id')
            ->join('users','user_id','=','order_user_id');
        if(!$email == null){
            $order->where('user_email','Like','%'.$email.'%');
        }
        if(!$productname == null){
            $order->where('product_name','Like','%'.$productname.'%');
        }
        if(!$shippingaddress == null){
            $order->where('order_shipping_address','Like','%'.$shippingaddress.'%');
        }
        $totaldata = $order->get()->count();
        $number_of_result = $order->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 2;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $order->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.order.searchorder',['order'=>$data,'totalorder'=>$totaldata,'number_of_page'=>$number_of_page,'email'=>$email,'productname'=>$productname,'shippingaddress'=>$shippingaddress,'page'=>$page]);
    }

    public function orderdetail($id){
        $order = Order::join('products','product_id','=','order_product_id')
            ->join('colors','color_id','=','order_color_id')
            ->join('sizes','size_id','=','order_size_id')
            ->join('users','user_id','=','order_user_id')
            ->where(['order_id'=>$id])
            ->first();
        return view('admin.order.orderdetail',['order'=>$order]);
    }

    public function orderedit($id){
        $order = Order::where(['order_id'=>$id])->first();
        return view('admin.order.orderedit',['order'=>$order]);
    }

    public function orderupdate(Request $request){
        $order = Order::where(['order_id'=>$request->id])->first();
        $order->update([
            'order_first_name'=>$request->firstname,
            'order_last_name'=>$request->lastname,
            'order_phoneno'=>$request->phoneno,
            'order_shipping_address'=>$request->shipping_address,
            'order_status'=>$request->status,
        ]);
        session()->put('success','Updated Successfully');
        return redirect()->back();
    }

    public function orderdelete($id){
        $order = Order::where(['order_id'=>$id])->first();
        $order->delete();
        session()->put('success','Deleted Successfully');
        return redirect()->back();
    }

    public function activeorderlist($page = null){
        $order = Order::join('products','product_id','=','order_product_id')
            ->join('users','user_id','=','order_user_id')
            ->orderBy('order_id', 'DESC')
            ->where(['order_status'=>'Active']);
        $totaldata = $order->get()->count();
        $number_of_result = $order->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 3;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $order->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.order.activeorder',['order'=>$data,'totalorder'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page]);
    }

    public function pendingorderlist($page = null){
        $order = Order::join('products','product_id','=','order_product_id')
            ->join('users','user_id','=','order_user_id')
            ->orderBy('order_id', 'DESC')
            ->where(['order_status'=>'Pending']);
        $totaldata = $order->get()->count();
        $number_of_result = $order->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 3;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $order->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.order.pendingorder',['order'=>$data,'totalorder'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page]);
    }

    public function deliveredorderlist($page = null){
        $order = Order::join('products','product_id','=','order_product_id')
            ->join('users','user_id','=','order_user_id')
            ->orderBy('order_id', 'DESC')
            ->where(['order_status'=>'Delivered']);
        $totaldata = $order->get()->count();
        $number_of_result = $order->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 3;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $order->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.order.deliveredorder',['order'=>$data,'totalorder'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page]);
    }

    public function rejectorderlist($page = null){
        $order = Order::join('products','product_id','=','order_product_id')
            ->join('users','user_id','=','order_user_id')
            ->orderBy('order_id', 'DESC')
            ->where(['order_status'=>'Rejected']);
        $totaldata = $order->get()->count();
        $number_of_result = $order->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 3;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $order->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.order.rejectorder',['order'=>$data,'totalorder'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page]);
    }

    public function acceptorder($id){
        $order = Order::where(['order_id'=>$id])->first();
        $order->update(['order_status'=>'Active']);
        return redirect()->back();
    }

    public function rejectorder($id){
        $order = Order::where(['order_id'=>$id])->first();
        $order->update(['order_status'=>'Rejected']);
        return redirect()->back();
    }

    public function deliveredorder($id){
        $order = Order::where(['order_id'=>$id])->first();
        $order->update(['order_status'=>'Delivered']);
        return redirect()->back();
    }

    public function pendingorder($id){
        $order = Order::where(['order_id'=>$id])->first();
        $order->update(['order_status'=>'Pending']);
        return redirect()->back();
    }

    public function user($page = null){
        $user = User::query()->orderBy('user_id', 'DESC');
        $totaldata = $user->get()->count();
        $number_of_result = $user->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 5;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $user->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.user.user',['user'=>$data,'totaluser'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page]);
    }

    public function searchuser(Request $request,$page = null){
        $email = $request->email;
        $name = $request->name;
        $phoneno = $request->phoneno;

        $user = User::query();
        if(!$email == null){
            $user->where('user_email','Like','%'.$email.'%');
        }
        if(!$name == null){
            $user->where('user_name','Like','%'.$name.'%');
        }
        if(!$phoneno == null){
            $user->where('user_phoneno','Like','%'.$phoneno.'%');
        }
        $totaldata = $user->get()->count();
        $number_of_result = $user->count();
        if ($page === null){
            $page = 1;
        }
        else{

        }
        $results_per_page = 5;
        $page_first_result = ($page-1) * $results_per_page;
        $number_of_page = ceil ($number_of_result / $results_per_page);
        $data = $user->offset($page_first_result)->limit($results_per_page)->get();
        return view('admin.user.searchuser',['data'=>$data,'totaldata'=>$totaldata,'number_of_page'=>$number_of_page,'page'=>$page,'email'=>$email,'name'=>$name,'phoneno'=>$phoneno]);
    }

    public function createuser(){
        return view('admin.user.createuser');
    }

    public function saveuser(Request $request){
        if(User::where(['user_email'=>$request->email])->first()){
            session()->put('fail', 'Email ID Already Exists');
            return redirect('/admin/createuser');
        }
        else{
            $user = new User;
            $user->user_email=$request->email;
            $user->user_name=$request->name;
            $user->user_phoneno=$request->phoneno;
            $user->user_password=Hash::make($request->password);
            $user->user_type=$request->type;
            $user->save();
            session()->put('success', 'Created Successfully');
            return redirect('/admin/user');
        }
    }

    public function edituser($id){
        $user = User::where(['user_id'=>$id])->first();
        return view('admin.user.edituser',['user'=>$user]);
    }

    public function updateuser(Request $request){
        $user = User::where(['user_id'=>$request->user_id]);
        $user->update([
                'user_name'=>$request->name,
                'user_phoneno'=>$request->phoneno,
                'user_type'=>$request->type,
        ]);
        session()->put('success', 'Updated Successfully');
        return redirect('/admin/user');
    }

    public function deleteuser($id){
        $user = User::where(['user_id'=>$id])->delete();
        session()->put('success', 'Deleted Successfully');
        return redirect('/admin/user');
    }

    public function changepassword($id){
        $user = User::where(['user_id'=>$id])->first();
        return view('admin.user.changepassword',['user'=>$user]);
    }

    public function updatepassword(Request $request){
        if($request->password == $request->confirmpassword){
            $user = User::where(['user_id'=>$request->user_id]);
            $user->update([
            'user_password'=>Hash::make($request->password),
            ]);
            session()->put('success', 'Updated Successfully');
            return redirect('/admin/user');
        }
        else{
            session()->put('fail', 'Password is matching with confirm password');
            return redirect()->back();
        }
    }

}
