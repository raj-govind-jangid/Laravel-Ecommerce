<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    public $primaryKey = 'size_id';
    protected $fillable = ['size_product_id','size_name'];
    protected $table = 'sizes';
}
