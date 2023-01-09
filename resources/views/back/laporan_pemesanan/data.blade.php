@extends('back.layouts.master', ['web' => $web])

@section('title')
Laporan Pemesanan
@endsection


@section('title_menu')
Laporan Pemesanan
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        @media (min-width: 767.98px) {
            .dataTables_wrapper .dataTables_length {
                margin-bottom: -42px;
            }
        }

        label.error {
            color: #F94687;
            font-size: 13px;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.5;
            margin-top: 5px;
            padding: 0;
        }

        input.error {
            color: #F94687;
            border: 1px solid #F94687;
        }

        .indicator.online {
    background: #28B62C;
    display: inline-block;
    width: 0.6em;
    height: 0.6em;
    border-radius: 50%;
    -webkit-animation: pulse-animation 2s infinite linear;
}

@-webkit-keyframes pulse-animation {
	0% { -webkit-transform: scale(1); }
	25% { -webkit-transform: scale(1); }
    50% { -webkit-transform: scale(1.2) }
    75% { -webkit-transform: scale(1); }
    100% { -webkit-transform: scale(1); }
}

.indicator.offline {
    background: #FF4136;
    display: inline-block;
    width: 1em;
    height: 1em;
    
}
    </style>
@endsection

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Laporan Pemesanan</a></li>
        </ol>
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Laporan Pemesanan</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <select class="form-control text-dark" id="pilihStatusPembayaran">
                                <option value="">
                                    PILIH STATUS PEMBAYARAN
                                </option>
                                <option value="belum">
                                    BELUM DIBAYAR
                                </option>
                                <option value="sudah">
                                    SUDAH DIBAYAR
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="wrap">
                    {{-- <div class="table-responsive"> --}}
                    <table id="laporan_pemesanan" class="table dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pemesan</th>
                                <th>Nama Paket</th>
                                <th>Jumlah Paket</th>
                                <th>Tempat Acara</th>
                                <th>Tanggal Acara</th>
                                <th>Total Harga</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </thead>
        
                        <tbody>
        
                            @php
                            $increment = 1;
                            @endphp
        
                            @foreach($data_pesanan as $data)
                            <tr>
                                <td>{{ $increment++ }} </td>
                                <td>{{ $data->users->nama }}</td>
                                <td>{{ $data->paket_wedding->nama_paket }}</td>
                                <td>{{ $data->jumlah_paket }}</td>
                                <td>{{ $data->tempat_acara }}</td>
                                <td>{{ $data->tanggal_acara }}</td>
                                <td>
                                    @php
                                            $jumlah = 0;
                                                // $data_jumlah_paket[] = $item->jumlah_paket; 
                                            $jumlah = (int)$data->jumlah_paket * (int)$data->paket_wedding->harga_paket;  

                                            echo "Rp. " . $jumlah;
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $color = 'secondary';
                                        if($data->status_pembayaran == 'belum'){
                                            $color = 'warning';
                                        }elseif ($data->status_pembayaran == 'sudah') {
                                            $color = 'success';
                                        }
                                    @endphp
                                    <span class="badge badge-{{$color}} font-15">{{ ucwords($data->status_pembayaran) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    {{-- <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ route('data-pesanan.store') }}" method="post" id="tambahPesanan">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
                        <div class="form-group">
                            <div class="col-12">
                                <label for="election">Pemesanan</label>
                                <input class="form-control mb-1 @error('name') is-invalid @enderror" type="text" id="name"
                                    placeholder="Contoh: Iqbal Rivaldi" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <div class="col-12">
                                <label for="period">Username</label>
                                <input class="form-control mb-1 @error('username') is-invalid @enderror" type="text"
                                    id="username" placeholder="Contoh: iqbal1402" name="username"
                                    value="{{ old('username') }}">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <div class="col-12">
                                <label for="period">Email</label>
                                <input class="form-control mb-1 @error('email') is-invalid @enderror" minlength="3"
                                    maxlength="35" type="email" id="email" placeholder="Contoh: briana67@gmail.com"
                                    name="email" value="{{ old('email') }}">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <div class="col-12">
                                <label for="period">Password</label>
                                <div class="input-group mb-1">
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" id="passwordId" placeholder="Masukan Password Anda">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary fa fa-eye toggle-password tombol"
                                            type="button"></button>
                                    </div>
                                </div>
                                <label for="passwordId" id="passwordV" generated="true" class="error"></label>
                                <script>
                                    if (document.getElementById('passwordV').innerHTML == ""){
                                            document.getElementById('passwordV').style.display = "none";
                                      }
                                </script>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <div class="col-12">
                                <label for="period">Password Confirmation</label>
                                <div class="input-group mb-1">
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="passwordConfirm" placeholder="Masukan Konfirmasi Password Anda"
                                        value="{{ old('email') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary fa fa-eye toggle-password-confirm"
                                            type="button"></button>
                                    </div>
                                </div>
                                <label for="passwordConfirm" id="password_confirm" generated="true" class="error"></label>
                                <script>
                                    if (document.getElementById('password_confirm').innerHTML == ""){
                                            document.getElementById('password_confirm').style.display = "none";
                                      }
                                </script>
                            </div>
                        </div>
                        
                        @if(Auth::user()->role == 'super_admin')
                        <div class="form-group">
                            <div class="col-12">
                                <label for="period">Role</label>
                                <select class="form-control mb-1" onchange="showFaculty(this.value)" name="role" id="role">
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="saksi">Saksi</option>
                                    <option value="panitia">Panitia</option>
                                </select>
                            </div>
                        </div>
                        @elseif(Auth::user()->role == 'panitia')
                        <div class="form-group">
                            <div class="col-12">
                                <label for="period">Role</label>
                                <select class="form-control mb-1" onchange="showFaculty(this.value)" name="role" id="role">
                                    <option value="admin">Admin</option>
                                    <option value="saksi">Saksi</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="form-group" id="faculty" style="display: none">
                            <div class="col-12">
                                <label for="faculty_id">Fakultas</label>
                                <select name="faculty_id" class="form-control mb-1" id="faculty_id">
                                    <option value="">-- Pilih Fakultas --</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="tambahButton">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ route('data-pesanan.update', '') }}" id="editPemesananForm" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <div class="col-12">
                            <label for="edit_pemesan">Pemesan</label>
                            <input class="form-control mb-1 @error('edit_pemesan') is-invalid @enderror" type="text"
                                id="edit_pemesan" placeholder="Masukkan Nama Pemesan" name="edit_pemesan"
                                value="{{ old('edit_pemesan') }}" required>

                            @error('edit_pemesan')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <div class="col-12">
                            <label for="edit_jumlah_paket">Jumlah Paket</label>
                            <input class="form-control mb-1 @error('edit_jumlah_paket') is-invalid @enderror" type="text"
                                id="edit_jumlah_paket" placeholder="Masukkan Nama Pemesan" name="edit_jumlah_paket"
                                value="{{ old('edit_jumlah_paket') }}" required>

                            @error('edit_jumlah_paket')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label for="edit_tempat_acara">Tempat Acara</label>
                            <input class="form-control mb-1 @error('edit_tempat_acara') is-invalid @enderror" type="text"
                                id="edit_tempat_acara" placeholder="Masukkan Tempat Acara" name="edit_tempat_acara"
                                value="{{ old('edit_tempat_acara') }}" required>
                            @error('edit_tempat_acara')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label for="edit_tanggal_acara">Tanggal Acara</label>
                            <input class="form-control mb-1 @error('edit_tanggal_acara') is-invalid @enderror" type="date" id="edit_tanggal_acara" placeholder="Masukkan Tanggal Acara"
                                name="edit_tanggal_acara" value="{{ old('edit_tanggal_acara') }}" required>
                            @error('edit_tanggal_acara')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="col-12">
                            <label for="edit_status_pembayaran">Status Pembayaran</label>
                            <select name="edit_status_pembayaran" class="form-control">
                                <option value="belum">Belum</option>
                                <option value="sudah">Sudah</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="editButton">Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail User</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <label for="period">Pemesan</label>
                            <p class="text-dark" id="detail_nama_pemesan"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label for="period">Nama Paket</label>
                            <p class="text-dark" id="detail_nama_paket"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label for="period">Jumlah Paket</label>
                            <p class="text-dark" id="detail_jumlah_paket"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label for="period">Tempat Acara</label>
                            <p class="text-dark" id="detail_tempat_acara"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label for="period">Tanggal Acara</label>
                            <p class="text-dark" id="detail_tanggal_acara"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <label for="period">Total Harga</label>
                            <p class="text-dark" id="detail_total_harga"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label for="period">Status Pembayaran</label>
                            <p class="text-dark" id="detail_status_pembayaran"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>

    <!-- Datatable -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    
    {{-- Sweetalert --}}

    <script>
        $('.modal').appendTo("body");
            $('#laporan_pemesanan').DataTable({
                dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excel'
                            }
                        ]
            });
    </script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    
    <script>
        $("#pilihStatusPembayaran").change(function() {
        var status_pembayaran = $("#pilihStatusPembayaran").val();

            $.ajax({
                url: "{{ route('laporan-pemesanan.select') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}", 
                    status_pembayaran: status_pembayaran
                },
                success: function(data) {
                    $('#wrap').html(data);
                    $('#laporan_pemesanan').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excel'
                            }
                        ]
                    });
                }
            });
        });
    </script>

    {{-- Validate Modal Edit User --}}
    <script>
        const update = $('#editPemesananForm').attr('action');
        const idForm = $('#editPemesananForm').attr('id');

        function setEditData(data) {

            $('#editPemesananForm').attr('id', `${idForm}${data.id}`);
            $('#editPemesananForm' + data.id).attr('action', `${update}/${data.id}`);

            $.ajax({
                        url: "{{ route('data-pesanan.get-user') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}", 
                            user_id:data.user_id
                        },
                        success: function(data) {
                            $('[name="edit_pemesan"]').val(data);
                        }
            });
           
            $('[name="edit_jumlah_paket"]').val(data.jumlah_paket);
            $('[name="edit_tempat_acara"]').val(data.tempat_acara);
            $('[name="edit_tanggal_acara"]').val(data.tanggal_acara);
            $('[name="edit_status_pembayaran"]').val(data.status_pembayaran);

            validateEdit(data.id);
        }
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
            function validateEdit(data) {
                $("#editPemesananForm" + data).validate({
                    rules: {
                        edit_pemesan: {
                            required: true
                        },
                        edit_jumlah_paket: {
                            required: true
                        },
                        edit_tempat_acara: {
                            required: true
                        },
                        edit_tanggal_acara: {
                            required: true
                        },
                        edit_status_pembayaran: {
                            required: true
                        }
                    },
                    messages: {
                        edit_pemesan: {
                            required: "Pemesan harus di isi"
                        },
                        edit_jumlah_paket: {
                            required: "Jumlah Paket harus di isi"
                        },
                        edit_tempat_acara: {
                            required: "Tempat Acara harus di isi"
                        },
                        edit_tanggal_acara: {
                            required: "Tanggal Acara harus di isi"
                        },
                        edit_status_pembayaran: {
                            required: "Status Pembayaran harus di isi"
                        },
                    }
                });
            }
    </script>
    
    <script>

        function detailData(data) {

            $.ajax({
                url: "{{ route('data-pesanan.get-user') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}", 
                    user_id:data.user_id
                },
                success: function(data) {
                    $('#detail_nama_pemesan').html(data);
                }
            });

            $.ajax({
                url: "{{ route('data-pesanan.get-paket-wedding') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#detail_nama_paket').html(data);
                }
            });

            $.ajax({
                url: "{{ route('data-pesanan.get-jumlah-paket') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    user_id:data.user_id
                },
                success: function(data) {
                    $('#detail_jumlah_paket').html(data);
                }
            });

            $.ajax({
                url: "{{ route('data-pesanan.get-total-harga') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    user_id:data.user_id
                },
                success: function(data) {
                    $('#detail_total_harga').html("Rp. " + data);
                }
            });

            $('#detail_tempat_acara').html(data.tempat_acara);
            $('#detail_tanggal_acara').html(data.tanggal_acara);
            $('#detail_status_pembayaran').html(data.status_pembayaran);
        }
        
        // passing data to select option tag
        $(".editButton").click(function() {
            var idAsValue = $(this).attr('data-role');
            $("#edit_role").val(idAsValue);
        });
    
        // password show/hide toggle
        $(".toggle-password").click(function() {
            $(this).toggleClass("far fa-eye-slash");
            var password = document.getElementById("passwordId");
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
    
        });
    
        // password confirm show/hide toggle
        $(".toggle-password-confirm").click(function() {
            $(this).toggleClass("far fa-eye-slash");
            var passwordConfirm = document.getElementById("passwordConfirm");
    
            if (passwordConfirm.type === "password") {
                passwordConfirm.type = "text";
    
            } else {
                passwordConfirm.type = "password";
            }
    
        });
    
        // edit password show/hide toggle
        $(".toggle-edit-password").click(function() {
            $(this).toggleClass("far fa-eye-slash");
            var editPassword = document.getElementById("editPassword");
    
            if (editPassword.type === "password") {
                editPassword.type = "text";
    
            } else {
                editPassword.type = "password";
            }
    
        });
        
        // edit password confirm show/hide toggle
        $(".toggle-edit-password-confirm").click(function() {
            $(this).toggleClass("far fa-eye-slash");
            var editPasswordConfirm = document.getElementById("editPasswordConfirm");
    
            if (editPasswordConfirm.type === "password") {
                editPasswordConfirm.type = "text";
    
            } else {
                editPasswordConfirm.type = "password";
            }
    
        });
    
        // sweetalert delete one data
        function deleteAlert(e) {
            Swal.fire({
                title: "Hapus user?",
                text: `Seluruh data terkait user akan terhapus. Anda tidak akan dapat mengembalikan aksi
                ini!`,
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "rgb(11, 42, 151)",
                cancelButtonColor: "rgb(209, 207, 207)",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then(function (t) {
                if (t.value) {
                    e.parentNode.submit()
                }
            })
        }
    </script>
@endsection
