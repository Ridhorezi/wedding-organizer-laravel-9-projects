@extends('back.layouts.master', ['web' => $web])

@section('title_menu')
    Update Password
@endsection

@section('title')
    Manajemen Akun
@endsection
@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        .cke_chrome {
            border: 1px solid #e3eaef !important;
        }

    </style>
@endsection

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Akun</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Password</a></li>
        </ol>
    </div>
    <!-- start form -->
        <!-- start row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('manajemen-akun-admin.updatePasswordAdmin', $admin)}}" method="POST">
                            @csrf
    
                            <div class="form-group">
                                <label for="passwordBaru">Password Baru<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="password_baru" parsley-trigger="change"
                                        placeholder="Masukkan Password Baru"
                                        class="form-control @error('password_baru') is-invalid @enderror" id="password_baru"
                                        value="{{ old('password_baru') }}">
                                    <div class="input-group-append">
                                        <button
                                            class="btn btn-secondary fa fa-eye @error('password_baru') btn-danger @enderror toggle-password-baru"
                                            type="button"></button>
                                    </div>
                                </div>
    
                                @error('password_baru')
                                <div class="mt-1">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="konfirmasiPasswordBaru">Konfirmasi Password Baru<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="konfirmasi_password_baru" parsley-trigger="change"
                                        placeholder="Masukkan Konfirmasi Password Baru"
                                        class="form-control @error('konfirmasi_password_baru') is-invalid @enderror"
                                        id="konfirmasi_password_baru" value="{{ old('konfirmasi_password_baru') }}">
                                    <div class="input-group-append">
                                        <button
                                            class="btn btn-secondary fa fa-eye @error('konfirmasi_password_baru') btn-danger @enderror toggle-konfirmasi-password-baru"
                                            type="button"></button>
                                    </div>
                                </div>
    
                                @error('konfirmasi_password_baru')
                                <div class="mt-1">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
    
                            <div class="form-group d-flex justify-content-end mt-5">
                                <button class="btn btn-md btn-primary waves-effect waves-light mr-2" type="submit"><i
                                        class="fa fa-save mr-1"></i> Simpan Perubahan</button>
                                <a href="{{ route('manajemen-akun-admin.index') }}"
                                    class="btn btn-md btn-light waves-effect"><i class="fa fa-undo mr-1"></i> Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>

    <!-- Toggle Show/Hide Password -->
    <script>
        $(".toggle-password-lama").click(function() {
            $(this).toggleClass("far fa-eye-slash");
            var passwordLama = document.getElementById("password_lama");

            if (passwordLama.type === "password") {
                passwordLama.type = "text";
            } else {
                passwordLama.type = "password";
            }

           
        });
        $(".toggle-password-baru").click(function() {
            $(this).toggleClass("far fa-eye-slash");
            var password = document.getElementById("password_baru");

            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        });
        
        $(".toggle-konfirmasi-password-baru").click(function() {
            $(this).toggleClass("far fa-eye-slash");
            var konfirmasiPassword = document.getElementById("konfirmasi_password_baru");

            if (konfirmasiPassword.type === "password") {
                konfirmasiPassword.type = "text";
            } else {
                konfirmasiPassword.type = "password";
            }
        });

    </script>
@endsection
