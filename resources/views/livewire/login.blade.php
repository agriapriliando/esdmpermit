<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header"> <a href="../index2.html" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                <h1 class="mb-0">Login</h1>
            </a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Admin Perijinan ESDM Kalteng</p>
            @session('error')
                <div id="alert-error" class="alert alert-danger text-bg-danger" x-init="setTimeout(() => document.getElementById('alert-error').remove(), 3000)">
                    {{ session('error') }}
                </div>
            @endsession

            <form wire:submit.prevent="login">
                <div class="mb-2">
                    <label for="username">Username</label>
                    <input type="text" wire:model="username" class="form-control shadow-none @error('username') is-invalid @enderror" name="username" id="username">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2" x-data="{ show: true }">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input :type="show ? 'password' : 'text'" wire:model.live="password" class="form-control shadow-none @error('password') is-invalid @enderror" name="password" id="password">
                        <span class="input-group-text" @click="show = !show">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" wire:model="remember" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
                    </div>
                </div>
                <div class="mb-2 d-grid">
                    <button class="btn btn-success btn-block" type="submit">Login</button>
                </div>
            </form>
            <p class="my-2 text-center"> <a href="#" style="color: #4d4d4d !important;">Belum terdaftar? Ajukan Akun</a> </p>
            <p class="mb-1 text-center d-none"> <a style="color: #4d4d4d !important;" wire:navigate href="{{ URL::route('resetpass') }}">I forgot my password</a> </p>
        </div> <!-- /.login-card-body -->
    </div>
</div>
