<main class="app-main">
    <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content mt-3"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
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
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            @session('success')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endsession
                            <h3 class="card-title">Daftar Akun Pemohon</h3>
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
                                <a wire:navigate href="{{ route('user.create') }}" class="btn btn-success me-2 mb-2"><i class="bi bi-plus"></i> Tambah</a>
                                <button @click="$dispatch('notify', { message: 'Refresh Daftar Akun Berhasil' })" class="btn btn-warning me-2 mb-2" type="button" x-on:click="$wire.$refresh()"
                                    wire:loading.attr="disabled">
                                    <i class="bi bi-arrow-repeat"></i> Refresh
                                </button>
                            </div>
                            <div class="mb-2" x-data="{ show: false }">
                                <span @click="show = !show" class="btn btn-sm btn-warning"><i class="bi bi-question-circle"></i> Panduan</span>
                                <div x-show="show" x-transition class="mt-1" @click.outside="show = false">
                                    * Akun Pemohon yang telah mengajukan permohonan tidak dapat dihapus<br>
                                    * Akun Pengelola hanya ditambahkan oleh Super Admin<br>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-lg-row">
                                <div class="me-2 mb-2">
                                    <select wire:model.live="pagelength" class="form-select" aria-label="Default select example" id="pagelength">
                                        <option value="5">5</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="{{ $count_pemohon }}">{{ $count_pemohon }}</option>
                                    </select>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama | Username | Nama Perusahaan | Kontak</th>
                                        <th style="width: 40px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Modal -->

                                    @foreach ($users as $item)
                                        <tr class="align-middle" x-data="{ open: false }" wire:key="{{ $item->id }}">
                                            @if ($item->role == 'newuser')
                                                <td>{{ ($users->currentpage() - 1) * $users->perpage() + $loop->index + 1 }}</td>
                                                <td class="bg-warning">{{ $item->name }} | {{ $item->company->name_company }} | {{ $item->email }}
                                                    <span class="badge text-bg-danger">Akun Belum Aktif</span> <br>
                                                    Cek Email Untuk Aktivasi Akun
                                                </td>
                                                <td class="d-flex">
                                                    <a wire:navigate href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-warning me-2">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button @click="open = true" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                    <div x-show="open" @click.outside="open = false" class="overlay"></div>
                                                    <div x-show="open" @click.away="open = false" x-transition:enter-start="modal-hapus-in" x-transition:leave-end="modal-hapus-out"
                                                        class="modal-hapus">
                                                        @if ($item->appreqs_count > 0)
                                                            <div class="alert alert-danger text-center">Akun ini tidak bisa dihapus, akun ini telah tertaut dengan data permohonan layanan
                                                                <p class="fw-bold">Cek Permohonan Layanan dengan Pemohon: {{ $item->name }}</p>
                                                                <button class="btn btn-sm btn-warning">Tutup</button>
                                                            </div>
                                                        @else
                                                            <div class="alert alert-danger text-center">Yakin ingin menghapus akun ini?
                                                                <p class="fw-bold">{{ $item->username . ' - ' . $item->company->name_company }}</p>
                                                                <button wire:click.prevent="getUserDelete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus!!</button>
                                                                <button class="btn btn-sm btn-warning">Batal</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                            @else
                                                <td>{{ ($users->currentpage() - 1) * $users->perpage() + $loop->index + 1 }}</td>
                                                <td>
                                                    {{ $item->name }} <span class="badge text-bg-success">{{ $item->appreqs_count }}</span>
                                                    <span class="badge text-bg-warning">Username: {{ $item->username }}</span>
                                                    {{ $item->company->name_company }}
                                                    <a href="#" class="btn btn-sm btn-success"><i class="bi bi-whatsapp"></i> {{ $item->nohp }}</a>
                                                    <div class="mt-1">
                                                        <div class="badge text-bg-success">Dibuat {{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') }} Wib</div>
                                                        <div class="badge text-bg-success">Diperbaharui {{ Carbon\Carbon::parse($item->updated_at)->translatedFormat('d F Y H:i') }} Wib</div>
                                                    </div>
                                                </td>
                                                <td class="d-flex">
                                                    <a wire:navigate href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-warning me-2">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button @click="open = true" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                    <div x-show="open" @click.outside="open = false" class="overlay"></div>
                                                    <div x-show="open" @click.away="open = false" x-transition:enter-start="modal-hapus-in" x-transition:leave-end="modal-hapus-out"
                                                        class="modal-hapus">
                                                        @if ($item->appreqs_count > 0)
                                                            <div class="alert alert-danger text-center">Akun ini tidak bisa dihapus, akun ini telah tertaut dengan data permohonan layanan
                                                                <p class="fw-bold">Cek Permohonan Layanan dengan Pemohon: {{ $item->name }}</p>
                                                                <button class="btn btn-sm btn-warning">Tutup</button>
                                                            </div>
                                                        @else
                                                            <div class="alert alert-danger text-center">Yakin ingin menghapus akun ini?
                                                                <p class="fw-bold">{{ $item->username . ' - ' . $item->company->name_company }}</p>
                                                                <button wire:click.prevent="getUserDelete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus!!</button>
                                                                <button class="btn btn-sm btn-warning">Batal</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $users->onEachSide(1)->links() }}
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            @session('successadmin')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('successadmin') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endsession
                            <h3 class="card-title">Daftar Akun Pengelola</h3>
                            <div class="card-tools">
                                <div class="input-group" x-data="{ search: _admin '' }">
                                    <input wire:model.live.debounce="search_admin" x-model="search_admin" type="text" name="search_admin" class="form-control form-control-sm float-right"
                                        placeholder="Cari">
                                    <div class="input-group-append">
                                        <button wire:click="resetSearchAdmin" type="submit" class="btn btn-warning">
                                            <i class="bi bi-x-square-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body table-responsive" x-data="{ addadmin: false }">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex float-end">
                                        @if (Auth::user()->role == 'superadmin')
                                            <button @click="addadmin = true" type="button" class="btn btn-success me-2 mb-2"><i class="bi bi-plus"></i> Tambah</button>
                                        @endif
                                        <button @click="$dispatch('notify', { message: 'Refresh Daftar Akun Berhasil' })" class="btn btn-warning me-2 mb-2" type="button"
                                            x-on:click="$wire.$refresh()" wire:loading.attr="disabled">
                                            <i class="bi bi-arrow-repeat"></i> Refresh
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->role == 'superadmin')
                                <div class="row">
                                    <div class="col-12">
                                        <form x-show="addadmin" x-transition @click.outside="addadmin = false" wire:submit.prevent="userCreate()">
                                            <div class="row mt-2">
                                                <h5>Tambah Akun Pengelola</h5>
                                                <div class="col-6 col-md-4 mb-2">
                                                    <label for="name">Nama Lengkap</label>
                                                    <input wire:model.blur="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-md-4 mb-2">
                                                    <label for="username">Username - </label>
                                                    <small>Digunakan untuk login</small>
                                                    <input wire:model.blur="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                                                        autocomplete="off">
                                                    @error('username')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-md-4 mb-2">
                                                    <label for="nohp">No HP</label>
                                                    <input wire:model.blur="nohp" type="text" inputmode="numeric" class="form-control @error('nohp') is-invalid @enderror" id="nohp"
                                                        autocomplete="off">
                                                    @error('nohp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-md-4 mb-2">
                                                    <label for="email">Email</label>
                                                    <input wire:model.blur="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" autocomplete="off">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-md-4 mb-2">
                                                    <label for="role">Role</label>
                                                    <select wire:model="role" class="form-select" aria-label="Default select example">
                                                        <option value="">== Pilih Role ==</option>
                                                        <option value="admin">Evaluator</option>
                                                        <option value="disposisi">Operator</option>
                                                    </select>
                                                    @error('role')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-md-4 mb-2">
                                                    <label for="password">Password - </label>
                                                    <input wire:model.blur="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                                        autocomplete="off">
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-md-4 mb-2">
                                                    <button @click="addadmin = false" class="btn btn-success mt-4" type="submit">Simpan</button>
                                                    <button @click="addadmin = false" type="button" class="btn btn-warning mt-4">Tutup</button>
                                                </div>
                                            </div>
                                            <hr>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama | Username |</th>
                                        <th style="width: 40px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody x-data="{ adminedit: false }">
                                    <!-- Modal -->

                                    @foreach ($admins as $item)
                                        <tr class="align-middle" x-data="{ open: false }">
                                            <td>{{ ($admins->currentpage() - 1) * $admins->perpage() + $loop->index + 1 }}</td>
                                            <td>
                                                {{ $item->name }}
                                                <br> <span class="badge text-bg-warning">Username: {{ $item->username }}</span>
                                                <a href="#" class="btn btn-sm btn-success"><i class="bi bi-whatsapp"></i> {{ $item->nohp }}</a>
                                                <div class="mt-1">
                                                    <div class="badge text-bg-success">Dibuat {{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') }} Wib</div>
                                                    <div class="badge text-bg-success">Diperbaharui {{ Carbon\Carbon::parse($item->updated_at)->translatedFormat('d F Y H:i') }} Wib</div>
                                                </div>
                                            </td>
                                            <td class="d-flex">
                                                <a wire:navigate href="{{ route('admin.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                @if (Auth::user()->role == 'superadmin')
                                                    <button @click="open = true" class="btn btn-sm btn-danger" {{ $item->id == Auth::id() ? 'disabled' : '' }}>
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                    <div x-show="open" @click.outside="open = false" class="overlay"></div>
                                                    <div x-show="open" @click.away="open = false" x-transition:enter-start="modal-hapus-in" x-transition:leave-end="modal-hapus-out"
                                                        class="modal-hapus">
                                                        <div class="alert alert-danger text-center">Yakin ingin menghapus akun ini?
                                                            <p class="fw-bold">{{ $item->username . ' - ' . $item->role }}</p>
                                                            <button wire:click.prevent="getUserDelete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus!!</button>
                                                            <button @click="open = false" class="btn btn-sm btn-warning">Batal</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $admins->onEachSide(1)->links() }}
                        </div>
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
    </script>
@endscript
