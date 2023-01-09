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
            background: #440a67;
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
            <div class="container d-md-flex justify-content-between align-content-start">
                <div class="cart_main">
                    <h3 class="cart_main-header d-flex align-items-center justify-content-between">
                        Paket
                        <span>{{ $keranjang->count() }} Paket</span>
                    </h3>
                    <ul class="cart_main-list">
                        <?php
                        $jumlah_all_paket_value = 0;
                        ?>
                        @foreach ($keranjang as $data)
                            @foreach ($data->paket_wedding->get_first_foto as $foto)
                                <?php
                                $jumlah_all_paket_value += (int) $data->jumlah_paket * (int) $data->paket_wedding->harga_paket;
                                ?>

                                <?php
                                $jumlah_paket_value = (int) $data->jumlah_paket * (int) $data->paket_wedding->harga_paket;
                                ?>
                                <input type="hidden" name="paket_wedding_id_all[]" class="paket_wedding_id_all"
                                    value="{{ $data->id }}">
                                <input type="hidden" name="jumlah_paket_bayar[]" class="jumlah_paket_bayar"
                                    value="{{ $data->jumlah_paket }}">
                                <li class="cart_main-list_item">
                                    <div
                                        class="wrapper d-flex flex-wrap flex-xl-nowrap align-items-center justify-content-between">
                                        <div class="wrapper_item d-flex align-items-center">
                                            <div class="wrapper_item-media">
                                                <picture>
                                                    <source data-srcset="{{ asset('paket_wedding/' . $foto->url) }}"
                                                        srcset="{{ asset('paket_wedding/' . $foto->url) }}"
                                                        type="image/webp" style="object-fit: cover !important;" />
                                                    <img class="lazy"
                                                        data-src="{{ asset('paket_wedding/' . $foto->url) }}"
                                                        src="{{ asset('paket_wedding/' . $foto->url) }}" alt="media"
                                                        style="height: 140px; object-fit: cover !important;" />
                                                </picture>
                                            </div>
                                            <div class="wrapper_item-info">
                                                <h4 class="title">{{ $data->paket_wedding->nama_paket }}</h4>
                                            </div>
                                        </div>
                                        <div class="price_wrapper d-flex flex-column">
                                            <span class="price">Rp .
                                                {{ number_format((float) $data->paket_wedding->harga_paket, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="price_wrapper price_wrapper--subtotal d-flex flex-column">
                                            <h5 class="title">Subtotal</h5>
                                            <span class="price price--total" id="sub_total{{ $data->id }}">Rp .
                                                {{ number_format((float) $jumlah_paket_value, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="qty d-flex align-items-center justify-content-between">
                                            <span class="d-flex align-items-center"
                                                onclick="kurangInCard({{ $data->id }})">
                                                <i class="icon-minus"></i>
                                            </span>
                                            <input class="qty_amount" type="number" readonly
                                                value="{{ $data->jumlah_paket }}" min="1" max="99"
                                                id="quantityValueCard{{ $data->id }}" />
                                            <span class="d-flex align-items-center"
                                                onclick="tambahInCard({{ $data->id }})">
                                                <i class="icon-plus"></i>
                                            </span>
                                        </div>
                                        <input type="hidden" id="keranjangIdCard{{ $data->id }}"
                                            value="{{ $data->id }}">
                                        <button type="button" class="close d-flex align-items-center align-items-sm-start"
                                            onclick="deleteData(this, {{ $data->id }})">
                                            <i class="icon-close"></i>
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                    <div
                        class="cart_main-action d-flex flex-column flex-sm-row align-items-center justify-content-sm-between">
                        <a class="btn--underline" href="{{ route('paket-wedding') }}">Tetap berbelanja</a>
                    </div>
                </div>
                <div class="cart_summary">
                    <h3 class="cart_summary-header">Ringkasan Pesanan</h3>
                    <form class="cart_summary-form" action="#" method="post" id="bayarPaketForm">
                        <input class="cart_summary-form_field field" type="hidden" name="user_id"
                            value="{{ Auth::guard('web')->user()->id }}" />
                        <input class="cart_summary-form_field field" type="text" name="tempat_acara"
                            placeholder="Tempat Acara" />
                        <input class="cart_summary-form_field field" type="date" name="tanggal_acara"
                            placeholder="Tanggal Acara" style="margin-top: 15px;" />
                    </form>
                    <div class="cart_summary-table">
                        <div class="cart_summary-table_row d-flex justify-content-between">
                            <span class="property">{{ count($keranjang) }} Paket</span>
                            <span class="value" id="paketTotal">Rp. @php echo isset($jumlah_all_paket_value) ?  number_format((float)$jumlah_all_paket_value, 0, ',', '.')  : '' @endphp</span>
                        </div>
                        <div class="cart_summary-table_row cart_summary-table_row--total d-flex justify-content-between">
                            <span class="property">Total</span>
                            <span class="value" id="totalHarga">Rp. @php echo isset($jumlah_all_paket_value) ?  number_format((float)$jumlah_all_paket_value, 0, ',', '.')  : '' @endphp</span>
                        </div>
                    </div>
                    <button type="button" class="cart_summary-btn btn" id="bayarPaket">Bayar</button>
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
                                                    srcset="{{ asset('paket_wedding/' . $item->url) }}"
                                                    type="image/webp" />
                                                <img class="lazy" data-src="{{ asset('paket_wedding/' . $item->url) }}"
                                                    src="{{ asset('paket_wedding/' . $item->url) }}" alt="media" />
                                            </picture>
                                        </a>
                                    </div>
                                    <div class="main">
                                        <a class="main_title"
                                            href="{{ url('paket-wedding', $item->paket_wedding->slug) }}"
                                            rel="noopener norefferer">{{ $item->paket_wedding->nama_paket }}</a>
                                        <div class="main_price">
                                            {{-- <span class="price price--old">$45.99</span> --}}
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

                            $("#quantityValue" + dataId).val(quantityValue);

                            var sub_total = data[1];

                            var sub_total_reverse = sub_total.toString().split('').reverse().join(''),
                                sub_total_ribuan = sub_total_reverse.match(/\d{1,3}/g);
                            sub_total_ribuan = sub_total_ribuan.join('.').split('').reverse().join('');

                            $("#sub_total" + dataId).html("Rp. " + sub_total_ribuan);

                            var total_harga = data[2];

                            var total_harga_reverse = total_harga.toString().split('').reverse().join(''),
                                total_harga_ribuan = total_harga_reverse.match(/\d{1,3}/g);
                            total_harga_ribuan = total_harga_ribuan.join('.').split('').reverse().join('');

                            $("#totalHarga").html("Rp. " + total_harga_ribuan);

                            var paket_total = data[2];

                            var paket_total_reverse = paket_total.toString().split('').reverse().join(''),
                                paket_total_ribuan = paket_total_reverse.match(/\d{1,3}/g);
                            paket_total_ribuan = paket_total_ribuan.join('.').split('').reverse().join('');

                            $("#paketTotal").html("Rp. " + paket_total_ribuan);

                            var total_keranjang = data[2];

                            var total_keranjang_reverse = total_keranjang.toString().split('').reverse().join(
                                    ''),
                                total_keranjang_ribuan = total_keranjang_reverse.match(/\d{1,3}/g);
                            total_keranjang_ribuan = total_keranjang_ribuan.join('.').split('').reverse().join(
                                '');

                            $("#totalKeranjang").html("Rp. " + total_keranjang_ribuan);
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

                            $("#quantityValue" + dataId).val(quantityValue);

                            var sub_total = data[1];

                            var sub_total_reverse = sub_total.toString().split('').reverse().join(''),
                                sub_total_ribuan = sub_total_reverse.match(/\d{1,3}/g);
                            sub_total_ribuan = sub_total_ribuan.join('.').split('').reverse().join('');

                            $("#sub_total" + dataId).html("Rp. " + sub_total_ribuan);

                            var total_harga = data[2];

                            var total_harga_reverse = total_harga.toString().split('').reverse().join(''),
                                total_harga_ribuan = total_harga_reverse.match(/\d{1,3}/g);
                            total_harga_ribuan = total_harga_ribuan.join('.').split('').reverse().join('');

                            $("#totalHarga").html("Rp. " + total_harga_ribuan);

                            var paket_total = data[2];

                            var paket_total_reverse = paket_total.toString().split('').reverse().join(''),
                                paket_total_ribuan = paket_total_reverse.match(/\d{1,3}/g);
                            paket_total_ribuan = paket_total_ribuan.join('.').split('').reverse().join('');

                            $("#paketTotal").html("Rp. " + paket_total_ribuan);

                            var total_keranjang = data[2];

                            var total_keranjang_reverse = total_keranjang.toString().split('').reverse().join(
                                    ''),
                                total_keranjang_ribuan = total_keranjang_reverse.match(/\d{1,3}/g);
                            total_keranjang_ribuan = total_keranjang_ribuan.join('.').split('').reverse().join(
                                '');

                            $("#totalKeranjang").html("Rp. " + total_keranjang_ribuan);
                        }
                    }
                });
            }
        }
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#bayarPaketForm").validate({
                rules: {
                    tempat_acara: {
                        required: true,
                    },
                    tanggal_acara: {
                        required: true,
                    },
                },
                messages: {
                    tempat_acara: {
                        required: "Tempat Acara harus di isi",
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
        $("#bayarPaket").click(function() {

            paket_wedding_id_all = [];

            $(".paket_wedding_id_all").each(function() {
                paket_wedding_id_all.push($(this).val());
            });

            // console.log(bundle_paket_pemesanan);

            $("#bayarPaketForm").validate();

            if ($('#bayarPaketForm').valid()) {
                var user_id = $("input[name=user_id]").val();
                var tempat_acara = $("input[name=tempat_acara]").val();
                var tanggal_acara = $("input[name=tanggal_acara]").val();
                $.ajax({
                    url: "{{ route('pemesanan.store') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        paket_wedding_id: paket_wedding_id_all,
                        user_id: user_id,
                        // jumlah_paket:jumlah_paket_bayar,
                        tempat_acara: tempat_acara,
                        tanggal_acara: tanggal_acara
                    },
                    success: function(data) {
                        if (data[0] == "berhasil") {
                            window.location.href =
                                '{{ route('pemesanan-wa', Auth::guard('web')->user()->id) }}';
                        } else if (data[0] == "redirect") {

                        } else {

                        }
                    }
                });
            }

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




        function deleteData(e, dataId) {
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
                    var keranjangId = $("#keranjangIdCard" + dataId).val();
                    $.ajax({
                        url: "{{ route('keranjang.hapus') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: keranjangId
                        },
                        success: function(data) {
                            if (data[0] == "berhasil") {
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
@endsection
