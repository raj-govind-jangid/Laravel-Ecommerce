<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public $primaryKey = 'image_id';
    protected $fillable = ['image_product_id','image_name'];
    protected $table = 'images';
}
