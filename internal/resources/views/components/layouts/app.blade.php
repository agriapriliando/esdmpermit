<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Head -->

<head>
    <!-- Page Meta Tags-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/logo/favicon-16x16.png') }}">
    <link rel="mask-icon" href="{{ asset('assets/logo/favicon-16x16.png.png') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @stack('scriptsatas')

    <!-- Fix for custom scrollbar if JS is disabled-->
    <noscript>
        <style>
            /**
          * Reinstate scrolling for non-JS clients
          */
            .simplebar-content-wrapper {
                overflow: auto;
            }
        </style>
    </noscript>

    <!-- Page Title -->
    <title>{{ $title ?? 'Bid. Tambang ESDM' }}</title>
    @if (app()->environment('local') && config('app.debug'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="gradient-bg">

    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light border-bottom py-0 fixed-top bg-white">
        <div class="container-fluid">
            <a class="navbar-brand d-flex justify-content-start align-items-center border-end" href="{{ route('home') }}">
                <div class="d-flex align-items-center">
                    <div class="me-2">
                        <img src="{{ asset('assets/logo/android-chrome-192x192.png') }}" width="30" alt="">
                    </div>
                    <span class="fw-black tracking-wide fs-6 lh-1">MinersDB Kalteng</span>
                </div>
            </a>
            <div class="d-flex justify-content-between align-items-center flex-grow-1 navbar-actions">

                <!-- Search Bar and Menu Toggle-->
                <div class="d-flex align-items-center">

                    <!-- Menu Toggle-->
                    <div class="menu-toggle cursor-pointer me-4 text-primary-hover transition-color disable-child-pointer">
                        <i class="ri-skip-back-mini-line ri-lg fold align-middle" data-bs-toggle="tooltip" data-bs-placement="right" title="Close menu"></i>
                        <i class="ri-skip-forward-mini-line ri-lg unfold align-middle" data-bs-toggle="tooltip" data-bs-placement="right" title="Open Menu"></i>
                    </div>
                    <!-- / Menu Toggle-->

                </div>
                <!-- / Search Bar and Menu Toggle-->

                <!-- Right Side Widgets-->
                <div class="d-flex align-items-center">

                    <!-- Profile Menu-->
                    @if (session('user'))
                        <span class="fw-medium badge bg-primary me-1">
                            Hai, {{ session('user')['name'] }}
                        </span>
                    @else
                        <span class="fw-medium badge bg-primary">
                            <a href="{{ route('auth.login') }}" class="btn btn-primary btn-sm">Login</a>
                        </span>
                    @endif

                </div>
                <!-- / Notifications & Profile-->
            </div>
        </div>
    </nav> <!-- / Navbar-->

    <!-- Page Content -->
    <main id="main">

        <!-- Breadcrumbs-->
        <div class="d-none bg-white border-bottom py-3 mb-5">
            <div class="container-fluid d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
                <nav class="mb-0" aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="./index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-end align-items-center mt-3 mt-md-0">
                    <a class="btn btn-sm btn-primary" href="#"><i class="ri-add-circle-line align-bottom"></i> New Project</a>
                    <a class="btn btn-sm btn-primary-faded ms-2" href="#"><i class="ri-settings-3-line align-bottom"></i> Settings</a>
                    <a class="btn btn-sm btn-secondary-faded ms-2 text-body" href="#"><i class="ri-question-line align-bottom"></i> Help</a>
                </div>
            </div>
        </div>
        <!-- / Breadcrumbs-->

        <!-- Content-->
        <section class="container-fluid mt-4">
            @if ($slot)
                {{ $slot }}
            @endif
            @yield('content')

            <!-- Footer -->
            <footer class="footer" style="background-color: white !important;">
                <p class="small text-muted m-0">All rights reserved | © 2025</p>
            </footer>
            <!-- Footer -->


            <!-- Sidebar Menu Overlay-->
            <div class="menu-overlay-bg"></div>
            <!-- / Sidebar Menu Overlay-->

        </section>
        <!-- / Content-->

    </main>
    <!-- /Page Content -->

    <!-- Page Aside-->
    <aside class="aside bg-white">

        <div class="simplebar-wrapper">
            <div data-pixr-simplebar>
                <div class="pb-6">
                    <!-- Mobile Logo-->
                    <div class="d-flex d-xl-none justify-content-between align-items-center border-bottom aside-header">
                        <a class="navbar-brand lh-1 border-0 m-0 d-flex align-items-center" href="./index.html">
                            <div class="d-flex align-items-center">
                                <div class="me-2">
                                    <img src="{{ asset('assets/logo/android-chrome-192x192.png') }}" width="30" alt="">
                                </div>
                                <span class="fw-black text-uppercase tracking-wide fs-6 lh-1">DESDM Kalteng</span>
                            </div>
                        </a>
                        <i class="ri-close-circle-line ri-lg close-menu text-muted transition-all text-primary-hover me-4 cursor-pointer"></i>
                    </div>
                    <!-- / Mobile Logo-->

                    <ul class="list-unstyled mb-6">

                        <!-- Dashboard Menu Section-->
                        <li class="menu-section mt-2">Menu</li>
                        @if (session('user'))
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('home') }}">
                                    <span class="menu-icon">
                                        <i class="ri-dashboard-line"></i>
                                    </span>
                                    <span class="menu-link">
                                        D A F T A R
                                    </span></a>
                            </li>
                        @endif
                        <!-- / Dashboard Menu Section-->
                        @if (session('id_perusahaan') != null)
                            <!-- Menu Perusahaan Section-->
                            <li class="menu-section mt-4">Menu Perusahaan</li>
                            <!-- Profil Menu Section-->
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('profile.show', session('id_perusahaan')) }}">
                                    <span class="menu-icon">
                                        <i class="ri-user-line"></i>
                                    </span>
                                    <span class="menu-link">
                                        Profil Perusahaan
                                    </span></a>
                            </li>
                            <!-- / Profil Menu Dokumen Teknis-->
                            @php
                                $jenis_izin = \App\Models\Profile::find(session('id_perusahaan'))?->jenis_izin ?? '-';
                            @endphp
                            @if ($jenis_izin == 'IUP' || $jenis_izin == 'SIPB')
                                <li class="menu-item"><a class="d-flex align-items-center collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMenuItemPages"
                                        aria-expanded="false" aria-controls="collapseMenuItemPages">
                                        <span class="menu-icon">
                                            <i class="ri-file-list-3-line"></i>
                                        </span>
                                        <span class="menu-link">Dokumen Teknis</span></a>
                                    <div class="collapse" id="collapseMenuItemPages">
                                        <ul class="submenu">
                                            @if ($jenis_izin == 'IUP')
                                                <li><a href="{{ route('le.show') }}"><span class="menu-icon"><i class="ri-file-search-line"></i></span>Laporan Eksplorasi</a></li>
                                                <li><a href="{{ route('pl.show') }}"><span class="menu-icon"><i class="ri-leaf-line"></i></span>Persetujuan Lingkungan (PKPLH/SKKL)</a></li>
                                                <li><a href="{{ route('stk.show') }}"><span class="menu-icon"><i class="ri-book-2-line"></i></span>Studi Kelayakan</a></li>
                                                <li><a href="{{ route('rr.show') }}"><span class="menu-icon"><i class="ri-seedling-line"></i></span>Rencana Reklamasi (RR)</a></li>
                                                <li><a href="{{ route('rpt.show') }}"><span class="menu-icon"><i class="ri-earth-line"></i></span>Rencana Pascatambang (RPT)</a></li>
                                                <li><a href="{{ route('ktt.show') }}"><span class="menu-icon"><i class="ri-shield-user-line"></i></span>Kepala Teknik Tambang (KTT)</a></li>
                                                <li>
                                                    <a href="{{ route('rippm.show') }}">
                                                        <span class="menu-icon"><i class="ri-government-line"></i></span>
                                                        Rencana Induk Pengembangan dan Pemberdayaan Masyarakat (RIPPM)
                                                    </a>
                                                </li>
                                                <li><a href="{{ route('tb.show') }}"><span class="menu-icon"><i class="ri-flag-line"></i></span>Tanda Batas</a></li>
                                                <li><a href="{{ route('rkabop.show') }}"><span class="menu-icon"><i class="ri-briefcase-4-line"></i></span>Rencana Kerja Anggaran Biaya (RKAB)</a>
                                                </li>
                                                <li><a href="{{ route('kim.show') }}"><span class="menu-icon"><i class="ri-key-2-line"></i></span>Kartu Izin Meledakan (KIM)</a></li>
                                                <li><a href="{{ route('handak.show') }}"><span class="menu-icon"><i class="ri-archive-line"></i></span>Gudang Bahan Peledak</a></li>
                                                <li><a href="{{ route('bbc.show') }}"><span class="menu-icon"><i class="ri-oil-line"></i></span>Tangki BBC</a></li>
                                                <li><a href="{{ route('pelabuhan.show') }}"><span class="menu-icon"><i class="ri-anchor-line"></i></span>Pelabuhan</a></li>
                                                <li><a href="{{ route('pa.show') }}"><span class="menu-icon"><i class="ri-map-pin-line"></i></span>Project Area</a></li>
                                                <li><a href="{{ route('iuran.show') }}"><span class="menu-icon"><i class="ri-money-dollar-circle-line"></i></span>Iuran Tetap Tahunan</a></li>
                                                <li><a href="{{ route('iui.show') }}"><span class="menu-icon"><i class="ri-file-list-3-line"></i></span>Izin Usaha Industri (IUI)</a></li>
                                            @endif
                                            @if ($jenis_izin == 'SIPB')
                                                <li><a href="{{ route('pl.show') }}"><span class="menu-icon"><i class="ri-leaf-line"></i></span>Persetujuan Lingkungan (PKPLH/SKKL)</a></li>
                                                <li><a href="{{ route('sipbrp.show') }}"><span class="menu-icon"><i class="ri-road-map-line"></i></span>Rencana Penambangan</a></li>
                                                <li><a href="{{ route('sipbrtp.show') }}"><span class="menu-icon"><i class="ri-tools-line"></i></span>Rencana Teknis Penambangan</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            <!-- Pelaporan Section-->
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('reportmonth.show') }}">
                                    <span class="menu-icon">
                                        <i class="ri-file-list-2-line"></i>
                                    </span>
                                    <span class="menu-link">
                                        Bulanan
                                    </span></a>
                            </li>
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('triwulan.show') }}">
                                    <span class="menu-icon">
                                        <i class="ri-file-list-2-line"></i>
                                    </span>
                                    <span class="menu-link">
                                        Triwulan
                                    </span></a>
                            </li>
                            <!-- / Pelaporan Section-->
                            <!-- Pelaporan Section-->
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('pelaporan.show') }}">
                                    <span class="menu-icon">
                                        <i class="ri-archive-drawer-line"></i>
                                    </span>
                                    <span class="menu-link">
                                        Pelaporan
                                    </span></a>
                            </li>
                            <!-- / Pelaporan Section-->
                            <!-- Surat Menyurat Section-->
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('surat.show') }}">
                                    <span class="menu-icon">
                                        <i class="ri-archive-drawer-line"></i>
                                    </span>
                                    <span class="menu-link">
                                        Surat Menyurat
                                    </span></a>
                            </li>
                            <!-- / Surat Menyurat Section-->
                            <!-- / Menu Perusahaan Section-->
                        @endif
                        <!-- Logout Section-->
                        @if (session('user'))
                            <li class="menu-item">
                                <div class="d-flex align-items-center ms-2">
                                    <form action="{{ route('auth.logout') }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        <button type="submit" class="btn w-100 d-flex align-items-center text-start">
                                            <span class="menu-icon me-2">
                                                <i class="ri-logout-circle-line text-danger"></i>
                                            </span>
                                            <span class="menu-link text-danger fw-semibold">
                                                L O G O U T
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                            <!-- / Logout Section-->
                        @else
                            <li class="menu-item">
                                <a class="d-flex align-items-center" href="{{ route('auth.login') }}">
                                    <span class="menu-icon">
                                        <i class="ri-archive-drawer-line"></i>
                                    </span>
                                    <span class="menu-link">
                                        LOGIN
                                    </span></a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </aside> <!-- / Page Aside-->

    @stack('scriptsbawah')

</body>

</html>
