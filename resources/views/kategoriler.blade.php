@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- @foreach ($kategoriler as $kategori)

                        <li class="maddeitem" id="textbox2">
                            <input type="hidden" class="siralar" name="sira[]" value="{{ $kategori->id }}">
                            <input type="text" class="form-control"
                                name="kategorimaddeler[]2" style="margin-left: 10px;margin-right:10px;"
                                placeholder="Madde Giriniz" autocomplete="off" value="{{ $kategori->categoryname }}"
                                required=""> <span class="handle" title="Sürükle Bırak">☰</span><button type="button"
                                class="btn btn-sm btn-danger maddesil"> <i class="fas fa-trash-alt"></i> SİL</button> </li>
                    @endforeach --}}



    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- jQuery UI (for sortable feature) -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        /* Custom CSS */
        .sortable {
            list-style-type: none;
            margin: 0 0 15px 0;
            padding: 0;
            width: 100%;
        }

        .sortable li {
            margin: 0 5px 15px 5px;
            padding: 5px;
            font-size: 1.2em;
            height: 50px;
            line-height: 1.2em;
        }

        .sortable li:hover {
            cursor: move;
        }

        .sortable li input {
            width: 90%;
            float: left;
        }

        .sortable li .btn {
            float: right;
            margin-top: 4px;
            margin-right: 6px;
        }

        .ui-state-highlight {
            height: 1.5em;
            line-height: 1.2em;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #ccc;
            outline: none;
            background-color: transparent;
            box-shadow: none;
            padding: 5px 0;
            transition: border-color 0.3s;
            border-radius: 0%;
        }

        .form-control:focus {
            border-bottom: 2px solid #007bff;
            transition: border-color 0.3s;
            box-shadow: none;
        }

        .list-group-item {
            cursor: move;
            user-select: none;
        }

        .handle {
            cursor: grab;
            margin-right: 5px;
            color: #007bff;
        }

        .maddeitem {
    display: flex;
    align-items: center;
}

.maddeitem .handle {
    margin-right: 5px;
    color: #007bff;
}

.maddeitem .maddesil {
    margin-left: auto; /* Butonu sağa hizalar */
}
    </style>
    </head>

    <body>
        <div class="container mt-5">
            <h2 class="mb-4">Kategori Ekle</h2>
            <div class="input-group mb-3">
                <input type="text" id="newTodo" class="form-control" placeholder="Yeni Kategori İsmi">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="addButton">Ekle</button>
                </div>
            </div>
            <form id="categoryEdit" enctype="multipart/form-data">
                <div class="tile-body addcard">
                    <ul class="sortable">
                        @foreach ($kategoriler as $kategori)
                            <li class="maddeitem" id="textbox2">
                                <input type="hidden" class="siralar" name="sira[]" value="{{ $kategori->id }}">

                                <input type="text" class="form-control" name="kategorimaddeler[]" style="margin-left: 10px;margin-right:10px;"
                                    placeholder="Madde Giriniz" autocomplete="off" value="{{ $kategori->categoryname }}" required="">
                                    <span class="handle" title="Sürükle Bırak">☰</span>
                                    <button type="button" class="btn btn-sm btn-danger maddesil">
                                        <i class="fas fa-trash-alt"></i>SİL
                                    </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="form-group col-md-4 align-self-end">
                    <button class="btn btn-primary" type="submit" name="action" value="update">Güncelle</button>
                </div>
            </form>
        </div>
        <script>
            $(document).ready(function() {

                // Madde ekleme işlemi için addButton'a tıklama olayı ekleme
                var counter = 2;
                $("#addButton").click(function() {
                    var todoText = $("#newTodo").val();
                    if (todoText !== "") {
                        $(".sortable").append(
                            '<li class="maddeitem" id="textbox' + counter +
                            '" > <input type="hidden"  class="siralar"  name="sira[]" value="ekle' +
                            counter + '"><input type="text" class="form-control" name="kategorimaddeler[]' +
                            counter +
                            '" class="sort" style="margin-left: 10px;margin-right:10px;" placeholder="Madde Giriniz" autocomplete="off" value="' +
                            todoText +
                            '" required> <span class="handle" title="Sürükle Bırak">&#9776;</span><button type="button" class="btn btn-sm btn-danger maddesil"> <i class="fas fa-trash-alt"></i> SİL</button> </li>'
                        );
                        $("#newTodo").val("");
                        counter++;
                    } else {
                        alert("Lütfen bir kategori adı girin.");
                    }
                });

                // Kategoriyi silme
                $(document).on("click", ".maddesil", function() {
                    silid = $(this).closest('.maddeitem').find('.siralar').val();
                    $(this).closest('.maddeitem').find('.siralar').val(silid + 'sil');
                    $(this).closest('.maddeitem').hide();
                });

                // Sürükle bırak özelliği
                $('.sortable').sortable();

                // Form verilerini güncelleme
                $('#categoryEdit').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({

                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('kategori.ekle') }}',
                        data: formData,
                        success: function(data) {
                            $('.maddeitem:hidden').remove();
                            alert('Kategoriler başarıyla güncellendi!');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Kategoriler güncellenirken bir hata oluştu!');
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                });




            });
        </script>
    @endsection
