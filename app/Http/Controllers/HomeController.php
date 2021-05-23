<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    static function cartitem(){
        if(session()->get('user')){
            $userid = session()->get('user')['user_id'];
            $cart = Cart::where(['cart_user_id'=>$userid])->get();
            $cartitem = $cart->count();
            return $cartitem;
        }
        else{
            $cartitem = 0;
            return $cartitem;
        }
    }

    static function categorylist(){
        return Category::all();
    }

    public function home(){
        $product = Product::where(['product_status'=>'active'])->get();
        return view('home.home',['product'=>$product]);
    }

    public function category($id = null){
        $product = Product::query();
        if($id == null){
            $product = $product->where(['product_status'=>'active'])->get();
        }
        else{
            $product = $product->where(['product_category_id'=>$id,'product_status'=>'active'])->get();
        }
        return view('home.home',['product'=>$product]);
    }

    public function viewdetail($id){
        $product = Product::where(['product_id'=>$id])->first();
        $image = Image::where(['image_product_id'=>$id])->get();
        $color = Color::where(['color_product_id'=>$id])->get();
        $size = Size::where(['size_product_id'=>$id])->get();
        $countimage = $image->count();
        return view('home.detail',['product'=>$product,'color'=>$color,'image'=>$image,'size'=>$size,'countimage'=>$countimage]);
    }

    public function cart(){
        $user_id = session()->get('user')['user_id'];
        $product = Cart::join('products','product_id','=','cart_product_id')
                ->join('sizes','size_id','=','cart_size_id')
                ->join('colors','color_id','=','cart_color_id')
                ->orderBy('cart_id', 'DESC')
                ->where(['cart_user_id'=>$user_id])
                ->get();
        $totalprice = 0;
        foreach($product as $p){
            $totalprice = $totalprice + $p['cart_total_price'];
        }
        return view('home.cart',['product'=>$product,'totalprice'=>$totalprice]);
    }

    public function order(){
        $user_id = session()->get('user')['user_id'];
        $order = Order::join('products','product_id','=','order_product_id')
            ->join('colors','color_id','=','order_color_id')
            ->join('sizes','size_id','=','order_size_id')
            ->orderBy('order_id', 'DESC')
            ->where(['order_user_id'=>$user_id])
            ->get();
        return view('home.order',['order'=>$order]);
    }

    public function buynow(Request $request){
        if(session()->get('user')){
            $product = Product::where(['product_id'=>$request->product_id])->first();
            if($request->quantity <= $product['product_quantity']){
                $color = Color::where(['color_id'=>$request->color_id])->first();
                $size = Size::where(['size_id'=>$request->size_id])->first();
                $quantity = $request->quantity;
                $totalprice = $product['product_price'] * $quantity;
                return view('home.buynow',['product'=>$product,'color'=>$color,'size'=>$size,'quantity'=>$quantity,'totalprice'=>$totalprice]);
            }
            else{
                session()->put('fail',"You Are adding ".$request->quantity." quantity but we have only ".$product['product_quantity']." left");
                return redirect()->back();
            }
        }
        else{
            return redirect('/login');
            }
    }

    public function placeorder(Request $request){
        if($request->payment == "COD"){
            $product = Product::where(['product_id'=>$request->product_id])->first();
            $order = new Order;
            $order->order_user_id = session()->get('user')['user_id'];
            $order->order_product_id = $request->product_id;
            $order->order_quantity = $request->quantity_id;
            $order->order_color_id = $request->color_id;
            $order->order_size_id = $request->size_id;
            $order->order_total_price = $product['product_price'] * $request->quantity_id;
            $order->order_first_name = $request->firstname;
            $order->order_last_name = $request->lastname;
            $order->order_phoneno = $request->phoneno;
            $order->order_shipping_address = $request->shippingaddress;
            $order->order_date = date("Y-m-d");
            $order->order_status = "Pending";
            $order->order_payment_method = $request->payment;
            $order->save();
            $product->update(['product_quantity'=>$product['product_quantity'] - $request->quantity_id]);
            session()->put('success','We Received Your order Successfully');
            return redirect('/');
        }
        elseif($request->payment == "ONLINE"){
            session()->put('fail','We current not accepting online payment');
            return redirect()->back();
        }

    }

    public function checkout(Request $request){
        $user_id = session()->get('user')['user_id'];
        $cart = Cart::where(['cart_user_id'=>$user_id])->get();
        foreach($cart as $carts){
            $product = Product::where(['product_id'=>$carts['cart_product_id']])->first();
            if($carts['cart_product_quantity'] > $product['product_quantity']){
                session()->put('fail',"We Only have $product->product_quantity quantity left of $product->product_name and you have order  $carts->cart_product_quantity quantity");
                return redirect('/cart');
            }
        }
        if($request->payment == "COD"){
            foreach($cart as $carts){
            $product_id = $carts['cart_product_id'];
            $product = Product::where(['product_id'=>$product_id])->first();
            $order = new Order;
            $order->order_user_id = session()->get('user')['user_id'];
            $order->order_product_id = $carts['cart_product_id'];
            $order->order_quantity = $carts['cart_product_quantity'];
            $order->order_color_id = $carts['cart_color_id'];
            $order->order_size_id = $carts['cart_size_id'];
            $order->order_total_price = $product['product_price'] * $carts['cart_product_quantity'];
            $order->order_first_name = $request->firstname;
            $order->order_last_name = $request->lastname;
            $order->order_phoneno = $request->phoneno;
            $order->order_shipping_address = $request->shippingaddress;
            $order->order_date = date("Y-m-d");
            $order->order_status = "Pending";
            $order->order_payment_method = $request->payment;
            $order->save();
            $product->update(['product_quantity'=>$product['product_quantity'] - $carts['cart_product_quantity']]);
            $carts->delete();
            }
            session()->put('success','We Received Your order Successfully');
            return redirect('/');
        }
        elseif($request->payment == "ONLINE"){
            session()->put('fail','We current not accepting online payment');
            return redirect()->back();
        }

    }

    public function addtocart(Request $request){
        if(session()->get('user')){
            $product = Product::where(['product_id'=>$request->product_id])->first();
            if($request->add_quantity <= $product['product_quantity']){
                $user_id = session()->get('user')['user_id'];
                $cart = new Cart;
                $cart->cart_user_id = $user_id;
                $cart->cart_product_id = $request->product_id;
                $cart->cart_color_id = $request->color_id;
                $cart->cart_size_id = $request->size_id;
                $cart->cart_product_quantity = $request->quantity;
                $cart->cart_total_price = $request->quantity * $product['product_price'];
                $cart->save();
                session()->put('success','Added Successfully');
                return redirect()->back();
            }
            else{
                session()->put('fail','You Are adding '.$request->add_quantity.'quantity but we have only'.$product['product_quantity']);
                return redirect()->back();
            }
        }
        else{
            return redirect('/login');
        }
    }

    public function removefromcart($id){
        $cart = Cart::where(['cart_id'=>$id])->first();
        $cart->delete();
        return redirect()->back();
    }

    public function increasequantity($id){
        $cart = Cart::where(['cart_id'=>$id])->first();
        $product = Product::where(['product_id'=>$cart['cart_product_id']])->first();
        $item = $cart['cart_product_quantity'];
        if($item < 10){
            $item = $item + 1;
            if($item <= $product['product_quantity']){
                $cart->update([
                    'cart_product_quantity' => $item,
                    'cart_total_price' => $product['product_price'] * $item,
                ]);
            }
            else{
                session()->put('fail','You Are increasing '.$item.' quantity but we have only '.$product['product_quantity'].' left ');
            }
        }
        else{
            session()->put('fail','Maximum limit is 10 Only');
        }
        return redirect()->back();
    }

    public function decreasequantity($id){
        $cart = Cart::where(['cart_id'=>$id])->first();
        $product = Product::where(['product_id'=>$cart['cart_product_id']])->first();
        $item = $cart['cart_product_quantity'];
        if($item > 1){
            $item = $item - 1;
            $cart->update([
                'cart_product_quantity' => $item,
                'cart_total_price' => $product['product_price'] * $item,
            ]);
        }
        else{
            $cart->delete();
        }
        return redirect()->back();
    }

}
