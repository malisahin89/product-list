<?php

namespace App\Http\Controllers;

use App\Models\Veriler;
use Illuminate\Http\Request;

class VerilerController extends Controller
{
    // Select
    public function select()
    {
        $link = Veriler::where('id', 1)->get();
        $linkler = $link[0];
        return view('veriler', compact('linkler'));
    }

    // Güncelle
    public function guncelle(Request $request)
    {
        if ($request->isMethod('post')) {
            $marka = $request->post('marka');
            $aciklama = $request->post('aciklama');
            $anaveri = $request->post('anaveri');
            $footerveri = $request->post('footerveri');
            $facebook = $request->post('facebook');
            $twitter = $request->post('twitter');
            $instagram = $request->post('instagram');
            $youtube = $request->post('youtube');
            $web = $request->post('web');
            $adres = $request->post('adres');
            $tel = $request->post('tel');
            $mail = $request->post('mail');

            Veriler::where('id', 1)->
                update([
                'marka' => $marka,
                'aciklama' => $aciklama,
                'anaveri' => $anaveri,
                'footerveri' => $footerveri,
                'facebook' => $facebook,
                'twitter' => $twitter,
                'instagram' => $instagram,
                'youtube' => $youtube,
                'web' => $web,
                'adres' => $adres,
                'tel' => $tel,
                'mail' => $mail]
            );
        }
        cache()->forget('companyData');
        return back()->withInput();
    }
}
