<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $primaryKey = 'order_id';
    protected $fillable = ['order_user_id','order_product_id','order_quantity','order_color_id','order_size_id','order_total_price','order_first_name','order_last_name','order_phoneno','order_shipping_address','order_date','order_status','order_payment_method'];
    protected $table = 'orders';
}
