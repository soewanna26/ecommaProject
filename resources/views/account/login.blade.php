<!doctype html>
<html class="no-js" lang="en" dir="ltr">


<!-- Mirrored from pixelwibes.com/template/my-task/html/dist/ui-elements/auth-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Mar 2024 09:13:57 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sign in</title>
    <link rel="icon" href="{{ asset('login/images/favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('login/css/my-task.style.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('login/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('login/css/custom.css') }}">
    <style type="text/css">
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #dc3545;
        }
    </style>
</head>

<body data-mytask="theme-indigo">

    <div id="mytask-layout">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5 ">

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">
                    <div class="row g-0">
                        <div
                            class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                            <div style="max-width: 25rem;">
                                <div class="text-center mb-5">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" width="4rem"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 122.88 116.31" style="enable-background:new 0 0 122.88 116.31"
                                        xml:space="preserve">
                                        <g>
                                            <path
                                                d="M4.06,12.67C1.87,12.67,0,10.8,0,8.51c0-2.19,1.87-4.06,4.06-4.06h5.62c0.1,0,0.31,0,0.42,0c3.75,0.1,7.08,0.83,9.88,2.6 c3.12,1.98,5.41,4.99,6.66,9.47c0,0.1,0,0.21,0.1,0.31L27.78,21h2.34V4.12c0-2.27,1.85-4.12,4.12-4.12h21.67 c2.27,0,4.12,1.85,4.12,4.12v10.02c3.42-3.41,8.06-5.5,13.18-5.5c2.22,0,4.36,0.4,6.34,1.12c4.08-4.33,9.87-7.04,16.29-7.04 c10.96,0,20.07,7.88,21.99,18.28h0.99c2.29,0,4.06,1.87,4.06,4.06c0,0.42-0.11,0.83-0.21,1.25l-10.61,42.76 c-0.42,1.87-2.08,3.12-3.95,3.12l0,0H41.51c1.46,5.41,2.91,8.32,4.89,9.68c2.39,1.56,6.56,1.66,13.53,1.56h0.1l0,0h47.03 c2.29,0,4.06,1.87,4.06,4.06c0,2.29-1.87,4.06-4.06,4.06H60.04l0,0c-8.64,0.1-13.94-0.1-18.21-2.91 c-4.37-2.91-6.66-7.91-8.95-16.96l0,0L18.94,18.92c0-0.1,0-0.1-0.1-0.21c-0.62-2.29-1.66-3.85-3.12-4.68 c-1.46-0.94-3.43-1.35-5.72-1.35c-0.1,0-0.21,0-0.31,0H4.06L4.06,12.67L4.06,12.67z M84.38,37.69c0-1.28,1.27-2.32,2.83-2.32 c1.56,0,2.83,1.04,2.83,2.32v15.69c0,1.28-1.27,2.32-2.83,2.32c-1.56,0-2.83-1.04-2.83-2.32V37.69L84.38,37.69z M67.43,37.69 c0-1.28,1.27-2.32,2.83-2.32c1.56,0,2.83,1.04,2.83,2.32v15.69c0,1.28-1.27,2.32-2.83,2.32c-1.56,0-2.83-1.04-2.83-2.32V37.69 L67.43,37.69z M50.49,37.69c0-1.28,1.27-2.32,2.83-2.32c1.56,0,2.83,1.04,2.83,2.32v15.69c0,1.28-1.27,2.32-2.83,2.32 c-1.56,0-2.83-1.04-2.83-2.32V37.69L50.49,37.69z M85.57,13.37c2.31,2.05,4.14,4.66,5.29,7.63h19.85 c-1.68-6.65-7.7-11.58-14.87-11.58C91.89,9.42,88.29,10.91,85.57,13.37L85.57,13.37z M92.21,29.11L92.21,29.11l-38.01,0l0,0H30.07 l0,0l9.26,34.86h65.65l8.63-34.86H92.21L92.21,29.11z M55.31,21c0.11-0.29,0.23-0.57,0.35-0.85V7.2c0-1.64-1.35-2.99-2.99-2.99 H37.71c-1.64,0-2.99,1.34-2.99,2.99V21H55.31L55.31,21z M94.89,96.33c5.52,0,9.99,4.47,9.99,9.99s-4.47,9.99-9.99,9.99 c-5.51,0-9.99-4.47-9.99-9.99S89.38,96.33,94.89,96.33L94.89,96.33L94.89,96.33z M51.09,96.33c5.51,0,9.99,4.47,9.99,9.99 s-4.47,9.99-9.99,9.99s-9.99-4.47-9.99-9.99S45.57,96.33,51.09,96.33L51.09,96.33L51.09,96.33z" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="mb-5">
                                    <h2 class="color-900 text-center">Shopping Time</h2>
                                </div>
                                <!-- Image block -->
                                <div class="">
                                    <img src="{{ asset('login/images/login-shop.svg') }}" alt="login-img" width="300px">
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0 bg-dark text-light" style="max-width: 32rem;">
                                @include('message')
                                <!-- Form -->
                                <form class="row g-1 p-3 p-md-4" action="{{ route('account.authenticate') }}"
                                    method="post">
                                    @csrf
                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1>Sign in</h1>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Email Or Phone Number</label>
                                            <input type="type"
                                                class="form-control form-control-lg @error('login') is-invalid @enderror"
                                                name="login" id="login" placeholder="Email Or Phone Number"
                                                value="{{ old('login') }}">
                                        </div>
                                        @error('login')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <div class="form-label">
                                                <span class="d-flex justify-content-between align-items-center">
                                                    Password
                                                </span>
                                            </div>
                                            <input type="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                name="password" id="password" placeholder="***************">
                                        </div>
                                        @error('password')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-lg btn-block btn-success lift text-uppercase">Sign In</button>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <span class="text-muted">Don't have an account yet? <a
                                                href="{{ route('account.register') }}">Sign up here</a></span>
                                    </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div> <!-- End Row -->
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('login/bundles/libscripts.bundle.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('login/plugin/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('login/plugin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('login/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('login/js/demo.js') }}"></script>

</body>

<!-- Mirrored from pixelwibes.com/template/my-task/html/dist/ui-elements/auth-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Mar 2024 09:13:57 GMT -->

</html>
