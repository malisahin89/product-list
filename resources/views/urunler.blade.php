@extends('layouts.app')

@section('content')
    <div class="container">




        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 tile">




                    @if (count($kategoriler) > 0)
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <form action="{{ route('urun.ekle') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-dialog col-md-3" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    @error('image')
                                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                    @enderror
                                                    <h1>Yeni Ürün Ekle</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="resim">Platform Resmi Ekle</label>
                                                        <input type="file" required name="image" accept=".jpg, .jpeg, .png, .gif, .bmp, .webp" id="resim"
                                                            class="form-control" placeholder="image">
                                                    </div>
                                                    <div class="form-group"> <input class="form-control" required
                                                            name="tr" type="text" placeholder="Ürün Adı" /></div>
                                                    <div class="form-group"> <input class="form-control" required
                                                            name="price" type="number" placeholder="Ürün Fiyati" /></div>
                                                    <div class="form-group"> <input class="form-control" name="en"
                                                            type="text" placeholder="İngilizce" /></div>
                                                    <div class="form-group"> <input class="form-control" name="ru"
                                                            type="text" placeholder="Rusça" /></div>
                                                    <div class="form-group"> <input class="form-control" name="ar"
                                                            type="text" placeholder="Arapça" /></div>

                                                    @if ($kategoriler)
                                                        <label for="category">Kategori Seç</label>
                                                        <select class="form-control" name="category"
                                                            aria-label="Kategori Seç">
                                                            @foreach ($kategoriler as $kategori)
                                                                <option value="{{ $kategori->id }}">
                                                                    {{ $kategori->categoryname }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif

                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="submit" type="button">Yeni
                                                            Ekle</button>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>

                            @if ($urunler)
                                @foreach ($urunler as $platform)
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <form action="{{ route('urun.guncelle') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-dialog col-md-4" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-body" id="modal-body-{{ $platform->id }}">
                                                            <input type="hidden" name="no"
                                                                value="{{ $platform->id }}">
                                                            <input class="form-control" required name="tr"
                                                                type="text" placeholder="Ürün Adı"
                                                                value="{{ $platform->tr }}" />
                                                            <input class="form-control" required name="price"
                                                                type="text" placeholder="Ürün Adı"
                                                                value="{{ $platform->price }}" />
                                                            <input class="form-control" name="en" type="text"
                                                                placeholder="İngilizce" value="{{ $platform->en }}" />
                                                            <input class="form-control" name="ru" type="text"
                                                                placeholder="Rusça" value="{{ $platform->ru }}" />
                                                            <input class="form-control" name="ar" type="text"
                                                                placeholder="Arapça" value="{{ $platform->ar }}" />

                                                            @if ($kategoriler)
                                                                <label for="category">Kategori Seç</label>
                                                                <select class="form-control" name="category"
                                                                    aria-label="Kategori Seç">
                                                                    <option>Kategori Seç</option>
                                                                    @foreach ($kategoriler as $kategori)
                                                                        <option value="{{ $kategori->id }}"
                                                                            {{ $platform->category == $kategori->id ? 'selected' : '' }}>
                                                                            {{ $kategori->categoryname }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endif

                                                            <input type="file" name="image" id="resim"
                                                                class="form-control" placeholder="image">

                                                            <img src="{{ asset($platform->image) }}" alt=""
                                                                height="100px" weight="100px">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-warning guncelle-btn" type="submit"
                                                                name="action" value="update"
                                                                style="display: none;">Güncelle</button>
                                                            <button class="btn btn-danger" type="submit" name="action"
                                                                value="delete">Sil</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @else
                    <h1><center>Sistemde Bir Kategori Bulunmuyor<br><a href="{{ route('kategori') }}">Bir Tane Ekle</a></center></h1>
                    @endif



                </div>
            </div>
        </div>



    </div>

    <script>
        // Belirli modal body'leri gizleyen fonksiyon
        // function gizleModalBodies(bodyId) {
        //   var modalBodies = document.querySelectorAll('.modal-body');
        //   modalBodies.forEach(function(modalBody) {
        //     var bodyIde = modalBody.id;
        //     if (bodyIde !== bodyId) {
        //       modalBody.style.display = 'none';
        //       var parentDiv = modalBody.closest('.col-md-3');
        //       if (parentDiv) {
        //         parentDiv.style.display = 'none';
        //       }
        //     }
        //   });
        // }


        // Güncelle butonunu görünür veya görünmez yapma fonksiyonu
        function guncelleButonunuGuncelle(bodyId) {
            var guncelleBtn = document.querySelector(`#${bodyId} + .modal-footer .guncelle-btn`);
            guncelleBtn.style.display = 'block';
            gizleModalBodies(bodyId);
        }

        // Input değişikliklerini izleyen event listener
        document.querySelectorAll('.modal-body input').forEach(function(input) {
            input.addEventListener('input', function() {
                var bodyId = this.parentNode.id;
                guncelleButonunuGuncelle(bodyId);
                gizleModalBodies(bodyId);
            });
        });

        // Dosya seçildiğinde tetiklenecek event listener
        document.querySelectorAll('.modal-body input[type="file"]').forEach(function(inputFile) {
            inputFile.addEventListener('change', function() {
                var bodyId = this.parentNode.id;
                guncelleButonunuGuncelle(bodyId);
                gizleModalBodies(bodyId);
            });
        });


        // Kategori seçimini izleyen event listener
        document.querySelectorAll('.modal-body select').forEach(function(select) {
            select.addEventListener('change', function() {
                var bodyId = this.parentNode.id;
                guncelleButonunuGuncelle(bodyId);
                gizleModalBodies(bodyId);
            });
        });
    </script>
@endsection
