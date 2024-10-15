<main class="app-main">
    <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content mt-3"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-12" id="edit">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Edit Akun Pengguna</h3>
                            <div class="card-tools">
                                <a wire:navigate href="{{ route('users.list') }}" class="btn btn-sm btn-warning"><i class="bi bi-arrow-left"></i> Kembali</a>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body" x-data="{ pass: false }">
                            <form wire:submit.prevent="save()">
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
                                            <label for="username">username</label>
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
                                                <input wire:model="passCheck" type="checkbox" class="form-check-input" id="exampleCheck1" x-model="pass">
                                                <label class="form-check-label" for="exampleCheck1">Gunakan Password Berbeda</label>
                                            </div>
                                            <div x-show="pass">
                                                <label for="password">Password</label>
                                                <input wire:model.live="password" type="password" class="form-control" id="password">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-2">
                                            <label for="name_company">Nama Perusahaan</label>
                                            <input wire:model.blur="name_company" type="text" class="form-control @error('name_company') is-invalid @enderror" id="name_company">
                                            @error('name_company')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="commodity_id">Aktivitas Perusahaan</label>
                                            <select wire:model.blur="commodity_id" class="form-select @error('commodity_id') is-invalid @enderror" id="commodity_id">
                                                @foreach ($commoditys as $c)
                                                    <option value="{{ $c->id }}" {{ $c->id == $commodity_id ? 'selected' : '' }}>{{ $c->name_commodity . ' - ' . $c->group }}</option>
                                                @endforeach
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
                                            <select wire:model.live="kab_kota_company" class="form-select @error('kab_kota_company') is-invalid @enderror" id="kab_kota_company">
                                                @foreach ($kab_kota_list as $k)
                                                    <option value="{{ $k->id }}" {{ $kab_kota_company == $k->id ? 'selected' : '' }}>{{ $k->name_region }}</option>
                                                @endforeach
                                            </select>
                                            @error('kab_kota_company')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        @if ($kab_kota_company)
                                            <div class="mb-2">
                                                <label for="kecamatan_company">Pilih Kecamatan</label>
                                                <select wire:model.live="kecamatan_company" class="form-select @error('kecamatan_company') is-invalid @enderror" id="kecamatan_company">
                                                    @foreach ($kecamatan_list as $kec)
                                                        <option value="{{ $kec->id }}" {{ $kecamatan_company == $kec->id ? 'selected' : '' }}>{{ $kec->name_region }}</option>
                                                    @endforeach
                                                    <option value="">== KOSONGKAN ==</option>
                                                </select>
                                                @error('kecamatan_company')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        @endif
                                        <div class="mb-2">
                                            <label for="address_sk_company">Alamat Perusahaan (SK)</label>
                                            <textarea wire:model.live="address_sk_company" id="address_sk_company" cols="30" rows="4" class="form-control @error('address_sk_company') is-invalid @enderror"></textarea>
                                            @error('address_sk_company')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="notes_company">Catatan</label>
                                            <textarea wire:model.live="notes_company" id="notes_company" cols="30" rows="2" class="form-control @error('notes_company') is-invalid @enderror"></textarea>
                                            @error('notes_company')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 d-grid">
                                    <button class="btn btn-success" type="submit">Simpan Perubahan</button>
                                </div>
                                <a wire:navigate href="{{ route('users.list') }}" class="btn btn-sm btn-warning"><i class="bi bi-arrow-left"></i> Kembali</a>
                            </form>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main>
