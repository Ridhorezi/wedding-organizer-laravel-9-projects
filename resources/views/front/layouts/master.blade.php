<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dinar Wulan Wedding Organizer | Profesional Wedding Organizer at Serang, Banten - Indonesia</title>
    <link rel="stylesheet preload" as="style" href="{{ asset('front/css/preload.min.css') }}" />
    <link rel="stylesheet preload" as="style" href="{{ asset('front/css/icomoon.css') }}" />
    <link rel="stylesheet preload" as="style" href="{{ asset('front/css/libs.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/index.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
    <style>
        label.error {
            color: #f1556c;
            font-size: 13px;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.5;
            margin-top: 5px;
            padding: 0;
        }

        input.error {
            color: #f1556c;
            border: 1px solid #f1556c;
        }

        .alert {
            background: #f1556c;
            color: #ffffff;
            padding: 30px;
            margin-bottom: 20px;
            display: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .btn-logout {
            width: 50% !important;
        }
    </style>
</head>

<body>
    <header class="header d-flex flex-wrap align-items-center" data-page="home" data-overlay="true">
        <div class="container d-flex flex-wrap flex-xl-nowrap align-items-center justify-content-between">
            <a class="brand header_logo d-flex align-items-center" href="{{ url('/') }}">
                <span class="logo">
                    @foreach ($web as $data)
                        <img class="logo-img" src="{{ isset($data) ? asset('profile/' . $data->logo) : '' }}">
                    @endforeach
                </span>

                @if (count($web) < 1)
                    <span class="accent">Wedding Organizer</span>
                @endif
            </a>
            <nav class="header_nav">
                <ul class="header_nav-list">
                    <li class="header_nav-list_item">
                        <a class="nav-link d-inline-flex align-items-center" style="color: #440A67;"
                            href="{{ url('/') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="header_nav-list_item">
                        <a class="nav-link d-inline-flex align-items-center" style="color:#440A67;"
                            href="{{ url('paket-wedding') }}">
                            Paket Wedding
                        </a>
                    </li>
                </ul>
            </nav>
            <span class="header_trigger d-inline-flex d-xl-none flex-column justify-content-between">
                <span class="line line--short"></span>
                <span class="line line"></span>
                <span class="line line--short"></span>
                <span class="line line"></span>
            </span>
            <div class="header_user d-flex justify-content-end align-items-center">
                <a class="header_user-action d-inline-flex align-items-center justify-content-center"
                    data-bs-toggle="offcanvas"
                    @if (Auth::guard('web')->user()) data-bs-target="#cartOffcanvas"
                        @else
                        data-bs-target="#loginCartCanvas" @endif
                    aria-controls="cartOffcanvas">
                    <i class="icon-basket"></i>
                </a>
                @if (Auth::guard('web')->user())
                    <a href="" style="margin-left: 10px;" data-bs-toggle="offcanvas"
                        data-bs-target="#logoutCanvas"
                        aria-controls="cartOffcanvas"><span>{{ Auth::guard('web')->user()->nama }}</span></a>
                    <span><i class="fas fa-sort-down" style="margin-left: 5px;margin-bottom: 15px;"></i></span>
                @else
                    <a class="header_user-action d-inline-flex align-items-center justify-content-center"
                        id="loginButtonTop" data-bs-toggle="offcanvas" data-bs-target="#loginCanvas"
                        aria-controls="cartOffcanvas">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </a>
                @endif
            </div>
        </div>
    </header>
    <!-- Homepage content start -->
    <main>
        @yield('content')
    </main>
    <!-- Homepage content end -->
    <footer class="footer">
        <div class="footer_main section">
            <div class="container d-flex flex-column flex-md-row flex-wrap flex-xl-nowrap justify-content-xl-between">
                <div class="footer_main-about footer_main-block col-md-6 col-xl-auto">
                    <h4 class="brand footer_main-about_brand d-flex mt-5 align-items-center" style="color: #fff;">Sosial
                        Media</h4>
                    <div class="footer_main-about_wrapper mt-4">
                        @foreach ($web as $data)
                        @endforeach
                        @if (count($web) < 1)
                            <p class="text">
                                Isi data profile di admin
                            </p>
                        @endif
                        <ul class="socials d-flex align-items-center accent">
                            @foreach ($web as $data)
                                <li class="list-item">
                                    <a class="link" href="https://facebook.com/{{ $data->facebook }}"
                                        rel="noopener norefferer">
                                        <i class="icon-facebook icon"></i>
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="link" href="https://instagram.com/{{ $data->instagram }}"
                                        rel="noopener norefferer">
                                        <i class="icon-instagram icon"></i>
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="link" href="mailto:{{ $data->email }}" rel="noopener norefferer">
                                        <i class="icon-mail icon"></i>
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a class="link" href="https://wa.me/{{ $data->whatsapp }}"
                                        rel="noopener norefferer">
                                        <i class="icon-whatsapp icon"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="footer_main-contacts footer_main-block col-md-6 col-xl-auto">
                    <h4 class="footer_main-contacts_header footer_main-header">Lokasi Dan Informasi</h4>
                    <ul class="footer_main-contacts_list">

                        <li class="list-item d-flex align-items-center">
                            <span class="icon d-flex justify-content-center align-items-center">
                                <i class="icon-location" style="color: #440A67"></i>
                            </span>
                            <div class="wrapper d-flex flex-column">
                                @foreach ($web as $data)
                                    <span class="text-size">
                                        {{ $data->address }}
                                    </span>
                                @endforeach
                            </div>
                        </li>

                        <li class="list-item d-flex align-items-center">
                            <span class="icon d-flex justify-content-center align-items-center">
                                <i class="icon-clock" style="color: #440A67"></i>
                            </span>
                            <div class="wrapper d-flex flex-column">
                                <span>9:00 am to 5:00 pm</span>
                                <span>Senin - Sabtu</span>
                            </div>
                        </li>

                        <li class="list-item d-flex align-items-center">
                            <span class="icon d-flex justify-content-center align-items-center">
                                <i class="icon-call" style="color: #440A67"></i>
                            </span>
                            <div class="wrapper d-flex flex-column">
                                @foreach ($web as $data)
                                    <a class="link"
                                        href="https://wa.me/{{ $data->whatsapp }}">+{{ $data->whatsapp }}</a>
                                @endforeach
                                @if (count($web) < 1)
                                    <a class="link" href="https://wa.me/6285156574497">+6285156574497</a>
                                @endif
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="footer_main-instagram footer_main-block col-md-6 col-xl-auto">
                    <h4 class="footer_main-instagram_header footer_main-header">Galleri</h4>
                    <ul class="footer_main-instagram_list d-grid">
                        <li class="list-item">
                            <a class="link" href="#" rel="noopener norefferer">
                                <picture>
                                    <source data-srcset="{{ asset('footer-4.jpg') }}"
                                        srcset="{{ asset('footer-4.jpg') }}" type="image/webp" />
                                    <img class="lazy preview" data-src="{{ asset('footer-4.jpg') }}"
                                        src="{{ asset('footer-4.jpg') }}" alt="instagram post" />
                                </picture>
                            </a>
                        </li>
                        <li class="list-item">
                            <a class="link" href="#" rel="noopener norefferer">
                                <picture>
                                    <source data-srcset="{{ asset('footer-1.jpg') }}"
                                        srcset="{{ asset('footer-1.jpg') }}" type="image/webp" />
                                    <img class="lazy preview" data-src="{{ asset('footer-1.jpg') }}"
                                        src="{{ asset('footer-1.jpg') }}" alt="instagram post" />
                                </picture>
                            </a>
                        </li>
                        <li class="list-item">
                            <a class="link" href="#" rel="noopener norefferer">
                                <picture>
                                    <source data-srcset="{{ asset('footer-3.jpg') }}"
                                        srcset="{{ asset('footer-3.jpg') }}" type="image/webp" />
                                    <img class="lazy preview" data-src="{{ asset('footer-3.jpg') }}"
                                        src="{{ asset('footer-3.jpg') }}" alt="instagram post" />
                                </picture>
                            </a>
                        </li>
                        <li class="list-item">
                            <a class="link" href="#" rel="noopener norefferer">
                                <picture>
                                    <source data-srcset="{{ asset('footer-2.jpg') }}"
                                        srcset="{{ asset('footer-2.jpg') }}" type="image/webp" />
                                    <img class="lazy preview" data-src="{{ asset('footer-2.jpg') }}"
                                        src="{{ asset('footer-2.jpg') }}" alt="instagram post" />
                                </picture>
                            </a>
                        </li>
                        <li class="list-item">
                            <a class="link" href="#" rel="noopener norefferer">
                                <picture>
                                    <source data-srcset="{{ asset('footer-5.jpg') }}"
                                        srcset="{{ asset('footer-5.jpg') }}" type="image/webp" />
                                    <img class="lazy preview" data-src="{{ asset('footer-5.jpg') }}"
                                        src="{{ asset('footer-5.jpg') }}" alt="instagram post" />
                                </picture>
                            </a>
                        </li>
                        <li class="list-item">
                            <a class="link" href="#" rel="noopener norefferer">
                                <picture>
                                    <source data-srcset="{{ asset('footer-6.jpg') }}"
                                        srcset="{{ asset('footer-6.jpg') }}" type="image/webp" />
                                    <img class="lazy preview" data-src="{{ asset('footer-6.jpg') }}"
                                        src="{{ asset('footer-6.jpg') }}" alt="instagram post" />
                                </picture>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer_secondary">
            <div class="container d-flex flex-column-reverse flex-md-row justify-content-center align-items-md-center">
                @foreach ($web as $data)
                    <p class="footer_secondary-copyright">
                        {{ $data->name }} &copy;
                        <span class="linebreak">All rights reserved Copyrights <span id="currentYear"></span></span>
                    </p>
                @endforeach
                @if (count($web) < 1)
                    <p class="footer_secondary-copyright">
                        Wedding Organizer &copy;
                        <span class="linebreak">All rights reserved Copyrights <span id="currentYear"></span></span>
                    </p>
                @endif
            </div>
        </div>
    </footer>

    @include('sweetalert::alert')

    <script src="{{ asset('front/js/common.min.js') }}"></script>
    @if (Auth::guard('web')->user())
        <div class="cartOffcanvas offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas">
            <div class="cartOffcanvas_header d-flex align-items-center justify-content-between">
                <h2 class="cartOffcanvas_header-title" id="cartOffcanvasLabel">Keranjang</h2>
                <button class="cartOffcanvas_header-close" type="button" data-bs-dismiss="offcanvas"
                    aria-label="Close">
                    <i class="icon-close"></i>
                </button>
            </div>
            <div class="cartOffcanvas_body">
                <ul class="cartOffcanvas_body-list">

                    @if (count($keranjang) < 1)
                        <div style="display: flex; justify-conten: center;">
                            <p style="color: black;">Keranjang Kosong</p>
                            <i class="fas fa-cart-arrow-down"
                                style="margin-left: 10px;margin-top: 6px; color:#FFE15D;"></i>
                        </div>
                        @php
                            $check = \App\Models\Pemesanan::where('user_id', Auth::guard('web')->user()->id)->count();
                        @endphp

                        @if ($check >= 1)
                            <div style="display: flex; justify-conten: center;">
                                <a href="{{ route('pemesanan-wa', Auth::guard('web')->user()->id) }}" class="btn"
                                    style="font-size: 15px;margin-top: 20px !important;">Buka Pesanan Yang Belum
                                    Dibayar</a>
                            </div>
                        @endif
                    @else
                        <?php
                        $jumlah_paket_value = 0;
                        ?>
                        @foreach ($keranjang as $data)
                            @foreach ($data->paket_wedding->get_first_foto as $foto)
                                <?php
                                $jumlah_paket_value += (int) $data->jumlah_paket * (int) $data->paket_wedding->harga_paket;
                                ?>
                                <li class="cartOffcanvas_body-list_item d-sm-flex align-items-center">
                                    <div class="media">
                                        <a href="{{ url('paket-wedding', $data->paket_wedding->slug) }}"
                                            rel="noopener norefferer" style="width: 100% !important;">
                                            <picture style="width: 100% !important;">
                                                <source data-srcset="{{ asset('paket_wedding/' . $foto->url) }}"
                                                    srcset="{{ asset('paket_wedding/' . $foto->url) }}"
                                                    type="image/webp" />
                                                <img class="lazy"
                                                    data-src="{{ asset('paket_wedding/' . $foto->url) }}"
                                                    src="{{ asset('paket_wedding/' . $foto->url) }}"
                                                    style="height: 300px !important; width: 100% !important; object-fit: cover;"
                                                    alt="media" />
                                            </picture>
                                        </a>
                                    </div>
                                    <div
                                        class="main d-flex flex-wrap justify-content-between align-items-end align-items-lg-center">
                                        <a class="main_title"
                                            href="{{ url('paket-wedding', $data->paket_wedding->slug) }}"
                                            rel="noopener norefferer">
                                            <span
                                                class="main_title-product">{{ $data->paket_wedding->nama_paket }}</span>
                                        </a>
                                        <div class="main_price">
                                            <span class="price">Rp .
                                                {{ number_format((float) $data->paket_wedding->harga_paket, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="qty d-flex align-items-center justify-content-between">
                                            <span class="d-flex align-items-center"
                                                onclick="kurangCanvas({{ $data->id }})">
                                                <i class="icon-minus" style="color: #440a67"></i>
                                            </span>

                                            <input class="qty_amount" type="number"
                                                id="quantityValue{{ $data->id }}" readonly
                                                value="{{ $data->jumlah_paket }}" min="1" max="99"
                                                style="color: #440a67" />

                                            <span class="d-flex align-items-center"
                                                onclick="tambahCanvas({{ $data->id }})">
                                                <i class="icon-plus" style="color: #440a67"></i>
                                            </span>
                                        </div>
                                        <button type="button" class="btn--underline"
                                            onclick="deleteData({{ $data->id }})">Hapus</button>
                                        <input type="hidden" id="keranjangId{{ $data->id }}"
                                            value="{{ $data->id }}">
                                    </div>
                                </li>
                            @endforeach
                        @endforeach
                    @endif
                </ul>
                @if (count($keranjang) < 1)
                @else
                    <div class="cartOffcanvas_body-total d-flex justify-content-between align-items-center">
                        <span>Total</span>
                        <span class="cartTotal" id="totalKeranjang">Rp. @php echo isset($jumlah_paket_value) ? number_format($jumlah_paket_value, 0, ',', '.') : '' @endphp</span>
                    </div>
                    <a href="{{ route('pembayaran.show', Auth::guard('web')->user()->id) }}"
                        class="cartOffcanvas_body-btn btn">Lanjutkan Ke Pembayaran</a>
                @endif
            </div>
        </div>
    @endif

    <div class="cartOffcanvas offcanvas offcanvas-end" tabindex="-1" id="loginCartCanvas">
        <div class="cartOffcanvas_header d-flex align-items-center justify-content-between">
            <h2 class="cartOffcanvas_header-title" id="cartOffcanvasLabel" style="color: #440A67;">Login untuk
                melihat keranjang!</h2>
            <button class="cartOffcanvas_header-close" type="button" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="icon-close"></i>
            </button>
        </div>
        <div class="cartOffcanvas_body">
            <form action="{{ route('login') }}" method="post" id="loginCartForm" autocomplete="off">
                @csrf
                <ul class="cartOffcanvas_body-list">
                    <div class="alert alert-cart">
                        <p>Username atau Password yang dimasukkan salah!</p>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label> <br>
                        <input name="cart_username" class="cart_summary-form_field field required" type="text"
                            autocomplete="new-username" placeholder="Username..."
                            style="margin-top: 10px;width: 100%;">
                    </div>

                    <div class="form-group mt-4">
                        <label for="password">Password</label> <br>
                        <input name="cart_password" class="cart_summary-form_field field required" type="password"
                            autocomplete="new-password" placeholder="Password..."
                            style="margin-top: 10px;width: 100%;">
                    </div>
                </ul>
                <button type="button" class="cartOffcanvas_body-btn btn" id="loginCartButton">Login</button>
            </form>
        </div>
    </div>

    <div class="cartOffcanvas offcanvas offcanvas-end" tabindex="-1" id="loginCanvas">
        <div class="cartOffcanvas_header d-flex align-items-center justify-content-between">
            <h2 class="cartOffcanvas_header-title" id="cartOffcanvasLabel" style="color: #440A67;">Login</h2>
            <button class="cartOffcanvas_header-close" type="button" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="icon-close"></i>
            </button>
        </div>
        <div class="cartOffcanvas_body">
            <form action="{{ route('login') }}" method="post" id="loginForm" autocomplete="off">
                @csrf
                <ul class="cartOffcanvas_body-list">
                    <div class="alert">
                        <p>Username atau Password yang dimasukkan salah!</p>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label> <br>
                        <input name="username" class="cart_summary-form_field field required" type="text"
                            autocomplete="new-username" placeholder="Username..."
                            style="margin-top: 10px;width: 100%;">
                    </div>

                    <div class="form-group mt-4">
                        <label for="password">Password</label> <br>
                        <input name="password" class="cart_summary-form_field field required" type="password"
                            autocomplete="new-password" placeholder="Password..."
                            style="margin-top: 10px;width: 100%;">
                    </div>
                </ul>
                <button type="button" class="cartOffcanvas_body-btn btn" id="loginButton">Login</button>
            </form>
            <p style="margin-top: 20px !important;">Belum punya akun ? <a data-bs-toggle="offcanvas"
                    data-bs-target="#registrasiCanvas" style="color:#440A67;">Registrasi</a></p>
        </div>
    </div>

    <div class="cartOffcanvas offcanvas offcanvas-end" tabindex="-1" id="registrasiCanvas">
        <div class="cartOffcanvas_header d-flex align-items-center justify-content-between">
            <h2 class="cartOffcanvas_header-title" id="cartOffcanvasLabel" style="color:#440A67;">Registrasi</h2>
            <button class="cartOffcanvas_header-close" type="button" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="icon-close"></i>
            </button>
        </div>
        <div class="cartOffcanvas_body">
            <form action="{{ route('user.store') }}" method="post" id="registrasiForm" autocomplete="off">
                @csrf
                <ul class="cartOffcanvas_body-list">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label> <br>
                        <input name="register_nama" class="cart_summary-form_field field required" type="text"
                            autocomplete="new-nama" placeholder="Nama Lengkap..."
                            style="margin-top: 10px;width: 100%;">
                    </div>

                    <div class="form-group" style="margin-top: 15px;">
                        <label for="username">Username</label> <br>
                        <input name="register_username" class="cart_summary-form_field field required" type="text"
                            autocomplete="new-username" placeholder="Username..."
                            style="margin-top: 10px;width: 100%;">
                    </div>

                    <div class="form-group" style="margin-top: 15px;">
                        <label for="register_email">Email</label> <br>
                        <input name="register_email" class="cart_summary-form_field field required" type="email"
                            autocomplete="new-email" placeholder="Email..." style="margin-top: 10px;width: 100%;">
                    </div>

                    <div class="form-group" style="margin-top: 15px;">
                        <label for="register_no_hp">No Hp</label> <br>
                        <input name="register_no_hp" class="cart_summary-form_field field required" type="text"
                            autocomplete="new-no-hp" placeholder="Nomor Hp..." style="margin-top: 10px;width: 100%;">
                    </div>

                    <div class="form-group" style="margin-top: 15px;">
                        <label for="register_alamat">Alamat</label> <br>
                        <input name="register_alamat" class="cart_summary-form_field field required" type="text"
                            autocomplete="new-alamat" placeholder="Alamat..." style="margin-top: 10px;width: 100%;">
                    </div>

                    <div class="form-group mt-4">
                        <label for="password">Password</label> <br>
                        <input name="register_password" class="cart_summary-form_field field required"
                            id="konfirmasi_password" type="password" autocomplete="new-password"
                            placeholder="Password..." style="margin-top: 10px;width: 100%;">
                    </div>

                    <div class="form-group mt-4">
                        <label for="password">Konfirmasi Password</label> <br>
                        <input name="register_konfirmasi_password" class="cart_summary-form_field field required"
                            type="password" autocomplete="new-password" placeholder="Password..."
                            style="margin-top: 10px;width: 100%;">
                    </div>
                </ul>
                <button type="button" class="cartOffcanvas_body-btn btn" id="regsitrasiButton">Registrasi</button>
            </form>
        </div>
    </div>

    <div class="cartOffcanvas offcanvas offcanvas-end" tabindex="-1" id="logoutCanvas">
        <div class="cartOffcanvas_header d-flex align-items-center justify-content-between">
            <h2 class="cartOffcanvas_header-title" id="cartOffcanvasLabel">Logout</h2>
            <button class="cartOffcanvas_header-close" type="button" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="icon-close"></i>
            </button>
        </div>
        <div class="cartOffcanvas_body">
            <a href="{{ route('user.logout') }}" class="cartOffcanvas_body-btn btn btn-logout"
                id="logoutButton">Logout <i class="fas fa-sign-out" style="margin-left: 10px;"></i></a>
        </div>
    </div>

    <script src="{{ asset('front/js/index.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#loginButton").click(function() {
            $("#loginForm").validate();

            if ($('#loginForm').valid()) {

                var username = $("input[name=username]").val();
                var password = $("input[name=password]").val();
                $.ajax({
                    url: "{{ route('login') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        username: username,
                        password: password
                    },
                    success: function(data) {
                        if (data.status == "berhasil") {
                            $(".cartOffcanvas_header-close").click();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Anda telah berhasil login!',
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            $(".alert").css("display", "block");
                            $("input[name='username']").css("color", "#f1556c");
                            $("input[name='username']").css("border", "1px solid #f1556c");
                            $("input[name='password']").css("color", "#f1556c");
                            $("input[name='password']").css("border", "1px solid #f1556c");
                        }
                    }
                });
            }

        });

        $("#regsitrasiButton").click(function() {
            $("#registrasiForm").validate();

            if ($('#registrasiForm').valid()) {

                var register_nama = $("input[name=register_nama]").val();
                var register_username = $("input[name=register_username]").val();
                var register_email = $("input[name=register_email]").val();
                var register_no_hp = $("input[name=register_no_hp]").val();
                var register_alamat = $("input[name=register_alamat]").val();
                var register_password = $("input[name=register_password]").val();

                $.ajax({
                    url: "{{ route('user.store') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        register_nama: register_nama,
                        register_username: register_username,
                        register_email: register_email,
                        register_no_hp: register_no_hp,
                        register_alamat: register_alamat,
                        register_password: register_password,
                    },
                    success: function(data) {
                        $(".cartOffcanvas_header-close").click();
                        if (data == "berhasil") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Anda telah berhasil registrasi, silahkan login untuk melanjutkan transaksi!',
                            }).then(function() {
                                location.reload();
                            });
                            $("#loginButtonTop").click();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Paket gagal untuk dihapus dari keranjang!',
                            }).then(function() {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });

        $("#loginCartButton").click(function() {
            $("#loginCartForm").validate();

            if ($('#loginCartForm').valid()) {

                var username = $("input[name=cart_username]").val();
                var password = $("input[name=cart_password]").val();
                $.ajax({
                    url: "{{ route('login') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        username: username,
                        password: password
                    },
                    success: function(data) {
                        if (data.status == "berhasil") {
                            $(".cartOffcanvas_header-close").click();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Anda telah berhasil login!',
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            $(".alert-cart").css("display", "block");
                            $("input[name='cart_username']").css("color", "#f1556c");
                            $("input[name='cart_username']").css("border", "1px solid #f1556c");
                            $("input[name='cart_password']").css("color", "#f1556c");
                            $("input[name='cart_password']").css("border", "1px solid #f1556c");
                        }
                    }
                });
            }

        });


        function tambahCanvas(dataId) {
            var minCanvas = 1
            maxCanvas = 100;

            if ($("#quantityValue" + dataId).val() < maxCanvas && $("#quantityValue" + dataId).val() >= minCanvas)
                $("#quantityValue" + dataId).val(Number($("#quantityValue" + dataId).val()) + 1); // increment

            if ($("#quantityValue" + dataId).val() < maxCanvas && $("#quantityValue" + dataId).val() >= minCanvas) {
                var quantityValue = $("#quantityValue" + dataId).val();
                var keranjangId = $("#keranjangId" + dataId).val();
                $.ajax({
                    url: "{{ route('quantity-canvas') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        cart_quantity: "yes",
                        jumlah_paket_tambah: quantityValue,
                        keranjang_id: keranjangId
                    },
                    success: function(data) {
                        if (data[0] == "berhasil") {
                            var bilangan = data[1];

                            var reverse = bilangan.toString().split('').reverse().join(''),
                                ribuan = reverse.match(/\d{1,3}/g);
                            ribuan = ribuan.join('.').split('').reverse().join('');

                            $("#totalKeranjang").html("Rp. " + ribuan);
                        }
                    }
                });
            }
        }

        function kurangCanvas(dataId) {
            var minCanvas = 1
            maxCanvas = 100;

            if ($("#quantityValue" + dataId).val() <= maxCanvas && $("#quantityValue" + dataId).val() > minCanvas)
                $("#quantityValue" + dataId).val(Number($("#quantityValue" + dataId).val()) - 1); // decrement

            if ($("#quantityValue" + dataId).val() <= maxCanvas && $("#quantityValue" + dataId).val() >= minCanvas) {

                var quantityValue = $("#quantityValue" + dataId).val();
                var keranjangId = $("#keranjangId" + dataId).val();
                $.ajax({
                    url: "{{ route('quantity-canvas') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        cart_quantity: "yes",
                        jumlah_paket_kurang: quantityValue,
                        keranjang_id: keranjangId
                    },
                    success: function(data) {
                        if (data[0] == "berhasil") {
                            var bilangan = data[1];

                            var reverse = bilangan.toString().split('').reverse().join(''),
                                ribuan = reverse.match(/\d{1,3}/g);
                            ribuan = ribuan.join('.').split('').reverse().join('');

                            $("#totalKeranjang").html("Rp. " + ribuan);
                        }
                    }
                });
            }
        }
    </script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#loginForm").validate({
                rules: {
                    username: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                messages: {
                    username: {
                        required: "Username harus di isi",
                    },
                    password: {
                        required: "Password harus di isi",
                    }
                },
                submitHandler: function(form) {
                    $("#loginButton").prop('disabled', true);
                    form.submit();
                }
            });

            $("#loginCartForm").validate({
                rules: {
                    cart_username: {
                        required: true,
                    },
                    cart_password: {
                        required: true,
                    },
                },
                messages: {
                    cart_username: {
                        required: "Username harus di isi",
                    },
                    cart_password: {
                        required: "Password harus di isi",
                    }
                },
                submitHandler: function(form) {
                    $("#loginCartButton").prop('disabled', true);
                    form.submit();
                }
            });

            $("#registrasiForm").validate({
                rules: {
                    register_nama: {
                        required: true,
                    },
                    register_username: {
                        required: true,
                    },
                    register_email: {
                        required: true,
                    },
                    register_no_hp: {
                        required: true,
                    },
                    register_alamat: {
                        required: true,
                    },
                    register_password: {
                        required: true,
                    },
                    register_konfirmasi_password: {
                        required: true,
                        equalTo: "#konfirmasi_password"
                    }
                },
                messages: {
                    register_nama: {
                        required: "Nama harus di isi",
                    },
                    register_username: {
                        required: "Username harus di isi",
                    },
                    register_email: {
                        required: "Email harus di isi",
                        email: "Mohon masukkan format email yang valid"
                    },
                    register_no_hp: {
                        required: "No Hp harus di isi"
                    },
                    register_alamat: {
                        required: "Alamat harus di isi"
                    },
                    register_password: {
                        required: "Password harus di isi",
                    },
                    register_konfirmasi_password: {
                        required: "Konfirmasi Password harus di isi",
                        equalTo: "Konfirmasi Password tidak sama"
                    }

                },
                submitHandler: function(form) {
                    $("#registrasiButton").prop('disabled', true);
                    form.submit();
                }
            });

        });

        function deleteData(dataId) {
            $(".cartOffcanvas_header-close").click();
            Swal.fire({
                title: "Hapus paket ?",
                text: `Paket yang ada di keranjang akan terhapus. Anda tidak akan dapat mengembalikan
                aksi ini!`,
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "rgb(11, 42, 151)",
                cancelButtonColor: "rgb(209, 207, 207)",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then(function(t) {
                if (t.value) {
                    var keranjangId = $("#keranjangId" + dataId).val()
                    $.ajax({
                        url: "{{ route('keranjang.hapus') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: keranjangId
                        },
                        success: function(data) {
                            if (data == "berhasil") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Paket telah berhasil dihapus dari keranjang!',
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Paket gagal untuk dihapus dari keranjang!',
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            })
        }
    </script>

    @yield('js')

</body>

</html>
