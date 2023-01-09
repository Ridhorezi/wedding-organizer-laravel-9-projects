@extends('back.layouts.master')

@section('title')
Manajemen Akun
@endsection


@section('title_menu')
Daftar Manajemen Akun
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
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
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Manajemen Akun</a></li>
        </ol>
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data User</h4>
                    <div class="button-list">
                        <button type="button" data-toggle="modal" data-target="#addUserModal" class="btn btn-primary btn-xs"
                            data-animation="slide" data-plugin="custommodal" data-overlaySpeed="200"
                            data-overlayColor="#36404a"><i class="fa fa-plus-circle mr-1"></i> Tambah</button>
                        {{-- <button type="button" class="btn btn-danger btn-xs"
                            id="clearAll"><i class="fa fa-trash-o mr-1"></i> Bersihkan</button> --}}
                    </div>
                </div>
                <div class="card-body">
                    {{-- <div class="table-responsive"> --}}
                    <table id="example4" class="table dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
        
                        <tbody>
        
                            @php
                            $increment = 1;
                            @endphp
        
                            @foreach($admin as $user)
                            <tr>
                                <td>{{ $increment++ }} </td>
                                <td>{{ $user->nama }}
                                    @if(Cache::has('user-is-online-' . $user->id))
                                        <span style="color: #28B62C;" class="ml-2">online</span>
                                        <span class="indicator online"></span>
                                    @endif
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <div class="form-group">
                                        <button type="button" data-toggle="modal" data-target="#editUserModal"
                                            onclick="setEditData({{ $user }})"
                                            class="btn btn-warning btn-xs text-white"><i class="fa fa-edit mr-1"></i> Edit</button>
                                        <form style="display: inline" action="{{ route('manajemen-akun-admin.destroy', $user) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button"
                                                class="btn btn-danger btn-xs rounded waves-light waves-effect"
                                                onclick="deleteAlert(this)"><i class="fa fa-trash-o mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('edit_password_admin', $user->id) }}"
                                            class="btn btn-dark btn-xs waves-effect waves-light" id="update-password"><i class="fa fa-key mr-1"></i> Ubah
                                            Password
                                        </a>
                                    </div>
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
    <div class="modal fade" id="addUserModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ route('manajemen-akun-admin.store') }}" method="post" id="tambahUser">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
                        <div class="form-group">
                            <div class="col-12">
                                <label for="election">Nama Lengkap</label>
                                <input class="form-control mb-1 @error('nama') is-invalid @enderror" type="text" id="nama"
                                    placeholder="Masukan Nama Lengkap" name="nama" value="{{ old('nama') }}">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <div class="col-12">
                                <label for="period">Username</label>
                                <input class="form-control mb-1 @error('username') is-invalid @enderror" type="text"
                                    id="username" placeholder="Masukan Username Anda" name="username"
                                    value="{{ old('username') }}">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="tambahButton">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ route('manajemen-akun-admin.update', '') }}" id="editUser" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="checkUsername">
                    <input type="hidden" id="checkEmail">

                    <div class="form-group">
                        <div class="col-12">
                            <label for="name">Nama Lengkap</label>
                            <input class="form-control mb-1 @error('edit_nama') is-invalid @enderror" type="text"
                                id="Edit" placeholder="Masukkan Nama Lengkap" name="edit_nama"
                                value="{{ old('edit_nama') }}" required>

                            @error('edit_nama')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label for="username">Username</label>
                            <input class="form-control mb-1 @error('edit_username') is-invalid @enderror" type="text"
                                id="edit_username" placeholder="Masukkan Username" name="edit_username"
                                value="{{ old('edit_username') }}" required>
                            @error('edit_username')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
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
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    
    {{-- Sweetalert --}}
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                $("#tambahUser").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 3,
                            maxlength: 30,
                        },
                        username:{
                            required: true,
                            minlength: 3,
                            maxlength: 30,
                            remote: {
                                    url: "{{ route('manajemen-akun-admin.checkUsernameAdmin') }}",
                                    type: "post",
                            }
                        },
                        password : {
                            required: true,
                            minlength : 2
                        },
                        password_confirmation : {
                            required: true,
                            equalTo : "#passwordId"
                        }
                    },
                    messages: {
                        name: {
                            required: "Nama harus di isi",
                            minlength: "Nama tidak boleh kurang dari 3 karakter",
                            maxlength: "Nama tidak boleh lebih dari 30 karakter"
                        },
                        username: {
                            required: "Username harus di isi",
                            minlength: "Username tidak boleh kurang dari 3 karakter",
                            maxlength: "Username tidak boleh lebih dari 30 karakter",
                            remote: "Username sudah tersedia"
    
                        },
                        password: {
                            required: "Password harus di isi",
                            minlength: "Password tidak boleh kurang dari 2 karakter"
                        },
                        password_confirmation: {
                            required: "Konfirmasi Password harus di isi",
                            equalTo: "Konfirmasi Password tidak sama"
                        }
                    }
                });
            });
    </script>
    
    {{-- Validate Modal Edit User --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                $("#editUser").validate({
                    rules: {
                        edit_nama: {
                            required: true,
                            minlength: 3,
                            maxlength: 30,
                        },
                        edit_username:{
                            required: true,
                            minlength: 3,
                            maxlength: 30,
                            remote: {
                                param: {
                                    url: "{{ route('manajemen-akun.checkUsername') }}",
                                    type: "post",
                                },
                                depends: function(element) {
                                    // compare name in form to hidden field
                                    return ($(element).val() !== $('#checkUsername').val());
                                },
                               
                            }
                        }
                    },
                    messages: {
                        edit_nama: {
                            required: "Nama harus di isi",
                            minlength: "Nama tidak boleh kurang dari 3 karakter",
                            maxlength: "Nama tidak boleh lebih dari 30 karakter"
                        },
                        edit_username: {
                            required: "Username harus di isi",
                            minlength: "Username tidak boleh kurang dari 3 karakter",
                            maxlength: "Username tidak boleh lebih dari 30 karakter",
                            remote: "Username sudah tersedia"
                        }
                    }
                });
            });
    </script>
    
    <script>
        //  when modal is closed error validation removed 
        // updatePasswordAdmin
        //  passing data to edit modal pop up 
        const updateLink = $('#editUser').attr('action');
        function setEditData(user) {
            $('#editUser').attr('action',  `${updateLink}/${user.id}`);
            $('#checkUsername').val(user.username);
            $('[name="edit_nama"]').val(user.nama);
            $('[name="edit_username"]').val(user.username);
        }
        
       
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
