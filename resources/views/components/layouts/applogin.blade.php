<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>ESDM Kalteng</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="ESDM Prov Kalteng">
    <meta name="author" content="www.ditaria.com">
    <meta name="description" content="Dinas ESDM Provinsi Kalimantan Tengah">
    <meta name="keywords" content="esdm kalteng, perijinan">
    <link rel="icon" type="image/x-icon" href="{{ asset('') }}assets/img/favicon_miners.png">
    <!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css">
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI="
        crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/adminlte.css"><!--end::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
</head> <!--end::Head--> <!--begin::Body-->
<style nonce="{{ session()->get('csp_nonce') }}">
    .filehover {
        cursor: pointer;
    }

    .zindex {
        z-index: 3;
    }

    .splide__slide img {
        width: 100%;
        /* Paksa lebar penuh */
        height: 500px;
        /* Atur tinggi sesuai kebutuhan */
        object-fit: cover;
        /* Potong gambar agar pas tanpa merusak proporsi */
        cursor: pointer;
    }

    .gradient-background {
        background: linear-gradient(245deg, #385bee, #8f8dff);
        background-size: 120% 120%;
        animation: gradient-animation 4s ease infinite;
    }

    @keyframes gradient-animation {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }
</style>

<body class="login-page bg-body-secondary gradient-background">
    {{-- <div class="scroll-bg"></div> --}}
    {{ $slot }}
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous">
    </script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('') }}assets/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script nonce="{{ session()->get('csp_nonce') }}">
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
    </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->
    @stack('scriptlogin')
</body><!--end::Body-->

</html>
