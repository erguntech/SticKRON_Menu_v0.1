<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noodp">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>RW Admin | Bakım Çalışması</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}"/>
    <link href="{{ asset('assets/plugins/custom/gravity/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/gravity/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/gravity/css/hero.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<div id="main">
    <div id="page-loader">
        <div class="spinner-container">
            <div class="css-spinner"></div>
        </div>
    </div>
    <section id="hero" class="hero hero-1">
        <div class="front-content">
            <div class="container-mid">
                <div class="row mb-4">
                    <img src="{{ asset('assets/media/logos/login_logo_dark-01.svg') }}" alt="logo" style="height: 150px;">
                </div>
                <span class="text-white fw-semibold fs-4">Sistemimizde bakım çalışması yapılmaktadır. En kısa zamanda tekrar aktif olacğız.<br>Anlayışınız için teşekkür ederiz.</span>
            </div>
        </div>
        <div class="background-content page-enter-animated">
            <!-- LEVEL 1 -->
            <div class="level-1">
                <div class="bg-overlay"></div>
                <div class="bg-pattern"></div>
                <div id="canvas"><canvas class="bg-effect layer" data-depth="0"></canvas></div>
            </div>
            <!-- /LEVEL 1 -->
        </div>
    </section>
</div>
<script type="text/javascript" src="{{ asset('assets/plugins/custom/gravity/js/plugins/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/custom/gravity/config.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/custom/gravity/js/scripts.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/custom/gravity/js/hero.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/custom/gravity/js/custom.js') }}"></script>
</body>
</html>
