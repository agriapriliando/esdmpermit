<main class="app-main">
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
                            Daftar Perusahaan
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
                            <h3 class="card-title">Daftar Perusahaan</h3>
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
                                <button @click="$dispatch('notify', { message: 'Refresh Daftar Perusahaan Berhasil' })" class="btn btn-warning me-2 mb-2" type="button" x-on:click="$wire.$refresh()"
                                    wire:loading.attr="disabled">
                                    <i class="bi bi-arrow-repeat"></i> Refresh
                                </button>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama Perusahaan</th>
                                        <th>NPWP</th>
                                        <th>Tipe Perusahaan</th>
                                        <th>Kota</th>
                                        <th>Kecamatan</th>
                                        <th style="width: 40px">Label</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $item)
                                        <tr class="align-middle">
                                            <td>{{ ($companies->currentpage() - 1) * $companies->perpage() + $loop->index + 1 }}</td>
                                            <td>{{ $item->name_company }}</td>
                                            <td>{{ $item->npwp_company }}</td>
                                            <td>{{ $item->type_company }}</td>
                                            <td>{{ $item->city_company }}</td>
                                            <td>{{ $item->kecamatan_company }}</td>
                                            <td class="d-flex" x-data="{ open: false }">
                                                <a wire:click="edit({{ $item->id }})" href="#edit" class="btn btn-sm btn-warning me-2">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button @click="open = true" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <div x-show="open" @click.outside="open = false" class="overlay"></div>
                                                <div x-show="open" @click.outside="open = false" x-transition:enter-start="modal-hapus-in" x-transition:leave-end="modal-hapus-out"
                                                    class="modal-hapus">
                                                    <div class="alert alert-danger text-center">Yakin ingin menghapus perusahaan ini?
                                                        <p class="fw-bold">{{ $item->type_company . ' ' . $item->name_company }}</p>
                                                        <button wire:click.prevent="getCompanyDelete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus!!</button>
                                                        <button @click="open = false" class="btn btn-sm btn-warning">Batal</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $companies->links() }}
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
                        <div class="card-body">
                            <form wire:submit.prevent="save({{ $id }})">
                                <div class="mb-2 d-none">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-2">
                                    <label for="name_company">Nama Perusahaan</label>
                                    <input wire:model.live="name_company" type="text" class="form-control @error('name_company') is-invalid @enderror" id="name_company" autocomplete="off">
                                    @error('name_company')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="user_id">Pemilik Perusahaan</label>
                                    <select wire:model.live="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="">Pilih Pemilik</option>
                                        @if ($users && $users->count() > 0)
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>Tidak ada pengguna yang tersedia</option>
                                        @endif
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="type_company">Tipe Perusahaan</label>
                                    <input wire:model.blur="type_company" type="text" class="form-control @error('type_company') is-invalid @enderror" id="type_company" autocomplete="off">
                                    @error('type_company')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="npwp_company">NPWP</label>
                                    <input wire:model.blur="npwp_company" type="text" class="form-control @error('npwp_company') is-invalid @enderror" id="npwp_company">
                                    @error('npwp_company')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Dropdown Kota -->
                                <div class="mb-2">
                                    <label for="city_company">Kota</label>
                                    <select wire:model.live="city_company" id="city_company" class="form-control @error('city_company') is-invalid @enderror">
                                        <option value="">Pilih Kota</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_company')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="kecamatan_company">Kecamatan</label>
                                    <select wire:model.live="kecamatan_company" id="kecamatan_company" class="form-control @error('kecamatan_company') is-invalid @enderror">
                                        <option value="">Pilih Kecamatan</option>
                                        @if (!empty($districts))
                                            @foreach ($districts as $district)
                                                <option value="{{ $district['id'] }}" {{ $district['id'] == $kecamatan_company ? 'selected' : '' }}>{{ $district['name'] }}</option>
                                            @endforeach
                                            {{-- @else
                                        <option value="">Pilih kota terlebih dahulu</option> --}}
                                        @endif
                                    </select>
                                    @error('kecamatan_company')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="address_company">Alamat</label>
                                    <input wire:model.blur="address_company" type="text" class="form-control @error('address_company') is-invalid @enderror" id="address_company">
                                    @error('address_company')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
        // Toast notifications can be added here
        $wire.on('company-deleted', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 2000);
        });

        $wire.on('company-created', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 2000);
        });

        $wire.on('company-updated', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 2000);
        });

        $wire.on('company-add-error', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                element.className += " text-bg-danger";
                document.getElementById('pesan').innerHTML = event.message;
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 50000);
        });
    </script>
@endscript
