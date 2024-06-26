@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- jQuery UI (for sortable feature) -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <style>
        /* Liste öğelerine çerçeve ve stil vermek için CSS */
        .sortable-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sortable-item {
            border: 1px solid #ccc;
            /* Çerçeve rengi ve kalınlığı */
            border-radius: 5px;
            /* Köşelerin yuvarlatılması */
            padding: 10px;
            /* İç boşluk */
            margin-bottom: 10px;
            /* Öğeler arasındaki boşluk */
            background-color: #f9f9f9;
            /* Arka plan rengi */
            cursor: grab;
            /* Sürükleyebilir işareti */
        }

        /* Sürüklenen öğeye gölge efekti */
        .sortable-item.ui-sortable-helper {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            /* Gölge rengi ve boyutu */
            z-index: 1000;
            /* Diğer öğelerin üzerinde olmasını sağlar */
        }
    </style>
    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ $companyData->marka }} Admin Paneli V0.1 | By @malisahin89</div>
                        <form id="urunlersirala">
                            <div class="card-body">
                                <ul id="sortable" class="sortable-list sortable">
                                    @foreach ($urunler as $urun)
                                        <li class="sortable-item">
                                            <input type="hidden" class="veri" name="{{ $urun->id }}"
                                                data-id="{{ $urun->sira }}">
                                            <p>{{ $urun->tr }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="form-group col-md-4 align-self-end">
                                    <button class="btn btn-primary" type="submit" name="action"
                                        value="update">Güncelle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>






        <script>
            $(function() {
                $("#sortable").sortable({
                    update: function(event, ui) {
                        updateDataIds();
                    }
                });
                $("#sortable").disableSelection();
            });

            // Tüm öğelerin data-id özelliğini güncelleyen fonksiyon
            function updateDataIds() {
                $(".veri").each(function(index) {
                    $(this).attr("data-id", index + 1);
                });
            }



            $("#urunlersirala").submit(function(event) {
                event.preventDefault(); // Formun normal submit işlemini engelle

                var formData = [];

                // Tüm veri inputlarını dolaş ve verileri topla
                $('#sortable .veri').each(function() {
                    var name = $(this).attr('name');
                    var dataId = $(this).data('id');
                    formData.push({ name: name, data_id: dataId });
                });

                $.ajax({
                    url: "{{ route('urun.sirala.update') }}", // Sunucu tarafında işlenecek endpoint
                    type: "POST",
                    data:  {data:formData} ,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel için CSRF token
                    },
                    success: function(response) {
                        alert('Kategoriler başarıyla güncellendi!');
                        console.log(response);

                    },
                    error: function(xhr, status, error) {
                        alert('Kategoriler güncellenirken bir hata oluştu!');
                    }
                });
            });

        </script>
    @endsection
