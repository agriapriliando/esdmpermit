<main class="app-main">
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="toast-container position-fixed top-0 start-50 translate-middle-x">
                        <div id="liveToast" class="toast mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto" id="pesan"></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile Saya
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div>
    <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-md-8" id="edit">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Profile Saya</h3>
                            <div class="card-tools">
                            </div>
                        </div> <!-- /.card-header -->
                        @session('message')
                            <div id="alertm" class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                <strong>{{ session('message') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession
                        @session('error')
                            <div id="alertm" class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession
                        <div class="card-body">
                            <form wire:submit.prevent="update">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan Nama" wire:model="name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan Username"
                                                wire:model.live.debounce.500ms="username">
                                            <small>Digunakan untuk login</small>
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="nohp">No HP</label>
                                            <input type="text" inputmode="numeric" class="form-control @error('nohp') is-invalid @enderror" id="nohp" placeholder="Masukkan No HP"
                                                wire:model="nohp">
                                            <small>Contoh: 6281234567890</small>
                                            @error('nohp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email"
                                                wire:model.live.debounce="email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan Password"
                                                wire:model.live.debounce="password">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        @if ($password != null)
                                            <div class="mb-2">
                                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation"
                                                    placeholder="Masukkan Konfirmasi Password" wire:model.live.debounce="password_confirmation">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-2 d-grid" x-data="{ open: false }">
                                        <button @click="open = true" type="button" class="btn btn-sm btn-success">
                                            <i class="bi bi-plus"></i> Perbaharui Profil
                                        </button>
                                        <div x-show="open" @click.outside="open = false" class="overlay"></div>
                                        <div x-show="open" @click.away="open = false" x-transition:enter-start="modal-hapus-in" x-transition:leave-end="modal-hapus-out" class="modal-hapus">
                                            <div class="alert alert-danger text-center">
                                                Apakah Anda Yakin
                                                <button class="btn btn-sm btn-success" type="submit" wire:loading.attr="disabled">Simpan Perubahan</button>
                                                <button class="btn btn-sm btn-warning">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main>
@script
    <script>
        $wire.on('trix-blur', (event) => {
            var trix = document.getElementById("notes");
            $wire.notes = trix.getAttribute('value');
        });
        $wire.on('profile-updated', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
                // console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
                bootstrap.Alert.getOrCreateInstance("#alertm").close();
            }, 4000);
        });
    </script>
@endscript
