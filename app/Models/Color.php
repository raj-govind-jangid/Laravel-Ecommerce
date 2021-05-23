<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    public $primaryKey = 'color_id';
    protected $fillable = ['color_product_id','color_name'];
    protected $table = 'colors';
}
