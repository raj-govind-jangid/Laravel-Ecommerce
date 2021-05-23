<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    public $primaryKey = 'subcategory_id';
    protected $fillable = ['subcategory_category_id','subcategory_name'];
    protected $table = 'subcategories';
}
