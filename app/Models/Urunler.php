<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urunler extends Model
{
    use HasFactory;
    protected $table = 'urunler';
    protected $fillable = ['category', 'sira', 'tr', 'slug', 'price', 'image', 'en', 'ru', 'ar', 'status'];

    public function katego()
    {
        return $this->belongsTo(Kategoriler::class, 'category','id');
    }
}
