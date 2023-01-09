@extends('front.layouts.master', ['keranjang' => $keranjang, 'web' => $web])

@section('title_menu')
    Paket Wedding
@endsection

@section('title')
    Data Paket Wedding
@endsection

@section('css')
@endsection

@section('content')
    <!-- Hero section start -->
    <section class="hero">
        <div class="container d-xl-flex align-items-start">
            <div class="hero_about col-xl-6">
                <div class="hero_header">
                    <h2 class="hero_header-title" style="color: #440A67;">Mari Rencanakan Pernikahan Yang Sempurna Bersama
                        Dinar Wullan Wedding</h2>
                    <p class="hero_header-text" style="color: black">
                        Persiapkan Pernikahan dengan Beragam Kemudahan & Penawaran Ekslusif
                    </p>
                    <a class="hero_header-btn btn" href="{{ route('paket-wedding') }}">Produk Kami</a>
                </div>
            </div>
            <div class="hero_promo col-xl-6">
                <div>
                    <picture>
                        <source data-srcset="{{ asset('home-background-1.jpg') }}"
                            srcset="{{ asset('home-background-1.jpg') }}" type="image/webp" />
                        <img class="lazy" style="border-radius:7px;" data-src="{{ asset('home-background-1.jpg') }}"
                            src="{{ asset('home-background-1.jpg') }}" alt="media" />
                    </picture>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero section end -->
    <!-- Featured products section start -->
    <section class="featured section--nopb">
        <div class="container">
            <div class="featured_header">
                <h2 class="featured_header-title" style="color: #440A67;">Paket Pilihan</h2>
                <p class="featured_header-text" style="color: black;">
                    Tersedia beragam paket menarik yang dapat anda pilih.
                </p>
            </div>
            <div class="products_list d-grid">
                @foreach ($paket_wedding as $item)
                    <div class="products_list-item">
                        @foreach ($item->get_first_foto as $foto)
                            <div class="products_list-item_wrapper d-flex flex-column">
                                <div class="media">
                                    <a href="{{ url('paket-wedding', $item->slug) }}" rel="noopener norefferer"
                                        style="width: 100% !important;">
                                        <picture style="width: 100% !important;">
                                            <img class="lazy preview" data-src="{{ asset('paket_wedding/' . $foto->url) }}"
                                                src="{{ asset('paket_wedding/' . $foto->url) }}" alt="Product"
                                                style="height: 300px !important; width: 100% !important; object-fit: cover;" />
                                        </picture>
                                    </a>
                                </div>
                                <div class="main d-flex flex-column align-items-center justify-content-between">
                                    <div class="main_rating">
                                        <ul
                                            class="main_rating-stars d-flex align-items-center justify-content-center accent">
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
                                    <a class="main_title" href="{{ url('paket-wedding', $foto->paket_wedding->slug) }}"
                                        rel="noopener norefferer">{{ $foto->paket_wedding->nama_paket }}</a>
                                    <div class="main_price">
                                        <span class="price">Rp .
                                            {{ number_format((float) $foto->paket_wedding->harga_paket, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <a class="featured_btn btn" href="{{ url('paket-wedding') }}">Lihat Paket Wedding</a>
        </div>
    </section>
    <!-- Instagram section start -->
    <section class="instagram" style="margin-top: 100px;">
        <div class="container">
            <div class="instagram_header">
                <h2 class="instagram_header-title" style="color: #440A67;">Ikuti Kita di Instagram</h2>
                <p class="instagram_header-text" style="color:black;">
                    Galleri yang indah bukti pencapaian dan kulitas dari jasa yang kami sediakan.
                </p>
            </div>
        </div>
        <div class="instagram_slider swiper">
            <div class="swiper-wrapper">
                <div class="instagram_slider-slide swiper-slide">
                    <a class="link" href="https://instagram.com" target="_blank" rel="noopener norefferer">
                        <picture>
                            <source data-srcset="{{ asset('footer-1.jpg') }}" srcset="{{ asset('footer-1.jpg') }}"
                                type="image/webp" />
                            <img class="lazy" data-src="{{ asset('footer-1.jpg') }}" src="{{ asset('footer-1.jpg') }}"
                                style="object-fit: cover;height: 400px;" alt="instagram post" />
                        </picture>
                        <span class="overlay d-flex justify-content-center align-items-center">
                            <i class="icon-instagram"></i>
                        </span>
                    </a>
                </div>
                <div class="instagram_slider-slide swiper-slide">
                    <a class="link" href="https://instagram.com" target="_blank" rel="noopener norefferer">
                        <picture>
                            <source data-srcset="{{ asset('footer-2.jpg') }}" srcset="{{ asset('footer-2.jpg') }}"
                                type="image/webp" />
                            <img class="lazy" data-src="{{ asset('footer-2.jpg') }}" src="{{ asset('footer-2.jpg') }}"
                                style="object-fit: cover;height: 400px;" alt="instagram post" />
                        </picture>
                        <span class="overlay d-flex justify-content-center align-items-center">
                            <i class="icon-instagram"></i>
                        </span>
                    </a>
                </div>
                <div class="instagram_slider-slide swiper-slide">
                    <a class="link" href="https://instagram.com" target="_blank" rel="noopener norefferer">
                        <picture>
                            <source data-srcset="{{ asset('footer-3.jpg') }}" srcset="{{ asset('footer-3.jpg') }}"
                                type="image/webp" />
                            <img class="lazy" data-src="{{ asset('footer-3.jpg') }}"
                                src="{{ asset('footer-3.jpg') }}" style="object-fit: cover;height: 400px;"
                                alt="instagram post" />
                        </picture>
                        <span class="overlay d-flex justify-content-center align-items-center">
                            <i class="icon-instagram"></i>
                        </span>
                    </a>
                </div>
                <div class="instagram_slider-slide swiper-slide">
                    <a class="link" href="https://instagram.com" target="_blank" rel="noopener norefferer">
                        <picture>
                            <source data-srcset="{{ asset('footer-4.jpg') }}" srcset="{{ asset('footer-4.jpg') }}"
                                type="image/webp" />
                            <img class="lazy" data-src="{{ asset('footer-4.jpg') }}"
                                src="{{ asset('footer-4.jpg') }}" style="object-fit: cover;height: 400px;"
                                alt="instagram post" />
                        </picture>
                        <span class="overlay d-flex justify-content-center align-items-center">
                            <i class="icon-instagram"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
