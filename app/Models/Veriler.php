<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veriler extends Model
{
    use HasFactory;
    protected $table = 'veriler';
    protected $fillable = ['marka', 'aciklama', 'anaveri', 'footerveri', 'facebook', 'facebook', 'twitter', 'instagram', 'youtube', 'web', 'adres', 'tel', 'mail'];
}
