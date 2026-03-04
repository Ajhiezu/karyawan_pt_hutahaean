<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ config('app.name', 'PT Hutahaean') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/img/logo.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets') }}/js/config.js"></script>
    <style>
body {
    position: relative;
    min-height: 100vh;
    overflow: hidden;
}

body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: url('{{ asset("assets/img/image.png") }}') center center / cover no-repeat;
    filter: blur(4px);
    transform: scale(1.05);
    z-index: -2;
}

body::after {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.35);
    z-index: -1;
}

.card {
    backdrop-filter: blur(15px);
    background: rgba(255, 255, 255, 0.53);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
}
</style>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Forgot Password -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="{{ asset('assets/img/logo.png') }}"
                      alt="Logo"
                      width="40">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">PT Hutahaean</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Forgot Password?</h4>
              <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

              <!-- SESSION STATUS -->
                    @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                    @endif

              <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required
                                autofocus
                                autocomplete="off"
                            />

                            @error('email')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary d-grid w-100">
                            Send Reset Link
                        </button>
                    </form>
              <div class="text-center">
                <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Back to login
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('assets') }}/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets') }}/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>