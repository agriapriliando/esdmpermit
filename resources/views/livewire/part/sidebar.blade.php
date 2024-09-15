<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link"> <!--begin::Brand Image--> <img src="{{ asset('') }}assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a>
        <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-palette"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item"> <a wire:navigate href="{{ url('permohonan') }}" class="nav-link {{ request()->routeIs('appreq.create') ? 'active' : '' }}"> <i
                            class="nav-icon bi bi-filetype-docx"></i>
                        <p>Permohonan</p>
                    </a>
                </li>
                <li class="nav-item"> <a wire:navigate href="{{ url('permohonan/list') }}" class="nav-link {{ request()->routeIs('appreq.list') ? 'active' : '' }}"> <i
                            class="nav-icon bi bi-filetype-docx"></i>
                        <p>Daftar</p>
                    </a>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Permohonan
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../widgets/small-box.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Tambah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../widgets/small-box.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Daftar Permohonan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Korespondensi</li>
                <li class="nav-item"> <a href="../generate/theme.html" class="nav-link"> <i class="nav-icon bi bi-palette"></i>
                        <p>Korespondensi <span class="nav-badge badge text-bg-secondary me-3">6</span></p>
                    </a>
                </li>
                <li class="nav-header">Data Master</li>
                <li class="nav-item {{ request()->routeIs('topics.*') || request()->routeIs('users.*') || request()->routeIs('permitworks.*') ? 'menu-open' : '' }}"> <a href="#"
                        class="nav-link"> <i class="nav-icon bi bi-tree-fill"></i>
                        <p>
                            Master Data
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="../UI/general.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Daftar Perusahaan</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a wire:navigate href="{{ url('permitworks') }}" class="nav-link {{ request()->routeIs('permitworks.*') ? 'active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Daftar Layanan<br>Permohonan</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a wire:navigate href="{{ url('topics') }}" class="nav-link {{ request()->routeIs('topics.*') ? 'active' : '' }}"> <i class="nav-icon bi bi-circle"></i>
                                <p>Daftar Topik <br>Korespondensi</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a wire:navigate href="{{ url('users') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"> <i class="nav-icon bi bi-circle"></i>
                                <p>Daftar Akun</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"> <a target="_blank" href="https://www.ditaria.com/" class="nav-link">
                        <p>Dev by ditaria.com</p>
                    </a>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->
@script
    <script>
        $wire.on('sidebar', (event) => {
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
        });
    </script>
@endscript
