<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header"> <a href="../index2.html" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                <h1 class="mb-0">Login</h1>
            </a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Admin Perijinan ESDM Kalteng</p>
            <form action="">
                <div class="mb-2">
                    <label for="username">Username</label>
                    <input type="text" class="form-control shadow-none" name="username" id="username">
                </div>
                <div class="mb-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control shadow-none" name="password" id="username">
                </div>
                <div class="mb-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
                    </div>
                </div>
                <div class="mb-2 d-grid">
                    <a wire:navigate href="{{ url('users') }}" class="btn btn-success btn-block">Login</a>
                    {{-- <button class="btn btn-success btn-block" type="submit">Login</button> --}}
                </div>
            </form>
            <p class="mb-1 text-center"> <a style="color: #4d4d4d !important;" wire:navigate href="{{ URL::route('resetpass') }}">I forgot my password</a> </p>
        </div> <!-- /.login-card-body -->
    </div>
</div>
