<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//  All Login and Register Route  //

Route::view('/login','user.login');

Route::post('/login',[UserController::class,'loginuser']);

Route::view('/register','user.register');

Route::post('/register',[UserController::class,'registeruser']);

Route::get('/logout',[UserController::class,'logout']);

Route::view('/forgetpassword','user.forgetpassword');

Route::post('/forgetpassword',[UserController::class,'forgetpassword']);

Route::post('/changepassword',[UserController::class,'changepassword']);

Route::get('/profile',[UserController::class,'profile']);

Route::post('/profile',[UserController::class,'updateprofile']);

Route::get('/changeuserpassword',[UserController::class,'changeuserpassword']);

Route::post('/updateuserpassword',[UserController::class,'updateuserpassword']);

Route::post('/changeemailaddress',[UserController::class,'updateemailaddress']);

Route::get('/onlineuser',[UserController::class,'onlineuser']);

//  All Login and Register Route End Here  //

// HomeController URL For User

Route::get('/',[HomeController::class,'home']);

Route::get('/category/{cateid?}',[HomeController::class,'category']);

Route::get('/viewdetail/{id}',[HomeController::class,'viewdetail']);

// Middleware

Route::group(['middleware' => 'UserCheck'], function () {

Route::get('/cart',[HomeController::class,'cart']);

Route::get('/order',[HomeController::class,'order']);

Route::post('/addtocart',[HomeController::class,'addtocart']);

Route::post('/buynow',[HomeController::class,'buynow']);

Route::post('/placeorder',[HomeController::class,'placeorder']);

Route::post('/checkout',[HomeController::class,'checkout']);

Route::get('/increasequantity/{id}',[HomeController::class,'increasequantity']);

Route::get('/decreasequantity/{id}',[HomeController::class,'decreasequantity']);

Route::get('/removefromcart/{id}',[HomeController::class,'removefromcart']);

});

// Middleware for Admin URL

Route::group(['middleware' => 'AdminCheck'], function () {

// Product URL For admin

Route::get('/admin',[AdminController::class,'admin']);

Route::get('/admin/product/{page?}',[AdminController::class,'product']);

Route::get('/admin/createproduct',[AdminController::class,'createproduct']);

Route::post('/admin/createproduct',[AdminController::class,'saveproduct']);

Route::get('/admin/searchproduct/{page?}',[AdminController::class,'searchproduct']);

Route::get('/admin/editproduct/{id}',[AdminController::class,'editproduct']);

Route::post('/admin/updateproduct',[AdminController::class,'updateproduct']);

Route::get('/admin/deleteproduct/{id}',[AdminController::class,'deleteproduct']);

// Iamge URL For admin

Route::get('/admin/image/{id}',[AdminController::class,'image']);

Route::get('/admin/createimage/{id}',[AdminController::class,'createimage']);

Route::post('/admin/createimage',[AdminController::class,'saveimage']);

Route::get('/admin/editimage/{id}',[AdminController::class,'editimage']);

Route::post('/admin/updateimage',[AdminController::class,'updateimage']);

Route::get('/admin/deleteimage/{id}',[AdminController::class,'deleteimage']);

// Size URL For admin

Route::get('/admin/size/{id}',[AdminController::class,'size']);

Route::get('/admin/createsize/{id}',[AdminController::class,'createsize']);

Route::post('/admin/createsize',[AdminController::class,'savesize']);

Route::get('/admin/editsize/{id}',[AdminController::class,'editsize']);

Route::post('/admin/updatesize',[AdminController::class,'updatesize']);

Route::get('/admin/deletesize/{id}',[AdminController::class,'deletesize']);

// Color URL For admin

Route::get('/admin/color/{id}',[AdminController::class,'color']);

Route::get('/admin/createcolor/{id}',[AdminController::class,'createcolor']);

Route::post('/admin/createcolor',[AdminController::class,'savecolor']);

Route::get('/admin/editcolor/{id}',[AdminController::class,'editcolor']);

Route::post('/admin/updatecolor',[AdminController::class,'updatecolor']);

Route::get('/admin/deletecolor/{id}',[AdminController::class,'deletecolor']);

// Category URL For admin

Route::get('/admin/category',[AdminController::class,'category']);

Route::get('/admin/createcategory',[AdminController::class,'createcategory']);

Route::post('/admin/createcategory',[AdminController::class,'savecategory']);

Route::get('/admin/editcategory/{id}',[AdminController::class,'editcategory']);

Route::post('/admin/updatecategory',[AdminController::class,'updatecategory']);

Route::get('/admin/deletecategory/{id}',[AdminController::class,'deletecategory']);

// Subcategory URL For admin

Route::get('/admin/getsubcategory',[AdminController::class,'getsubcategory']);

Route::get('/admin/subcategory/{page?}',[AdminController::class,'subcategory']);

Route::get('/admin/createsubcategory',[AdminController::class,'createsubcategory']);

Route::post('/admin/createsubcategory',[AdminController::class,'savesubcategory']);

Route::get('/admin/searchsubcategory/{page?}',[AdminController::class,'searchsubcategory']);

Route::get('/admin/editsubcategory/{id}',[AdminController::class,'editsubcategory']);

Route::post('/admin/updatesubcategory',[AdminController::class,'updatesubcategory']);

Route::get('/admin/deletesubcategory/{id}',[AdminController::class,'deletesubcategory']);

// Order URL For admin

Route::get('/admin/orderlist/{page?}',[AdminController::class,'orderlist']);

Route::get('/admin/searchorderlist/{page?}',[AdminController::class,'searchorder']);

Route::get('/admin/orderdetail/{id}',[AdminController::class,'orderdetail']);

Route::get('/admin/orderedit/{id}',[AdminController::class,'orderedit']);

Route::post('/admin/orderupdate',[AdminController::class,'orderupdate']);

Route::get('/admin/orderdelete/{id}',[AdminController::class,'orderdelete']);

Route::get('/admin/activeorderlist/{page?}',[AdminController::class,'activeorderlist']);

Route::get('/admin/pendingorderlist/{page?}',[AdminController::class,'pendingorderlist']);

Route::get('/admin/deliveredorderlist/{page?}',[AdminController::class,'deliveredorderlist']);

Route::get('/admin/rejectorderlist/{page?}',[AdminController::class,'rejectorderlist']);

Route::get('/admin/acceptorder/{id}',[AdminController::class,'acceptorder']);

Route::get('/admin/rejectorder/{id}',[AdminController::class,'rejectorder']);

Route::get('/admin/deliveredorder/{id}',[AdminController::class,'deliveredorder']);

Route::get('/admin/pendingorder/{id}',[AdminController::class,'pendingorder']);

// User URL For admin

Route::get('/admin/user/{page?}',[AdminController::class,'user']);

Route::get('/admin/searchuser/{page?}',[AdminController::class,'searchuser']);

Route::get('/admin/createuser',[AdminController::class,'createuser']);

Route::post('/admin/createuser',[AdminController::class,'saveuser']);

Route::get('/admin/edituser/{id}',[AdminController::class,'edituser']);

Route::post('/admin/updateuser',[AdminController::class,'updateuser']);

Route::get('/admin/deleteuser/{id}',[AdminController::class,'deleteuser']);

Route::get('/admin/changepassword/{id}',[AdminController::class,'changepassword']);

Route::post('/admin/changepassword',[AdminController::class,'updatepassword']);


});

//  All Login and Register Route End Here  //
