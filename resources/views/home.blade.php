@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $companyData->marka }} Admin Paneli V0.1 | By @malisahin89</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hoşgeldin {{ Auth::user()->name }}!
                    <hr>
                    <a href="{{ route('urun') }}">Ürünler</a><hr>
                    <a href="{{ route('urun.sirala') }}">Ürünleri Sırala</a><hr>
                    <a href="{{ route('kategori') }}">Kategoriler</a><hr>
                    <a href="{{ route('baglantilar') }}">baglantilar</a><hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
