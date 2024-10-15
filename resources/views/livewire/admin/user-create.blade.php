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
                <div class="col-12" id="edit">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="card-tools">
                                <button wire:click="resetForm" class="btn btn-sm btn-warning"><i class="bi bi-arrow-counterclockwise"></i> Reset Form</button>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body" x-data="{ pass: false, password: '', company: true }">
                            <form wire:submit.prevent="save({{ $id }})">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="mb-2">
                                            <label for="company">Centang jika Akun Pemohon/ Perusahaan</label>
                                            <div class="mb-3 form-check">
                                                <input wire:model.live="companycheckbox" type="checkbox" class="form-check-input" id="company" x-model="company"
                                                    {{ $title != 'Tambah Akun' ? 'disabled' : '' }}>
                                                <label class="form-check-label" for="company">Akun Pemohon / Perusahaan</label>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="name">Nama Lengkap</label>
                                            <input wire:model.blur="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="username">Username</label>
                                            <input wire:model.blur="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" x-model="password"
                                                autocomplete="off">
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <small class="text-muted">Digunakan untuk login | tanpa menggunakan spasi</small>
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
                                            <input wire:model.blur="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" inputmode="email" autocomplete="off">
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
                                    </div>
                                    @if ($companycheckbox == true)
                                        <div class="col-12 col-md-6" x-show="company">
                                            <div class="mb-2">
                                                <label for="name_company">Nama Perusahaan</label>
                                                <div class="input-group mb-3">
                                                    <select wire:model="type_company" class="form-select @error('type_company') is-invalid @enderror" aria-label="Default select example"
                                                        style="max-width: 80px">
                                                        <option value="">Pilih</option>
                                                        <option value="PT">PT</option>
                                                        <option value="CV">CV</option>
                                                    </select>
                                                    <input wire:model.blur="name_company" type="text" class="form-control @error('name_company') is-invalid @enderror" id="name_company">
                                                </div>
                                                @error('name_company')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label for="npwp_company">NPWP Perusahaan </label>
                                                <input wire:model.blur="npwp_company" type="text" class="form-control @error('npwp_company') is-invalid @enderror" id="npwp_company">
                                                @error('npwp_company')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label for="act_company">Aktivitas Perusahaan</label>
                                                <select wire:model.blur="act_company" class="form-select @error('act_company') is-invalid @enderror" id="act_company">
                                                    <option value="">Pilih</option>
                                                    <option value="Pasir">Pasir</option>
                                                    <option value="Pasir Kuarsa">Pasir Kuarsa</option>
                                                </select>
                                                @error('act_company')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label for="npwp_company">Provinsi</label>
                                                <input type="text" value="Kalimantan Tengah" class="form-control" disabled>
                                            </div>
                                            <div class="mb-2">
                                                <label for="city_company">Pilih Kota/Kabupaten</label>
                                                <select wire:model.live="city_company" class="form-select @error('city_company') is-invalid @enderror" id="city_company">
                                                    @if ($title == 'Tambah Akun')
                                                        <option value="">Pilih Kab/Kota</option>
                                                    @endif
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id_region }}" {{ $city_company == $city->name_region ? 'selected' : '' }}>{{ $city->name_region }}</option>
                                                    @endforeach
                                                </select>
                                                @error('city_company')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            @if ($city_company)
                                                <div class="mb-2">
                                                    <label for="kecamatan_company">Pilih Kecamatan</label>
                                                    <select wire:model.live="kecamatan_company" class="form-select @error('kecamatan_company') is-invalid @enderror" id="kecamatan_company">
                                                        @if ($title == 'Tambah Akun')
                                                            <option value="">Pilih Kecamatan</option>
                                                        @endif
                                                        @foreach ($kecamatan as $kec)
                                                            <option value="{{ $kec->id_region }}" {{ $kecamatan_company == $kec->name_region ? 'selected' : '' }}>{{ $kec->name_region }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kecamatan_company')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            @endif
                                            <div class="mb-2">
                                                <label for="address_company">Alamat Perusahaan</label>
                                                <textarea wire:model.live="address_company" id="address_company" cols="30" rows="4" class="form-control @error('address_company') is-invalid @enderror"></textarea>
                                                @error('address_company')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
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
