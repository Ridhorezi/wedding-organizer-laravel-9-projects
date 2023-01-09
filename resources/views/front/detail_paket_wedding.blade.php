@extends('front.layouts.master', ['keranjang' => $keranjang, 'web' => $web])


@section('title_menu')
    Paket Wedding
@endsection

@section('title')
    Data Paket Wedding
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('front/css/product.css') }}" />
    <style>
        .page_main {
            padding: 60px 0;
            background: #440A67;
            text-align: center;
            margin-bottom: 30px
        }
    </style>
@endsection

@section('content')
    <header class="page" style="margin-top: 140px;">
        <div class="page_main container-fluid">
            <div class="container">
                <h1 class="page_header" style="color: #ffffff;">Detail Paket</h1>
                <p class="page_text" style="color: #ffffff;">___________________________________</p>
            </div>
        </div>
        <div class="container">
            <ul class="page_breadcrumbs d-flex flex-wrap">
                <li class="page_breadcrumbs-item">
                    <a class="link" href="{{ url('/') }}">Beranda</a>
                </li>

                <li class="page_breadcrumbs-item current">
                    <span>Detail Paket</span>
                </li>
            </ul>
        </div>
    </header>
    <section class="about section--nopb">
        <div class="container">
            <!-- Product main -->
            <div class="about_main d-lg-flex flex-nowrap">
                <div class="about_main-slider">
                    <div class="about_main-slider--single" data-modal="false">
                        <div class="swiper-wrapper">
                            @foreach ($paket_wedding->get_all_foto as $foto)
                                <div class="swiper-slide">
                                    <a href="{{ asset('paket_wedding/' . $foto->url) }}" data-role="gallery">
                                        <picture>
                                            <source data-srcset="{{ asset('paket_wedding/' . $foto->url) }}"
                                                srcset="{{ asset('paket_wedding/' . $foto->url) }}" type="image/webp" />
                                            <img class="lazy" data-src="{{ asset('paket_wedding/' . $foto->url) }}"
                                                src="{{ asset('paket_wedding/' . $foto->url) }}" alt="media" />
                                        </picture>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-controls d-flex align-items-center justify-content-between">
                            <a class="swiper-button-prev d-inline-flex align-items-center justify-content-center"
                                href="#">
                                <i class="icon-caret_left icon"></i>
                            </a>
                            <a class="swiper-button-next d-inline-flex align-items-center justify-content-center"
                                href="#">
                                <i class="icon-caret_right icon"></i>
                            </a>
                        </div>
                    </div>
                    <div class="about_main-slider--thumbs">
                        <div class="swiper-wrapper">
                            @foreach ($paket_wedding->get_all_foto as $foto)
                                <div class="swiper-slide">
                                    <picture>
                                        <source data-srcset="{{ asset('paket_wedding/' . $foto->url) }}"
                                            srcset="{{ asset('paket_wedding/' . $foto->url) }}" type="image/webp" />
                                        <img class="lazy" data-src="{{ asset('paket_wedding/' . $foto->url) }}"
                                            src="{{ asset('paket_wedding/' . $foto->url) }}" alt="media" />
                                    </picture>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="about_main-info">
                    <div class="about_main-info_product d-sm-flex align-items-center justify-content-between">
                        <h2 class="title">{{ $paket_wedding->nama_paket }}</h2>
                    </div>
                    <div class="about_main-info_rating d-flex align-items-center">
                        <ul class="stars d-flex align-items-center accent">
                            <li class="stars_star">
                                <i class="icon-star_fill"></i>
                            </li>
                            <li class="stars_star">
                                <i class="icon-star_fill"></i>
                            </li>
                            <li class="stars_star">
                                <i class="icon-star_fill"></i>
                            </li>
                            <li class="stars_star">
                                <i class="icon-star_fill"></i>
                            </li>
                            <li class="stars_star">
                                <i class="icon-star_fill"></i>
                            </li>
                        </ul>
                        {{-- <a class="reviews-amount" href="#reviews">(2 customer reviews)</a> --}}
                    </div>
                    <p class="about_main-info_description">
                        {!! $paket_wedding->deskripsi_paket !!}
                    </p>
                    <br>
                    <div class="qty_plus"></div>
                    <div class="qty_minus"></div>

                    <span class="about_main-info_price">RP.
                        {{ number_format((float) $paket_wedding->harga_paket, 0, ',', '.') }} </span>
                    <div class="about_main-info_buy d-flex align-items-center">
                        <div class="qty d-flex align-items-center justify-content-between">
                            <span class="d-flex align-items-center" id="kurang" style="color: #c6c6c6;">
                                <i class="icon-minus"></i>
                            </span>

                            <input class="qty_amount" type="number" readonly value="1" min="1" max="99"
                                id="jumlah_paket" name="jumlah_paket" />

                            <span class="d-flex align-items-center" id="tambah">
                                <i class="icon-plus"></i>
                            </span>
                        </div>
                        <form action="#" method="post">
                            @if (Auth::guard('web')->user())
                                <input type="hidden" name="paket_wedding_id" value="{{ $paket_wedding->id }}">
                                <input type="hidden" name="user_id"
                                    value="{{ isset(Auth::guard('web')->user()->id) ? Auth::guard('web')->user()->id : '' }}">
                                @php
                                    $check = \App\Models\Pemesanan::where('user_id', Auth::guard('web')->user()->id)->count();
                                @endphp
                                @if ($check >= 1)
                                    <div style="display: flex; justify-conten: center;">
                                        <a href="{{ route('pemesanan-wa', Auth::guard('web')->user()->id) }}"
                                            class="btn" style="font-size: 15px;margin-top: 20px !important;">Tambah Ke
                                            Keranjang</a>
                                    </div>
                                @else
                                    <button type="button" class="btn" id="keranjangButton">Tambah Ke Keranjang</button>
                                @endif
                            @else
                                <a data-bs-toggle="offcanvas" data-bs-target="#loginCanvas" class="btn">Tambah Ke
                                    Keranjang</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <!-- Product additional information -->
            <div class="about_secondary">
                <div class="about_secondary-content">
                    <ul class="about_secondary-content_nav nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <div class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" role="tab" aria-selected="true">
                                Deskripsi
                            </div>
                        </li>
                    </ul>
                    <div class="about_secondary-content_tabs tab-content" id="productTabs">
                        <div class="wrapper">
                            <h4 class="accordion_component-item_header d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse" data-bs-target="#description" aria-expanded="true">
                                Description
                                <i class="icon-caret_down transform icon"></i>
                            </h4>
                            <div class="tab-pane collapse show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab" data-bs-parent="#productTabs">
                                <p class="text">
                                    {!! $paket_wedding->deskripsi_paket !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Top products section start -->
    <section class="top section">
        <div class="container">
            <h2 class="top_header">Paket Lainnya</h2>
            <ul class="top_list d-lg-flex flex-wrap">
                @foreach ($paket_wedding_random as $item)
                    <li class="top_list-item col-lg-6" data-order="1">
                        <div class="top_list-item_wrapper d-flex flex-column flex-sm-row flex-lg-column flex-xxl-row">
                            <div class="media">
                                <a href="{{ url('paket-wedding', $item->paket_wedding->slug) }}"
                                    rel="noopener norefferer">
                                    <picture>
                                        <source data-srcset="{{ asset('paket_wedding/' . $item->url) }}"
                                            srcset="{{ asset('paket_wedding/' . $item->url) }}" type="image/webp" />
                                        <img class="lazy" data-src="{{ asset('paket_wedding/' . $item->url) }}"
                                            src="{{ asset('paket_wedding/' . $item->url) }}" alt="media" />
                                    </picture>
                                </a>
                            </div>
                            <div class="main">
                                <a class="main_title" href="{{ url('paket-wedding', $item->paket_wedding->slug) }}"
                                    rel="noopener norefferer">{{ $item->paket_wedding->nama_paket }}</a>
                                <div class="main_price">
                                    {{-- <span class="price price--old">$45.99</span> --}}
                                    <span class="price price--new">RP.
                                        {{ number_format((float) $item->paket_wedding->harga_paket, 0, ',', '.') }} </span>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <!-- Top products section end -->
@endsection

@section('js')
    <script src="{{ asset('front/js/shop.min.js') }}"></script>

    <script>
        $("#keranjangButton").click(function() {
            var paket_wedding_id = $("input[name=paket_wedding_id]").val();
            var user_id = $("input[name=user_id]").val();
            var jumlah_paket = $("input[name=jumlah_paket]").val();

            $.ajax({
                url: "{{ route('keranjang.store') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    paket_wedding_id: paket_wedding_id,
                    user_id: user_id,
                    jumlah_paket: jumlah_paket
                },
                success: function(data) {
                    console.log(data);
                    if (data[0] == "berhasil") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Paket telah berhasil ditambahkan ke keranjang!',
                        }).then(function() {
                            location.reload();
                        });
                    } else if (data == "gagal") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Paket gagal ditambahkan ke keranjang!',
                        }).then(function() {
                            location.reload();
                        });
                    }
                }
            });


        });

        var min = 1,
            max = 13;

        $("#tambah").click(function() {
            if ($("#jumlah_paket").val() < max && $("#jumlah_paket").val() >= min)
                $("#jumlah_paket").val(Number($("#jumlah_paket").val()) + 1); // increment
        });

        $("#kurang").click(function() {
            if ($("#jumlah_paket").val() <= max && $("#jumlah_paket").val() > min)
                $("#jumlah_paket").val(Number($("#jumlah_paket").val()) - 1); // decrement
        });
    </script>
@endsection
