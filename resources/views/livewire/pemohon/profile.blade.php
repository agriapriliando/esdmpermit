<main class="app-main">
    <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content mt-3"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="toast-container position-fixed top-0 start-50 translate-middle-x">
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
                            <h3 class="card-title">PROFIL SAYA</h3>
                            <div class="card-tools">
                                <a wire:navigate href="{{ route('appreq.list', 'list') }}" class="btn btn-sm btn-warning"><i class="bi bi-arrow-left"></i> Kembali</a>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body" x-data="{ pass: false }">
                            <form wire:submit.prevent="update()">
                                <div class="row">
                                    <div class="col-12 col-md-6">
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
                                            <input wire:model.blur="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" autocomplete="off">
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
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" inputmode="email" autocomplete="off"
                                                value="{{ $email }}" disabled>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <div class="mb-3 form-check">
                                                <input wire:model="passCheck" type="checkbox" class="form-check-input" id="exampleCheck1" x-model="pass">
                                                <label class="form-check-label" for="exampleCheck1">Pilih jika ingin mengganti password</label>
                                            </div>
                                            <div x-show="pass" x-data="{ passshow: true }">
                                                <div class="mb-2">
                                                    <label for="password">Password Baru</label>
                                                    <div class="input-group mb-3">
                                                        <input wire:model.blur="password" :type="passshow ? 'password' : 'text'" class="form-control @error('password') is-invalid @enderror"
                                                            id="password">
                                                        <span class="input-group-text" id="basic-addon1" @click="passshow = !passshow"><i class="bi bi-eye"></i></span>
                                                    </div>
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-2">
                                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                                    <div class="input-group mb-3">
                                                        <input wire:model.blur="password_confirmation" :type="passshow ? 'password' : 'text'"
                                                            class="form-control @error('password') is-invalid @enderror" id="password_confirmation">
                                                        <span class="input-group-text" id="basic-addon1" @click="passshow = !passshow"><i class="bi bi-eye"></i></span>
                                                    </div>
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-2">
                                            <label for="name_company">Nama Perusahaan</label>
                                            <input wire:model.blur="name_company" type="text" class="form-control @error('name_company') is-invalid @enderror" id="name_company" disabled>
                                        </div>
                                        <div class="mb-2">
                                            <label for="commodity_id">Aktivitas Perusahaan</label>
                                            <select wire:model.blur="commodity_id" class="form-select @error('commodity_id') is-invalid @enderror" id="commodity_id" disabled>
                                                <option value="">{{ $commodity_id->name_commodity . ' - ' . $commodity_id->group }}</option>
                                            </select>
                                            @error('commodity_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="province_company">Pilih Provinsi</label>
                                            <select class="form-select @error('province_company') is-invalid @enderror" id="province_company" disabled>
                                                <option value="KALIMANTAN TENGAH" selected>KALIMANTAN TENGAH</option>
                                            </select>
                                            @error('province_company')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="kab_kota_company">Pilih Kota/Kabupaten</label>
                                            <select wire:model.live="kab_kota_company" class="form-select @error('kab_kota_company') is-invalid @enderror" id="kab_kota_company" disabled>
                                                <option value="">{{ $kab_kota_company }}</option>
                                            </select>
                                            @error('kab_kota_company')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="address_sk_company">Alamat Perusahaan (Sesuai SK)</label>
                                            <textarea wire:model.live="address_sk_company" id="address_sk_company" cols="30" rows="4" class="form-control @error('address_sk_company') is-invalid @enderror">
                                                {{ $address_sk_company }}
                                            </textarea>
                                            <small class="text-muted">Cantumkan Nomor SK</small>
                                            @error('address_sk_company')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="notes_company">Catatan</label>
                                            <textarea wire:model.live="notes_company" id="notes_company" cols="30" rows="2" class="form-control @error('notes_company') is-invalid @enderror">
                                                {{ $notes_company }}
                                            </textarea>
                                            <small class="text-muted">Silahkan tambahkan Catatan untuk melengkapi Informasi Perusahaan</small>
                                            @error('notes_company')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 d-grid">
                                    <button class="btn btn-success" type="submit">Simpan Profil</button>
                                </div>
                                <a wire:navigate href="{{ route('appreq.list', 'list') }}" class="btn btn-sm btn-warning"><i class="bi bi-arrow-left"></i> Kembali</a>
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
            }, 4000);
        });
        $wire.on('fail-updated', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-danger";
                // console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 4000);
        });
    </script>
@endscript
