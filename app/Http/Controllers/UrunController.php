<?php

namespace App\Http\Controllers;

use App\Models\Kategoriler;
use App\Models\Urunler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ImageResize;

class UrunController extends Controller
{

    // SELECT
    public function select()
    {
        $urunler = Urunler::orderby('id', 'desc')->get();
        $kategoriler = Kategoriler::select('id', 'categoryname')->orderby('sira', 'asc')->get();
        return view('urunler', compact('urunler', 'kategoriler'));
    }

    //İNSERT
    public function ekle(Request $request)
    {
        try{
        $request->validate([
            'tr' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
        ]);

        $tr = $request->post('tr');
        $en = $request->post('en', '-');
        $ru = $request->post('ru', '-');
        $ar = $request->post('ar', '-');
        $price = $request->post('price');
        $image = $request->post('image');
        $category = preg_match('/[a-zA-Z]/', $request->post('category')) ? null : $request->post('category');
        // $category = $request->post('category');

        $image = $request->file('image');
        if ($image) {
            $filename = Str::slug($tr) . '-' . time();
            $filename . '.' . $image->getClientOriginalExtension();

            $paththumbnailyolu = 'img/urunler';
            $destinationPath = public_path($paththumbnailyolu);

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 777, true);
            }

            $orjinalurl = 'img/urunler/' . $filename . '.webp';
            ImageResize::make($image->path())->encode('webp', 80)->save(public_path($orjinalurl));
        }

        Urunler::insert([
            'tr' => $tr,
            'en' => $en,
            'ru' => $ru,
            'ar' => $ar,
            'category' => $category,
            'price' => $price,
            'image' => $orjinalurl ?? null,
        ]);
        cache()->forget('urunler');
        return back()->withInput();
    } catch (\Exception $e) {
        if (isset($orjinalurl)) {
            if (file_exists(public_path($orjinalurl))) {
                unlink(public_path($orjinalurl));
            }
        }

        return back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
}

    // GÜNCELLE
    public function guncelle(Request $request)
    {
        if ($_POST['action'] == 'update') {

            $request->validate([
                'no' => 'required',
                'tr' => 'required',
                'price' => 'required|numeric',
            ]);

            $id = $request->post('no');
            $tr = $request->post('tr');
            $en = $request->post('en', '-');
            $ru = $request->post('ru', '-');
            $ar = $request->post('ar', '-');
            $price = $request->post('price');
            $image = $request->post('image');
            $kategori = preg_match('/[a-zA-Z]/', $request->post('category')) ? null : $request->post('category');

            if (!$request->file('image')) {
                Urunler::where('id', $id)->
                    update([
                    'tr' => $tr,
                    'en' => $en,
                    'ru' => $ru,
                    'ar' => $ar,
                    'price' => $price,
                    'category' => $kategori ?? null,
                ]);
                cache()->forget('urunler');

            } else {
                $urun = Urunler::where('id', $id)->first();

                $image = $request->file('image');

                if ($image) {
                    if ($urun->image) {
                        $resimyol = public_path($urun->image);
                        if (file_exists($resimyol)) {unlink($resimyol);}
                    }

                    $filename = Str::slug($tr) . '-' . time();
                    $filename . '.' . $image->getClientOriginalExtension();

                    $paththumbnailyolu = 'img/urunler';
                    $destinationPath = public_path($paththumbnailyolu);

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 777, true);
                    }

                    $orjinalurl = 'img/urunler/' . $filename . '.webp';
                    ImageResize::make($image->path())->encode('webp', 80)->save(public_path($orjinalurl));

                }

                Urunler::where('id', $id)->
                    update([
                    'tr' => $tr,
                    'en' => $en,
                    'ru' => $ru,
                    'ar' => $ar,
                    'price' => $price,
                    'category' => $kategori ?? null,
                    'image' => $orjinalurl ?? null,
                ]);
                cache()->forget('urunler');
            }
        } else if ($_POST['action'] == 'delete') {

            $request->validate([
                'no' => 'required',
            ]);

            $id = $request->post('no');
            $urun = Urunler::where('id', $id)->first();

            if ($urun->image) {
                $resimyol = public_path($urun->image);
                if (file_exists($resimyol)) {unlink($resimyol);}
            }

            cache()->forget('urunler');
            $urun->delete();
        } else {
            return back()->withInput();
        }

        return back()->withInput();
    }

    // ÜRÜN SİRALAMA DEĞİŞTİRME
    public function sirala()
    {
        $urunler = Urunler::select('id', 'category', 'sira', 'tr')->orderBy('sira', 'asc')->get();
        return view('urunlersiralama', compact('urunler'));
    }


    public function siralaUpdate(Request $request)
    {
        $formData = $request->input('data');
        // return response()->json(['success' => $formData]);

        foreach ($formData as $data) {
            $name = $data['name'];
            $dataId = $data['data_id'];
            Urunler::where('id', $name)->update(['sira' => $dataId]);
        }
        cache()->forget('urunler');
        return response()->json(['success' => true]);
    }

}
