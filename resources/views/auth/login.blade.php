<!DOCTYPE html>
<html lang="en">
<head>
  <title>SB Admin 2 - Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <!-- Scripts -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</head>
<body class="bg-gradient-primary">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="card-body">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">DHTT-KTT</h1>
                        </div>
                        <form class="user" method="post" action="{{ route('actionlogin') }}">
                            @csrf
                            <div class="form-group">
                                    <input id="username" type="text" class="form-control form-control-user " name="username" value="{{ old('username') }}" required autofocus placeholder="Enter username...">
                                    
                            </div>

                            <div class="form-group">
                                    <input id="password" type="password" class="form-control form-control-user" name="password" required autocomplete="current-password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block @error('user') is-invalid @enderror">
                                        Login
                            </button>
                                @error('user')
                                    <span id="error" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
