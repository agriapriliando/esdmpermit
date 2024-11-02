<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link"> <!--begin::Brand Image-->
            <img src="{{ asset('') }}assets/img/logo_desdm_kalteng_white.png" alt="AdminLTE Logo" class="opacity-75 shadow" width="240"> <!--end::Brand Image-->
        </a>
        <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item d-none"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-palette"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (session('disposisi'))
                    <li class="nav-header">Daftar Pengajuan</li>
                    @foreach ($stats as $stat)
                        @if ($stat->name_stat == 'disposisi' || $stat->name_stat == 'diajukan')
                            <li class="nav-item">
                                <a wire:navigate href="{{ url('admin/' . $stat->name_stat) }}" class="nav-link {{ request()->is('admin/' . $stat->name_stat) ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-filetype-docx"></i>
                                    <p>{{ $stat->desc_stat }}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
                @if (session('admin') || session('superadmin'))
                    <li class="nav-header">Daftar Pengajuan</li>
                    @if (session('admin'))
                        @foreach ($stats as $stat)
                            @if ($stat->name_stat != 'diajukan')
                                <li class="nav-item">
                                    <a wire:navigate href="{{ url('admin/' . $stat->name_stat) }}" class="nav-link {{ request()->is('admin/' . $stat->name_stat) ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-filetype-docx"></i>
                                        <p>{{ $stat->desc_stat }}</p>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @else
                        @foreach ($stats as $stat)
                            <li class="nav-item">
                                <a wire:navigate href="{{ url('admin/' . $stat->name_stat) }}" class="nav-link {{ request()->is('admin/' . $stat->name_stat) ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-filetype-docx"></i>
                                    <p>{{ $stat->desc_stat }}</p>
                                </a>
                            </li>
                        @endforeach
                    @endif
                    <li class="nav-header">Data Master</li>
                    <li class="nav-item {{ request()->routeIs('topics.*') || request()->routeIs('users.*') || request()->routeIs('permitworks.*') ? 'menu-open' : '' }}"> <a href="#"
                            class="nav-link"> <i class="nav-icon bi bi-tree-fill"></i>
                            <p>
                                Master Data
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"> <a wire:navigate href="{{ url('permitworks') }}" class="nav-link {{ request()->routeIs('permitworks.*') ? 'active' : '' }}"> <i
                                        class="nav-icon bi bi-circle"></i>
                                    <p>Daftar Layanan<br>Permohonan</p>
                                </a>
                            </li>
                            <li class="nav-item"> <a wire:navigate href="{{ url('users') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"> <i
                                        class="nav-icon bi bi-circle"></i>
                                    <p>Daftar Akun</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (session('pemohon'))
                    <li class="nav-item"> <a wire:navigate href="{{ route('appreq.create') }}" class="nav-link {{ request()->routeIs('appreq.create') ? 'active' : '' }}"> <i
                                class="nav-icon bi bi-filetype-docx"></i>
                            <p>Pengajuan</p>
                        </a>
                    </li>
                    <li class="nav-item"> <a wire:navigate href="{{ url('pengajuan/list') }}" class="nav-link {{ request()->is('pengajuan/list') ? 'active' : '' }}"> <i
                                class="nav-icon bi bi-filetype-docx"></i>
                            <p>Daftar Ajuan</p>
                        </a>
                    </li>
                    <li class="nav-item"> <a wire:navigate href="{{ url('pengajuan/selesai') }}" class="nav-link {{ request()->is('pengajuan/selesai') ? 'active' : '' }}"> <i
                                class="nav-icon bi bi-filetype-docx"></i>
                            <p>Ajuan Selesai</p>
                        </a>
                    </li>
                @endif
                <hr class="mb-5">
                <li class="nav-item d-none"> <a target="_blank" href="https://www.ditaria.com/" class="nav-link">
                        <p>Dev by ditaria.com</p>
                    </a>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->
@script
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    </script>
@endscript
