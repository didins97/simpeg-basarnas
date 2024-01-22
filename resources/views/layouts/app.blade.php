<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Arsip Basarnas</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">

    <style>
        body {
            background-image: url('https://media.gettyimages.com/id/1247442749/photo/indonesian-rescue-team-returns-home-from-quake-hit-turkiye.jpg?s=2048x2048&w=gi&k=20&c=YpLAldjBToqezcQkNshTH0M-73TbI1SYtoFmnB8_N64=');
            background-size: cover;
            background-position: center;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(5px);
            z-index: -1;
            box-shadow: inset 0 0 100px rgba(0, 0, 0, 0.5);
        }

        .login-logo a,
        .register-logo a {
            color: #ffffff;
            font-family: 'Oswald', sans-serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .login-logo,
        .register-logo {
            font-size: 25px;
            font-weight: 500;
        }

        .register-logo img {
            width: 60px;
            height: 60px;
            margin-right: 10px;
            -webkit-filter: drop-shadow(5px 5px 5px #222);
            filter: drop-shadow(5px 5px 5px #222);
        }
    </style>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <img src="{{ asset('assets') }}/dist/img/logo.png" alt="">
            <a href="{{ asset('assets') }}/index2.html"><b>e-Dokumen</b> Pegawai Basarnas</a>
        </div>

        <div class="card">
            @yield('content')
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
