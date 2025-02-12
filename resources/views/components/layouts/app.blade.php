<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ $title ?? 'ESDM Kalteng' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="ESDM Provinsi Kalimantan Tengah">
    <meta name="author" content="ditaria.com">
    <meta name="description" content="ESDM Kalteng">
    <meta name="keywords" content="esdm kalteng">
    <link rel="icon" type="image/x-icon" href="{{ asset('') }}assets/img/favicon_miners.png">
    <!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg="
        crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI="
        crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/adminlte.css"><!--end::Required Plugin(AdminLTE)-->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    @stack('styles')
    {{-- trix editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

</head> <!--end::Head--> <!--begin::Body-->
<style>
    textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    .uneditable-input:focus {
        border-color: rgba(46, 46, 46, 0.8);
        box-shadow: 0 0px 0px rgba(0, 0, 0, 0.075) inset, 0 0 1px rgba(61, 61, 61, 0.6);
        outline: 0 none;
    }

    .modal-hapus {
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 99999;
        width: 350px;
        opacity: 100;
        border-radius: 10px;
        transition: top 0.2s, opacity 0.5s;
    }

    .modal-hapus-in {
        top: 0;
        opacity: 0;
    }

    .modal-hapus-out {
        top: 10%;
        opacity: 0;
        /* transition: top 5s; */
    }

    .modal-panduan {
        position: fixed;
        top: 35%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 99999;
        min-width: 380px;
        opacity: 100;
        border-radius: 10px;
        transition: top 0.2s, opacity 0.5s;
    }

    .modal-panduan-in {
        top: 0;
        opacity: 0;
    }

    .modal-panduan-out {
        top: 10%;
        opacity: 0;
        /* transition: top 5s; */
    }

    .overlay {
        position: fixed;
        inset: 0;
        z-index: 9998;
        backdrop-filter: blur(2px);
        background-color: rgb(0, 0, 0, 0.1);
        transition: 5s ease;
    }

    .trix-button-group .trix-button-group--block-tools {
        display: none;
    }

    .trix-button--icon-strike,
    .trix-button--icon-italic,
    .trix-button--icon-bullet-list,
    .trix-button--icon-increase-nesting-level,
    .trix-button--icon-decrease-nesting-level,
    .trix-button-group--file-tools,
    .trix-button--icon-attach,
    .trix-button--icon-quote,
    .trix-button--icon-heading-1,
    .trix-button--icon-number-list,
    .trix-button--icon-code {
        display: none;
    }

    .filehover {
        cursor: pointer;
    }

    .modal-dokumen {
        position: fixed;
        top: 82%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 99999;
        min-width: 700px;
        height: 900px;
        opacity: 100;
        border-radius: 10px;
        transition: top 0.2s, opacity 0.5s;
    }


    @media only screen and (max-width: 600px) {
        .modal-dokumen {
            top: 70%;
        }

        .sizemodal-dokumen {
            width: 300px;
            height: 500px
        }
    }

    @media only screen and (min-width: 600px) {
        .sizemodal-dokumen {
            min-width: 700px;
            min-height: 600px
        }
    }

    @media only screen and (min-width: 1400px) {
        .modal-dokumen {
            top: 50%;
        }

        .sizemodal-dokumen {
            min-width: 1000px;
            min-height: 800px
        }

    }
</style>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        @livewire('part.navbar')
        <!--end::Header-->
        <!--begin::Sidebar-->
        @livewire('part.sidebar')
        <!--end::Sidebar-->
        <!--begin::App Main-->
        {{ $slot }}
        <!--end::App Main-->
        <!--begin::Footer-->
        <footer class="app-footer"> <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">www.minerskalteng.com</div> <!--end::To the end--> <!--begin::Copyright--> <strong>
                Copyright &copy; 2025&nbsp;
                <a href="https://esdm.kalteng.go.id" class="text-decoration-none">Dinas ESDM Kalimantan Tengah</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer> <!--end::Footer-->
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    {{-- <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('') }}assets/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    @stack('scripts')

</body><!--end::Body-->

</html>
