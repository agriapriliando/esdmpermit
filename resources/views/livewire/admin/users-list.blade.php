<main class="app-main">
    <style>
        .modal-hapus {
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 99999;
            width: 200px;
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

        .overlay {
            position: fixed;
            inset: 0;
            z-index: 99998;
            backdrop-filter: blur(2px);
            background-color: rgb(0, 0, 0, 0.1);
            transition: 5s ease;
        }
    </style> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-12">
                    <div x-data
                        @notify.window="
                    setTimeout(function() {
                        bootstrap.Toast.getOrCreateInstance(document.getElementById('liveToast')).show();
                        document.getElementById('pesan').innerHTML = $event.detail.message;
                        console.log($event.detail.message);
                    }, 1000);
                    "
                        class="toast-container position-fixed top-0 start-50 translate-middle-x">
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
                            Daftar Akun
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
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Akun</h3>
                            <div class="card-tools">
                                <div class="input-group" x-data="{ search: '' }">
                                    <input wire:model.live.debounce="search" x-model="search" type="text" name="search" class="form-control form-control-sm float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button wire:click="resetSearch" type="submit" class="btn btn-warning">
                                            <i class="bi bi-x-square-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <div class="d-flex flex-column flex-lg-row float-end">
                                <a wire:click="resetForm" href="#edit" class="btn btn-success me-2 mb-2"><i class="bi bi-plus"></i> Tambah</a>
                                <button @click="$dispatch('notify', { message: 'Refresh Daftar Akun Berhasil' })" class="btn btn-warning me-2 mb-2" type="button" x-on:click="$wire.$refresh()"
                                    wire:loading.attr="disabled">
                                    <i class="bi bi-arrow-repeat"></i> Refresh
                                </button>
                            </div>
                            <div class="d-flex flex-column flex-lg-row">
                                <div class="me-2 mb-2">
                                    <select wire:model.live="pagelength" class="form-select" aria-label="Default select example">
                                        <option value="">All</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                                <div class="me-2 mb-2">
                                    <select wire:model.live="jenis_role" class="form-select" aria-label="Default select example">
                                        <option value="">Semua Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="pemohon">Pemohon</option>
                                    </select>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama | Username | Role</th>
                                        <th>Kontak</th>
                                        <th>Tanggal</th>
                                        <th style="width: 40px">Label</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Modal -->

                                    @foreach ($users as $item)
                                        <tr class="align-middle" x-data="{ open: false }">
                                            <td>{{ ($users->currentpage() - 1) * $users->perpage() + $loop->index + 1 }}</td>
                                            <td>{{ $item->name }} <br> <span class="badge text-bg-warning">Username: {{ $item->username }}</span>
                                                <br> <span class="badge {{ $item->role == 'admin' ? 'text-bg-primary' : 'text-bg-info' }}">Role: {{ $item->role }}</span>
                                            </td>
                                            <td><a href="#" class="btn btn-sm btn-success"><i class="bi bi-whatsapp"></i> {{ $item->nohp }}</a></td>
                                            <td>
                                                <div class="badge text-bg-success">{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') }} Wib</div><br>
                                                <div class="badge text-bg-success">{{ Carbon\Carbon::parse($item->updated_at)->translatedFormat('d F Y H:i') }} Wib</div>
                                            </td>
                                            <td class="d-flex">
                                                <a wire:click="edit({{ $item->id }})" href="#edit" class="btn btn-sm btn-warning me-2">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button @click="open = true" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <div x-show="open" @click.outside="open = false" class="overlay"></div>
                                                <div x-show="open" @click.away="open = false" x-transition:enter-start="modal-hapus-in" x-transition:leave-end="modal-hapus-out" class="modal-hapus">
                                                    <div class="alert alert-danger text-center">Yakin ingin menghapus?
                                                        <p class="fw-bold">{{ $item->name }}</p>
                                                        <button wire:click.prevent="getUserDelete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus!!</button>
                                                        <button class="btn btn-sm btn-warning">Batal</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $users->links() }}
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
                <div class="col-md-6" id="edit">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="card-tools">
                                <button wire:click="resetForm" class="btn btn-sm btn-warning"><i class="bi bi-arrow-counterclockwise"></i> Reset Form</button>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body" x-data="{ pass: false, password: '' }">
                            <form wire:submit.prevent="save({{ $id }})">
                                <div class="mb-2">
                                    <label for="name">Nama</label>
                                    <input wire:model.blur="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="username">Username</label>
                                    <input wire:model.blur="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" x-model="password">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="nohp">No HP</label>
                                    <input wire:model.blur="nohp" type="text" inputmode="numeric" class="form-control @error('nohp') is-invalid @enderror" id="nohp">
                                    @error('nohp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="email">Email</label>
                                    <input wire:model.blur="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" inputmode="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="password">Password Default menggunakan Username</label>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" x-model="pass">
                                        <label class="form-check-label" for="exampleCheck1">Gunakan Password Berbeda</label>
                                    </div>
                                    <div x-show="pass">
                                        <label for="password">Password</label>
                                        <input wire:model.live="password" type="password" class="form-control" id="password">
                                    </div>
                                </div>
                                <div class="mb-2 d-grid">
                                    <button class="btn btn-success" type="submit">{{ $title }}</button>
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
        $wire.on('user-deleted', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                element.className += " text-bg-success";
                document.getElementById('pesan').innerHTML = event.message;
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 2000);
        });
        $wire.on('user-created', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 2000);
        });
        $wire.on('user-updated', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 2000);
        });
        $wire.on('user-add-error', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                element.className += " text-bg-danger";
                document.getElementById('pesan').innerHTML = event.message;
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 2000);
        });
    </script>
@endscript
