<nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
        </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
            @if (Auth::user()->role != 'pemohon')
                <li class="nav-item"> <a class="nav-link" wire:navigate href="{{ route('admin.profile') }}" role="button">
                        <i class="bi bi-person-circle me-2"></i>
                        Hai, {{ Auth::user()->name }}
                        @if (Auth::user()->role == 'disposisi')
                            <span class="badge bg-success pillbadge rounded-pill text-bg-success">
                                Operator
                            </span>
                        @elseif (Auth::user()->role == 'admin')
                            <span class="badge bg-success pillbadge rounded-pill text-bg-success">
                                Evaluator
                            </span>
                        @elseif (Auth::user()->role == 'adminutama')
                            <span class="badge bg-success pillbadge rounded-pill text-bg-success">
                                Admin Utama
                            </span>
                        @endif
                    </a>
                </li>
            @else
                <li class="nav-item"> <a class="nav-link" wire:navigate href="{{ route('profile') }}" role="button">
                        <i class="bi bi-person-circle me-2"></i>
                        Hai, {{ Auth::user()->name }}
                        <span class="badge bg-success pillbadge rounded-pill text-bg-success">
                            {{ Auth::user()->role }}
                        </span>
                    </a>
                </li>
            @endif
            <li class="nav-item"> <a class="btn btn-sm btn-danger mt-1" href="{{ route('logout') }}" role="button"><i class="bi bi-backspace me-2"></i> Logout</a> </li>
        </ul> <!--end::End Navbar Links-->
    </div> <!--end::Container-->
</nav>
