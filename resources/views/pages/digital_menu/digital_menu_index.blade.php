<!doctype html>
<html class="no-js" lang="tr">
<head>
    <title>{{ $client->company_name }} | Dijital Menü</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="SticKRON">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="">
    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('assets/crafto/images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/crafto/images/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/crafto/images/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/crafto/images/apple-touch-icon-114x114.png') }}">
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="{{ asset('assets/crafto/css/vendors.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/crafto/css/icon.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/crafto/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/crafto/css/responsive.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/crafto/demos/restaurant/restaurant.css') }}" />
    <style>
        .page-layout{min-height:100vh;display:flex;flex-direction:column;}
        .page-layout>footer{margin-top:auto;position:static !important;}
    </style>
</head>
<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#383632" class="custom-cursor">
<!-- start cursor -->
<div class="cursor-page-inner">
    <div class="circle-cursor circle-cursor-inner"></div>
    <div class="circle-cursor circle-cursor-outer"></div>
</div>

<!-- start page title -->
<section class="ipad-top-space-margin page-title-big-typography" style="padding-top: 50px !important; padding-bottom: 50px !important;">
    <div class="container">
        <div class="row align-items-center justify-content-center small-screen" style="height: 100px !important;">
            <div class="col-lg-12 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
                <h1 class="alt-font fw-400 text-dark-gray text-uppercase ls-minus-1px mb-0">{{ $client->company_name }}</h1>
            </div>
        </div>
        @if($client->facebook_address != null || $client->instagram_address != null)
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center elements-social social-icon-style-03">
                    <ul class="medium-icon">
                        @if($client->facebook_address != null)
                            @php
                                $fb = trim($client->facebook_address ?? '');
                                if ($fb !== '' && !\Illuminate\Support\Str::startsWith($fb, ['http://', 'https://'])) {
                                    $fb = 'https://' . ltrim($fb, '/');
                                }
                            @endphp

                            @if(!empty($fb))
                                <li>
                                    <a class="facebook" href="{{ $fb }}" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>
                            @endif
                        @endif
                        @if($client->instagram_address != null)
                            @php
                                $ig = trim($client->instagram_address ?? '');
                                if ($ig !== '' && !\Illuminate\Support\Str::startsWith($ig, ['http://', 'https://'])) {
                                    $ig = 'https://' . ltrim($ig, '/');
                                }
                            @endphp

                            @if(!empty($ig))
                                <li>
                                    <a class="instagram" href="{{ $ig }}" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- end page title -->

@if (count($clientCategories) > 0 || count($clientCampaigns) > 0)
    @if (count($clientCategories) > 0)
        <!-- start section -->
        <section class="cover-background pt-2 pb-2" style="background-image: url('{{ asset('assets/crafto/images/menu_bg.jpg') }}')">
            <div class="container">
                <div class="row justify-content-center mb-1">
                    <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="fs-15 fw-600 text-red text-uppercase mb-10px d-block"><span class="w-5px h-2px bg-red d-inline-block align-middle me-5px"></span>{{ $client->company_name }}<span class="w-5px h-2px bg-red d-inline-block align-middle ms-5px"></span></span>
                        <h2 class="alt-font text-dark-gray">MENÜ</h2>
                    </div>
                </div>
                <div class="row mb-6 xs-mb-8">
                    <div class="col tab-style-02 fs-600">
                        <ul class="nav nav-tabs justify-content-center flex-wrap mb-4" role="tablist">
                            @foreach($clientCategories as $clientCategory)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                       id="tabIndex{{ $clientCategory->id }}-tab"
                                       data-bs-toggle="tab"
                                       href="#tabIndex{{ $clientCategory->id }}"
                                       role="tab"
                                       aria-controls="tabIndex{{ $clientCategory->id }}"
                                       aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $clientCategory->category_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach($clientCategories as $clientCategory)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tabIndex{{ $clientCategory->id }}" role="tabpanel" aria-labelledby="tabIndex{{ $clientCategory->id }}-tab">
                                    @php
                                        $items = $clientCategory->contents;                // eager loaded
                                        $chunks = $items->values()->chunk(ceil(max(1, $items->count())/2));
                                    @endphp
                                    <div class="row justify-content-center">
                                        @foreach($chunks as $chunk)
                                            <div class="col-lg-12">
                                                <ul class="pricing-table-style-12"
                                                    data-anime='{ "el": "childs", "rotateX": [-40, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                                                    @foreach($chunk as $content)
                                                        <li class="last-paragraph-no-margin d-flex">
                                                            @php
                                                                $imagePath = 'uploads/products/'.$content->linked_client_id.'/'.$content->id.'/'.$content->id.'.jpg';
                                                            @endphp
                                                            <img
                                                                src="{{ Storage::disk('public')->exists($imagePath)
                                                                ? asset('storage/'.$imagePath)
                                                                : asset('assets/crafto/images/placeholder.jpg') }}"
                                                                class="rounded-circle"
                                                                alt=""
                                                                width="105"
                                                                height="105">
                                                            <div class="ms-30px xs-ms-0 flex-grow-1">
                                                                <div class="d-flex align-items-center w-100 fs-18 mb-5px">
                                                                    <span class="fw-600 text-dark-gray">{{ $content->content_name }}</span>
                                                                    <div class="divider-style-03 divider-style-03-02 border-color-extra-medium-gray flex-grow-1 ms-20px me-20px"></div>
                                                                    <div class="ms-auto fw-600 text-dark-gray">
                                                                        @if(!is_null($content->content_price))
                                                                            {{ number_format($content->content_price, 2, ',', '.') }} TL
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @if(!empty($content->content_description))
                                                                    <p class="mb-0">{{ $content->content_description }}</p>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center" data-anime='{ "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="col-12 text-center last-paragraph-no-margin">
                        <div class="d-inline-block align-middle bg-red fw-500 text-white border-radius-30px ps-20px pe-20px fs-14 me-10px sm-m-10px">Afiyet Olsun :)</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
    @endif
    @if (count($clientCampaigns) > 0)
        <!-- start section -->
        <section class="pt-2 pb-2">
            <div class="container">
                <div class="row justify-content-center mb-3">
                    <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="fs-15 fw-600 text-red text-uppercase mb-10px d-block"><span class="w-5px h-2px bg-red d-inline-block align-middle me-5px"></span>{{ $client->company_name }}<span class="w-5px h-2px bg-red d-inline-block align-middle ms-5px"></span></span>
                        <h2 class="alt-font fw-400 text-dark-gray">Kampanyalar</h2>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-lg-3 row-cols-sm-2 justify-content-center" data-anime='{ "el": "childs", "translateY": [50, 0], "rotateY": [-30, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 300, "easing": "easeOutQuad" }'>

                    @foreach($clientCampaigns as $clientCampaign)
                        <div class="col text-center md-mb-50px sm-mb-30px">
                            <!-- start services box style -->
                            <div class="services-box-style-04 last-paragraph-no-margin border-radius-4px overflow-hidden position-relative">
                                <div class="mb-25px">
                                    <img src="{{ asset(Storage::url("uploads/campaigns/{$clientCampaign->linked_client_id}/{$clientCampaign->id}/{$clientCampaign->id}.jpg")) }}" alt="" data-bottom-top="transform: rotate(15deg)" data-top-bottom="transform:rotate(-15deg)">
                                </div>
                                <div class="box-overlay bg-white z-index-minus-1"></div>
                                <div>
                                    <div class="d-block fs-24 alt-font ls-minus-05px text-dark-gray">{{ $clientCampaign->campaign_name }}</div>
                                    <span class="fs-26 alt-font ls-minus-1px text-dark-gray">
                                    <del class="me-10px text-red">
                                        {{ number_format($clientCampaign->campaign_standard_price, 2, ',', '.') }} TL
                                    </del>
                                    {{ number_format($clientCampaign->campaign_discounted_price, 2, ',', '.') }} TL
                                </span>
                                </div>
                            </div>
                            <!-- end services box style -->
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end section -->
    @endif
@else
    <section class="cover-background" style="background-image: url('{{ asset('assets/crafto/images/menu_bg.jpg') }}')">
        <div id="particles-style-01" class="position-absolute h-100 top-0 left-0 w-100" data-particle="true" data-particle-options='{"particles":{"number":{"value":10,"density":{"enable":true,"value_area":800}},"color":{"value":"#b0b4e2"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":4,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":false,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true}'></div>
        <div class="container">
            <!-- start countdown item -->
            <div class="row align-items-center justify-content-center h-100 z-index-2 position-relative">
                <div class="col-md-10 col-lg-10 col-xl-6 text-center">
                    <span class="fw-400 fs-50 mb-20px d-block alt-font text-dark-gray ls-minus-2px">Dijital Menüye Hoş Geldiniz</span>
                    <h6 class="text-dark-gray mb-10 alt-font">Çok yakında burada hizmetinizde olacağız!</h6>
                </div>
            </div>
            <!-- end countdown item -->
        </div>
    </section>
@endif


<!-- start footer -->
<footer class="pb-0 pt-0 bg-very-light-green">
    <div class="border-top border-color-transparent-dark-very-light pt-25px pb-25px">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-6 fs-15 last-paragraph-no-margin text-center text-sm-start order-3 order-sm-2 order-md-1">
                    <p>&COPY; Copyright {{ date('Y') }} <a href="digitalmenu.stickron.com" target="_blank" class="text-decoration-line-bottom text-dark-gray fw-600">Stickron Dijital Menu</a></p>
                </div>

                <div class="col-md-6 col-sm-6 elements-social social-icon-style-08 xs-mb-15px text-center text-sm-end order-2 order-sm-3 order-md-3">
                    <ul class="small-icon dark d-inline-block">
                        <li><a class="instagram" href="https://www.instagram.com/stickronsocial" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->

<!-- start scroll progress -->
<div class="scroll-progress d-none d-xxl-block">
    <a href="#" class="scroll-top" aria-label="scroll">
        <span class="scroll-text">Yukarı Kaydır</span><span class="scroll-line"><span class="scroll-point"></span></span>
    </a>
</div>

<script type="text/javascript" src="{{ asset('assets/crafto/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/crafto/js/vendors.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/crafto/js/main.js') }}"></script>
<script>
    document.addEventListener('shown.bs.tab', function (e) {
        const selector = e.target.getAttribute('href'); // örn: "#tabIndex2"
        if (!selector) return;
        const $pane = $(selector);
        $pane.find('[data-anime]').each(function () {
            $(this).trigger('appear');     // animasyonu başlat
            $(this).addClass('appear');    // güvenlik için sınıfı da ekle
        });
    });
</script>
</body>
</html>
