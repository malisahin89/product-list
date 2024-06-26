<!DOCTYPE html>
<html lang="tr">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /********** Template CSS **********/
        :root {
            --primary: #3CB815;
            --secondary: #F65005;
            --light: #F7F8FC;
            --dark: #111111;
        }

        .back-to-top {
            position: fixed;
            display: none;
            right: 30px;
            bottom: 30px;
            z-index: 99;
        }

        /*** Product ***/
        .nav-pills .nav-item .btn {
            color: var(--dark);
        }

        .nav-pills .nav-item .btn:hover,
        .nav-pills .nav-item .btn.active {
            color: #FFFFFF;
        }

        .product-item {
            box-shadow: 0 0 45px rgba(0, 0, 0, .07);
        }

        .product-item img {
            transition: .5s;
        }

        .product-item:hover img {
            transform: scale(1.1);
        }

        .product-item small a:hover {
            color: var(--primary) !important;
        }
    </style>
</head>

<body>



    <!-- HEADER -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $companyData->marka }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="https://facebook.com/{{ $companyData->facebook }}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://twitter.com/{{ $companyData->twitter }}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://instagram.com/{{ $companyData->instagram }}" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://youtube.com/{{ $companyData->youtube }}" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- HEADER -->



    <!-- Product Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-4">
                    <div class="section-header text-start mb-5" style="max-width: 500px;">
                        <h1 class="display-5 mb-3">{{ $companyData->marka }}</h1>
                        <p>{{ $companyData->aciklama }}</p>
                    </div>
                </div>
                <div class="col-lg-8 text-start text-lg-end ">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">


                        @if ($kategoriler)
                            {{-- array_keys(json_decode($json_data, true)) --}}
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary border-2 active" data-bs-toggle="pill"
                                    href="#tab-x">Tümü</a>
                            </li>
                            @foreach ($kategoriler as $key => $grup)
                                @if (in_array($grup->id, array_keys(json_decode($urunler, true))))
                                    <li class="nav-item me-{{ count($kategoriler) - 1 == $key ? '0' : '2' }}">
                                        <a class="btn btn-outline-primary border-2" data-bs-toggle="pill"
                                            href="#tab-{{ $grup->id }}">{{ $grup->categoryname }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif



                    </ul>
                </div>
            </div>
            <div class="tab-content">




                @if ($urunler)

                    <div id="tab-x" class="tab-pane fade active show">
                        <div class="row g-4">
                            @foreach ($urunler as $key => $urun1)
                                @foreach ($urun1 as $key => $urun)
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="product-item">
                                            <div class="position-relative bg-light overflow-hidden">
                                                <img class="img-fluid" style="height: 295.98px"
                                                    src="{{ $urun->image }}" alt="">
                                                <div
                                                    class="bg-danger rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                                    Yeni Ürün</div>
                                            </div>

                                            <div class="d-flex border-bottom">
                                                <small
                                                    class="w-50 text-center border-end py-2">{{ $urun->en }}</small>
                                                <small
                                                    class="w-50 text-center border-end py-2">{{ $urun->ru }}</small>
                                                <small class="w-50 text-center py-2">{{ $urun->ar }}</small>
                                            </div>

                                            <div class="text-center p-4">
                                                <p class="d-block h5 mb-2" href="">{{ $urun->tr }}</p>
                                                <span class="text-primary me-1">{{ $urun->price }} ₺</span>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>


                    @foreach ($urunler as $key => $value)
                        <div id="tab-{{ $key }}" class="tab-pane fade">
                            <div class="row g-4">
                                @foreach ($value as $key1 => $urun)
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="product-item">
                                            <div class="position-relative bg-light overflow-hidden">
                                                <img class="img-fluid" style="height: 295.98px"
                                                    src="{{ $urun->image }}" alt="">
                                                {{-- <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3"> New</div> --}}
                                            </div>

                                            <div class="d-flex border-bottom">
                                                <small
                                                    class="w-50 text-center border-end py-2">{{ $urun->en }}</small>
                                                <small
                                                    class="w-50 text-center border-end py-2">{{ $urun->ru }}</small>
                                                <small class="w-50 text-center py-2">{{ $urun->ar }}</small>
                                            </div>

                                            <div class="text-center p-4">
                                                <p class="d-block h5 mb-2" href="">{{ $urun->tr }}</p>
                                                <span class="text-primary me-1">{{ $urun->price }} ₺</span>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif



            </div>
        </div>
    </div>
    <!-- Product End -->





    <!-- FOOTER -->

    <footer class="bg-light text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">{{ $companyData->marka }}</h5>
                    <p>{{ $companyData->footerveri }}</p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="{{ $companyData->web }}" class="text-dark">Link 1</a>
                        </li>
                        <li>
                            <a href="{{ $companyData->web }}" class="text-dark">Link 2</a>
                        </li>
                        <li>
                            <a href="{{ $companyData->web }}" class="text-dark">Link 3</a>
                        </li>
                        <li>
                            <a href="{{ $companyData->web }}" class="text-dark">Link 4</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Social Media</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="https://facebook.com/{{ $companyData->facebook }}" class="text-dark" target="_blank">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/{{ $companyData->twitter }}" class="text-dark" target="_blank">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                        </li>
                        <li>
                            <a href="https://instagram.com/{{ $companyData->instagram }}" class="text-dark" target="_blank">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://youtube.com/{{ $companyData->youtube }}" class="text-dark" target="_blank">
                                <i class="fab fa-youtube"></i> Youtube
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center p-3 bg-dark text-white">
            © {{ date('Y') }} Copyright <a class="text-white"
                href="{{ url('/') }}">{{ $companyData->marka }}</a>
            <p>Backend By <a href="https://github.com/malisahin89">@malisahin89</a></p>

        </div>
    </footer>
    <!-- FOOTER -->





    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</body>

</html>
