<x-slot:bodyclass>login-page background</x-slot>
<div class="login-box">
    <div class="mb-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Link Reset Password dikirim ke Email Terdaftar 222@gmail.com
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <div class="card card-outline card-primary">
        <div class="card-header"> <a href="../index2.html" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                <h1 class="mb-0">Reset Password</h1>
            </a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Admin Perijinan ESDM Kalteng</p>
            <form action="">
                <div class="mb-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control shadow-none" name="email" id="email">
                </div>
                <div class="mb-2 d-grid">
                    <button class="btn btn-success btn-block" type="submit">Kirim Link</button>
                </div>
            </form>
            <p class="mb-1 text-center"> <a style="color: #4d4d4d !important;" wire:navigate href="{{ URL::route('login') }}">Kembali Ke Halaman Login</a> </p>
        </div> <!-- /.login-card-body -->
    </div>
</div>
