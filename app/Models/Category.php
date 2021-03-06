<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $primaryKey = 'category_id';
    protected $fillable = ['category_name'];
    protected $table = 'categories';
}
