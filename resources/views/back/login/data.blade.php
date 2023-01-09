<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Wedding Organizer - Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('front/assets/image/unsap1.png')}}">
    <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>

<body class="h-100">
  <section class="h-100 gradient-form" style="background-color: rgb(248, 248, 248);">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-6">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-12">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    @foreach($web as $data)
                    <img src="{{ isset($data) ? asset('profile/'. $data->logo) : asset('default-image.png') }}" style="width: 100px; border-radius:5px;" alt="logo">
                    @endforeach
                    <br><br>
                    <h5 class="login-heading mt-3">Login | Admin Dashboard Dinar WO</h5>
                  </div>

                  <form action="{{ route('admin-login.store') }}" method="POST" class="mt-5">
                    @csrf
                    <div class="form-outline mb-4">
                      <label class="form-label" for="username">Username</label>
                      <input type="text" name="username" class="form-control" placeholder="Username"/>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example22">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Password" />
                    </div>

                    <div class="d-grid">
                      <button class="btn btn-primary" type="submit">Log in</button>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('sweetalert::alert')

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>

</body>

</html>
