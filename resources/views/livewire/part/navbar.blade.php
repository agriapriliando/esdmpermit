<nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
        </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
            @if (Auth::user()->role != 'pemohon')
                <li class="nav-item"> <a class="nav-link" wire:navigate href="{{ route('admin.profile') }}" role="button"><i class="bi bi-person-circle"></i> Profile</a> </li>
            @else
                <li class="nav-item"> <a class="nav-link" wire:navigate href="{{ route('profile') }}" role="button"><i class="bi bi-person-circle"></i> Profile</a> </li>
            @endif
            <li class="nav-item"> <a class="btn btn-sm btn-danger mt-1" href="{{ route('logout') }}" role="button"><i class="bi bi-backspace"></i> Logout</a> </li>
        </ul> <!--end::End Navbar Links-->
    </div> <!--end::Container-->
</nav>
