<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $primaryKey = 'user_id';
    protected $fillable = ['user_name','user_email','user_phoneno','user_password','user_type','verifycode','verifycodetime','resetcode','resetcodetime'];
}
