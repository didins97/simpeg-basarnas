<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>E-Arsip Basarnas</title>
    <!--
  CSS
  ============================================= -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/FE/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/FE/main.css">

    <link rel="shortcut icon" href="{{ asset('assets') }}/dist/img/logo.png" type="image/x-icon">
</head>

<body>
    <div id="top"></div>
    <!-- Start Header Area -->
    <header class="default-header">
        <div class="sticky-header">
            <div class="container">
                <div class="header-content d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="#top" class="smooth">
                            <h1 class="brand brand-name text-white">
                                <img src="{{ asset('assets') }}/dist/img/logo.png" alt="" width="50">
                                <i style="color:red;">SARP</i>BASARNAS
                            </h1>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Area -->
    <!-- Start Banner Area -->
    <section class="banner-area relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row fullscreen justify-content-center align-items-center">
                <div class="col-lg-8">
                    <div class="banner-content text-center">
                        <p class="text-uppercase text-white">Memelihara Jejak, Menciptakan Keberlanjutan: Sistem Arsip
                            Basarnas</p>
                        <h1 class="text-uppercase text-white">Sistem Arsip <span style="color:red">Kepegawaian</span>
                        </h1>
                        <a href="{{ route('login') }}" class="primary-btn banner-btn">Masuk</a>
                        <a href="{{ route('register') }}" class="primary-btn banner-btn">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>
    <script src="{{ asset('assets') }}/FE/jquery-2.2.4.min.js"></script>
    <script src="{{ asset('assets') }}/FE/main.js"></script>
</body>

</html>
