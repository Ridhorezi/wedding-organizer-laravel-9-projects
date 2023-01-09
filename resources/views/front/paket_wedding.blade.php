@extends('front.layouts.master', ['keranjang' => $keranjang, 'web' => $web])

@section('title_menu')
    Paket Wedding
@endsection

@section('title')
    Data Paket Wedding
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('front/css/shop.min.css') }}" />

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
                <h1 class="page_header" style="color: #F4F9F9;">Paket Wedding</h1>
                <p class="page_text" style="color: #ffffff;">___________________________________</p>
            </div>
        </div>
        <div class="container">
            <ul class="page_breadcrumbs d-flex flex-wrap">
                <li class="page_breadcrumbs-item">
                    <a class="link" href="{{ url('/') }}">Beranda</a>
                </li>

                <li class="page_breadcrumbs-item current">
                    <span>Paket Wedding</span>
                </li>
            </ul>
        </div>
    </header>
    <main>
        <!-- Products section start -->
        <div class="shop-wrapper section--nopb">
            <div class="container d-flex flex-lg-row flex-wrap flex-column justify-content-between">
                <div class="shop_products d-flex flex-column">
                    <ul class="shop_products-list d-sm-flex flex-wrap">
                        @foreach ($paket_wedding as $item)
                            @foreach ($item->get_first_foto as $foto)
                                <li class="shop_products-list_item col-sm-6 col-md-4 col-lg-6 col-xl-4" data-order="1">
                                    <div class="wrapper d-flex flex-column">
                                        <div class="media">

                                            <div
                                                class="overlay d-flex flex-column align-items-center justify-content-center">
                                                <ul class="action d-flex align-items-center justify-content-center">
                                                    <li class="list-item">
                                                        <input type="hidden" name="paket_wedding_id"
                                                            id="paketWeddingId{{ $item->id }}"
                                                            value="{{ $item->id }}">
                                                        @if (Auth::guard('web')->user())
                                                            <input type="hidden" name="user_id"
                                                                id="userId{{ $item->id }}"
                                                                value="{{ isset(Auth::guard('web')->user()->id) ? Auth::guard('web')->user()->id : '' }}">
                                                        @endif
                                                        @if (Auth::guard('web')->user())
                                                            @php
                                                                $check = \App\Models\Pemesanan::where('user_id', Auth::guard('web')->user()->id)->count();
                                                            @endphp
                                                            @if ($check >= 1)
                                                                <a href="{{ route('pemesanan-wa', Auth::guard('web')->user()->id) }}"
                                                                    type="button"
                                                                    class="action_link d-flex align-items-center justify-content-center">
                                                                    <i class="icon-basket"></i>
                                                                </a>
                                                            @else
                                                                <button type="button"
                                                                    class="action_link d-flex align-items-center justify-content-center"
                                                                    onclick="keranjangButtonInPaketWeeding({{ $item->id }})">
                                                                    <i class="icon-basket"></i>
                                                                </button>
                                                            @endif
                                                        @else
                                                            <a data-bs-toggle="offcanvas" data-bs-target="#loginCanvas"
                                                                class="action_link d-flex align-items-center justify-content-center">
                                                                <i class="icon-basket"></i>
                                                            </a>
                                                        @endif
                                                    </li>
                                                    <li class="list-item">
                                                        <a class="action_link d-flex align-items-center justify-content-center"
                                                            href="{{ url('paket-wedding', $item->slug) }}">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <picture>
                                                <source data-srcset="{{ asset('paket_wedding/' . $foto->url) }}"
                                                    srcset="{{ asset('paket_wedding/' . $foto->url) }}"
                                                    type="image/webp" />
                                                <img class="lazy" data-src="{{ asset('paket_wedding/' . $foto->url) }}"
                                                    src="{{ asset('paket_wedding/' . $foto->url) }}" alt="media" />
                                            </picture>
                                            </a>
                                        </div>
                                        <div class="main d-flex flex-column">
                                            <div class="main_rating">
                                                <ul class="main_rating-stars d-flex align-items-center accent">
                                                    <li class="main_rating-stars_star">
                                                        <i class="icon-star_fill"></i>
                                                    </li>
                                                    <li class="main_rating-stars_star">
                                                        <i class="icon-star_fill"></i>
                                                    </li>
                                                    <li class="main_rating-stars_star">
                                                        <i class="icon-star_fill"></i>
                                                    </li>
                                                    <li class="main_rating-stars_star">
                                                        <i class="icon-star_fill"></i>
                                                    </li>
                                                    <li class="main_rating-stars_star">
                                                        <i class="icon-star_fill"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <a class="main_title"
                                                href="{{ url('paket-wedding', $foto->paket_wedding->slug) }}"
                                                target="_blank"
                                                rel="noopener norefferer">{{ $foto->paket_wedding->nama_paket }}</a>
                                            <div class="main_price">
                                                <span class="price">RP.
                                                    {{ number_format((float) $foto->paket_wedding->harga_paket, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                    {{ $paket_wedding->links('vendor.pagination.custom') }}

                </div>
            </div>
        </div>
    </main>

    <!-- Top products section start -->
    <section class="top section">

    </section>
    <!-- Top products section end -->
@endsection

@section('js')
    <script src="{{ asset('front/js/shop.min.js') }}"></script>
    <script>
        function keranjangButtonInPaketWeeding(dataId) {
            var paket_wedding_id = $("#paketWeddingId" + dataId).val();
            var user_id = $("#userId" + dataId).val();
            var jumlah_paket = 1;

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
        }
    </script>
@endsection
