<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pemilu Raya | @yield('subtitle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    {{-- <link rel="shortcut icon" href="{{ asset('highdmin/images/favicon.ico') }}">
    --}}
    {{-- additional css --}}
    @yield('css')
    <!-- App css -->
    <link href="{{ asset('highdmin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('highdmin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('highdmin/css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>

    <!-- END  wrapper -->
    @yield('content')

    <!-- Vendor js -->
    <script src="{{ asset('highdmin/js/vendor.min.js') }}"></script>
    {{-- additional js --}}
    @yield('js')
    @include('sweetalert::alert')
    <!-- App js -->
    <script src="{{ asset('highdmin/js/app.min.js') }}"></script>
</body>

</html>