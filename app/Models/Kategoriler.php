<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoriler extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['categoryname', 'slug', 'categoryimg', 'status', 'sira'];

}
