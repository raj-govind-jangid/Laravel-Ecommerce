<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $primaryKey = 'cart_id';
    protected $fillable = ['cart_user_id','cart_product_id','cart_product_quantity','cart_total_price'];
}
