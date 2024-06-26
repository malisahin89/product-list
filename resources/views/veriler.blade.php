@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- jQuery UI (for sortable feature) -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>

    <body>



        <div class="container mt-5">
            <h2 class="mb-4">Veriler</h2>
            <div class="input-group mb-3">
                <form class="row" action="{{ route('baglantilar.guncelle') }}" method="post">
                    @csrf


                    <div class="form-group col-md-12">
                        <label class="control-label">Marka</label>
                        <input class="form-control" type="text" required name="marka" placeholder="Marka"
                            value="{{ $linkler->marka }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label">Açıklama</label>
                        <input class="form-control" type="text" required name="aciklama" placeholder="Açıklama"
                            value="{{ $linkler->aciklama }}">
                    </div>


                    <div class="form-group col-md-12">
                        <label class="control-label">Header Açıklama</label>
                        <input class="form-control" type="text" required name="anaveri" placeholder="Header Açıklama"
                            value="{{ $linkler->anaveri }}">
                    </div>


                    <div class="form-group col-md-12">
                        <label class="control-label">Footer Açıklama</label>
                        <input class="form-control" type="text" required name="footerveri" placeholder="Footer Açıklama"
                            value="{{ $linkler->footerveri }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label">Facebook</label>
                        <input class="form-control" type="text" required name="facebook" placeholder="Facebook"
                            value="{{ $linkler->facebook }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label">Twitter</label>
                        <input class="form-control" type="text" required name="twitter" placeholder="Twitter"
                            value="{{ $linkler->twitter }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label">İnstagram</label>
                        <input class="form-control" type="text" required name="instagram" placeholder="İnstagram"
                            value="{{ $linkler->instagram }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label">Youtube</label>
                        <input class="form-control" type="text" required name="youtube" placeholder="@Youtube"
                            value="{{ $linkler->youtube }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label">Web</label>
                        <input class="form-control" type="text" required name="web" placeholder="Web Sitesi"
                            value="{{ $linkler->web }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label">Adres</label>
                        <input class="form-control" type="text" required name="adres" placeholder="Adres"
                            value="{{ $linkler->adres }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label">Telefon</label>
                        <input class="form-control" type="text" required name="tel" placeholder="Telefon"
                            value="{{ $linkler->tel }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Mail</label>
                        <input class="form-control" type="text" required name="mail" placeholder="Mail"
                            value="{{ $linkler->mail }}">
                    </div>

                    <div class="form-group col-md-4 align-self-end">
                        <input class="btn btn-primary" name="kaydet" type="submit">
                    </div>
                </form>
            </div>
        </div>
    @endsection
