<?php

namespace App\Http\Controllers;

use App\Models\Kategoriler;
use App\Models\Urunler;

class HomeController extends Controller
{

    public function index()
    {

        //URUNLER CACHE
        $urunler = cache()->remember('urunler', now()->addDays(1), function () {
            return Urunler::with(['katego' => function ($query) {$query->select('id', 'categoryname', 'sira');}])->orderBy('sira', 'asc')->get()->groupBy('category');
        });

        //KATEGORİLER CACHE
        $kategoriler = cache()->remember('kategoriler', now()->addDays(1), function () {
            return Kategoriler::orderby('sira', 'asc')->get();
        });

        return view('index', compact('urunler', 'kategoriler'));
    }
    public function panel()
    {
        return view('home');
    }
}
