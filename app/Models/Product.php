<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $primaryKey = 'product_id';
    protected $table = 'products';
    protected $fillable = ['product_brand_name','product_name','product_category_id','product_subcategory_id','product_description','product_price','product_quantity','product_thumb'];
}
