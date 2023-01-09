@extends('front.layouts.master', ['keranjang' => $keranjang, 'web' => $web])

@section('title_menu')
    Paket Wedding
@endsection

@section('title')
    Data Paket Wedding
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('front/css/cart.min.css') }}" />

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
                <h1 class="page_header" style="color: #ffffff;">Pembayaran</h1>
                <p class="page_text" style="color: #ffffff;">___________________________________</p>
            </div>
        </div>
        <div class="container">
            <ul class="page_breadcrumbs d-flex flex-wrap">
                <li class="page_breadcrumbs-item">
                    <a class="link" href="{{ url('/') }}">Beranda</a>
                </li>

                <li class="page_breadcrumbs-item current">
                    <span>Pembayaran</span>
                </li>
            </ul>
        </div>
    </header>
    <main>
        <section class="cart section">
            <div class="container">
                <h3>Pesanan anda telah masuk ke database kami</h3>
                <p style="margin-top: 10px;">Harap bayar pesanan anda melalui whatsapp terlebih dahulu sebelum memesan paket
                    yang lain.</p>
                <div class="d-flex" style="margin-top: 20px;">
                    @foreach ($web as $data)
                        <a href="https://wa.me/{{ $data->whatsapp }}?text={{ urlencode('hallo kak saya ' . Auth::guard('web')->user()->nama . ' dengan 𝐈𝐃 : ' . Auth::guard('web')->user()->id . ' mau bayar pesanan') }}"
                            class="btn" style="font-size: 15px;" id="bayarPaket"><i class="fa-brands fa-whatsapp"
                                style="margin-right: 10px;"></i> Bayar Lewat Whatsapp</a>
                    @endforeach
                    @if (count($web) < 1)
                        <a class="link" href="https://wa.me/6285156574497">+6285156574497</a>
                    @endif
                    <button type="button" class="btn" style="font-size: 15px;margin-left: 20px !important;"
                        id="bayarPaket" onclick="batalPesanan()"><i class="fas fa-do-not-enter"
                            style="margin-right: 10px;"></i> Batalkan Pesanan</button>
                </div>

            </div>
        </section>
        <aside>
            <section class="top top--highlight section">
                <div class="container">
                    <h2 class="top_header">Paket Lainnya</h2>
                    <ul class="top_list d-lg-flex flex-wrap">
                        @foreach ($paket_wedding_random as $item)
                            <li class="top_list-item col-lg-6" data-order="1">
                                <div
                                    class="top_list-item_wrapper d-flex flex-column flex-sm-row flex-lg-column flex-xxl-row">
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
                                            <span class="price price--new">RP.
                                                {{ number_format((float) $item->paket_wedding->harga_paket, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </aside>
    </main>
@endsection

@section('js')
    <script src="{{ asset('front/js/shop.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#bayarPaketForm").validate({
                rules: {
                    alamat: {
                        required: true,
                    },
                    tanggal_acara: {
                        required: true,
                    },
                },
                messages: {
                    alamat: {
                        required: "Alamat harus di isi",
                    },
                    tanggal_acara: {
                        required: "Tanggal Acara harus di isi",
                    }
                },
                submitHandler: function(form) {
                    // $("#loginButton").prop('disabled', true);
                    //     form.submit();
                }
            });

        });

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
                        $("#quantityValue").val(data[1]);
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

        function tambahInCard(dataId) {
            var minCanvas = 1
            maxCanvas = 100;

            if ($("#quantityValueCard" + dataId).val() < maxCanvas && $("#quantityValueCard" + dataId).val() >= minCanvas)
                $("#quantityValueCard" + dataId).val(Number($("#quantityValueCard" + dataId).val()) + 1); // increment

            if ($("#quantityValueCard" + dataId).val() < maxCanvas && $("#quantityValueCard" + dataId).val() >= minCanvas) {
                var quantityValue = $("#quantityValueCard" + dataId).val();
                var keranjangId = $("#keranjangIdCard" + dataId).val();
                $.ajax({
                    url: "{{ route('quantity-canvas') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        jumlah_paket_tambah: quantityValue,
                        keranjang_id: keranjangId
                    },
                    success: function(data) {
                        if (data[0] == "berhasil") {
                            $("#subtotalValue" + dataId).html("Rp. " + data[1]);
                        }
                    }
                });
            }
        }


        function kurangInCard(dataId) {
            var minCanvas = 1
            maxCanvas = 100;

            if ($("#quantityValueCard" + dataId).val() <= maxCanvas && $("#quantityValueCard" + dataId).val() > minCanvas)
                $("#quantityValueCard" + dataId).val(Number($("#quantityValueCard" + dataId).val()) - 1); // decrement

            if ($("#quantityValueCard" + dataId).val() <= maxCanvas && $("#quantityValueCard" + dataId).val() >=
                minCanvas) {
                var quantityValue = $("#quantityValueCard" + dataId).val();
                var keranjangId = $("#keranjangIdCard" + dataId).val();
                $.ajax({
                    url: "{{ route('quantity-canvas') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        jumlah_paket_kurang: quantityValue,
                        keranjang_id: keranjangId
                    },
                    success: function(data) {
                        if (data[0] == "berhasil") {
                            $("#subtotalValue" + dataId).html("Rp. " + data[1]);
                        }
                    }
                });
            }
        }

        function batalPesanan(e) {
            Swal.fire({
                title: "Batalkan Pesanan ?",
                text: `Pesanan akan dibatalkan. Anda tidak akan dapat mengembalikan
                aksi ini!`,
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "rgb(11, 42, 151)",
                cancelButtonColor: "rgb(209, 207, 207)",
                confirmButtonText: "Ya, batalkan!",
                cancelButtonText: "Kembali"
            }).then(function(t) {
                if (t.value) {
                    $.ajax({
                        url: "{{ route('pemesanan-wa.batal') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: "{{ Auth::guard('web')->user()->id }}"
                        },
                        success: function(data) {
                            if (data == "berhasil") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Pesan telah berhasil dibatalkan!',
                                }).then(function() {
                                    location.href = "/";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Pesan gagal untuk dibatalkan!',
                                }).then(function() {
                                    location.href = "/";
                                });
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection
