<?php

namespace App\Http\Controllers;

use App\Models\Kategoriler;
use Illuminate\Http\Request;
use App\Models\Urunler;

class KategoriController extends Controller
{
    public function select()
    {
        $kategoriler = Kategoriler::orderby('sira', 'asc')->get();
        return view('kategoriler', compact('kategoriler'));
    }

    public function kategoriupdate(Request $request)
    {
        function slugify($text)
        {
            $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
            $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
            $text = strtolower(str_replace($find, $replace, $text));
            $text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
            $text = trim(preg_replace('/\s+/', ' ', $text));
            $text = str_replace(' ', '-', $text);

            return $text;
        }
        $request->validate([
            'kategorimaddeler' => 'required',
        ]);
        $kategorimaddeler = $request->post('kategorimaddeler');
        $sira = $request->post('sira');

        foreach ($sira as $key => $value) {
            if (str_replace([1, 2, 3, 4, 5, 6, 7, 8, 9, 0], '', $value) == 'ekle') {
                Kategoriler::create([
                    "categoryname" => $kategorimaddeler[$key],
                    "slug" => slugify($kategorimaddeler[$key]),
                    "sira" => $key,
                    "categoryimg" => "img/cay.webp",
                    "status" => 1,
                ]);
                cache()->forget('kategoriler');
            } else if (str_replace([1, 2, 3, 4, 5, 6, 7, 8, 9, 0], '', $value) == 'sil') {
                $idli = str_replace('sil', '', $value);
                Kategoriler::where('id', $idli)->delete();
                Urunler::where('category', $idli)-> update(["category" => null]);
                cache()->forget('kategoriler');

            } else {
                Kategoriler::where('id', $sira[$key])->
                    update([
                    "categoryname" => $kategorimaddeler[$key],
                    "slug" => slugify($kategorimaddeler[$key]),
                    "sira" => $key,
                    "categoryimg" => "img/cay.webp",
                    "status" => 1,
                ]);
                cache()->forget('kategoriler');
            }
        }

        return back();
    }
}
