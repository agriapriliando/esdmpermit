<!-- Login 5 - Bootstrap Brain Component -->

<section class="p-3 p-md-4 p-xl-5">
    <div class="container mb-5">
        @session('success')
            <div style="z-index: 3;" class="alert alert-primary alert-dismissible fade show position-fixed top-50 start-50 translate-middle" x-transition role="alert">
                <strong>{{ session('success') }}</strong><br>
                Silahkan Buka Email <span class="fw-bold">{{ session('success') }}</span> untuk mengaktifkan Akun Anda
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
        @session('successdaftar')
            <div style="z-index: 3;" class="alert alert-primary alert-dismissible fade show position-fixed top-50 start-50 translate-middle" x-transition role="alert">
                <strong>{{ session('successdaftar') }}</strong><br>
                <strong>Silahkan Buka Email untuk mengaktifkan Akun Anda</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
        @session('aktivasi')
            <div style="z-index: 3;" class="alert alert-primary alert-dismissible fade show position-fixed top-50 start-50 translate-middle" x-transition role="alert">
                <strong>{{ session('aktivasi') }}</strong><br>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
        @session('error')
            <div id="alert-error" style="z-index: 3;" class="alert alert-danger alert-dismissible fade show position-fixed top-50 start-50 translate-middle" x-transition role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
        <div class="card border-light-subtle shadow-sm">
            <div class="row g-0" x-data="{ panduan: false, formlogin: true, }">
                <div x-show="panduan" id="overlay"></div>
                <div x-show="panduan" class="position-fixed bg-white text-white p-3 rounded shadow-lg top-50 start-50 translate-middle" style="z-index: 3;">
                    <div class="text-center text-black" @click.outside="panduan = false" x-transition>
                        <p x-data="{ copiedformat: null, copiedd: false }">
                            <span class="fw-bold">Lupa Password atau Username?</span><br>
                            Silahkan mengirim Email ke
                            <span class="fw-bold" x-data="{ copied: false, text: 'desdm_kalteng@gmail.com' }">
                                desdm_kalteng@gmail.com
                                <i class="bi bi-copy filehover" @click="navigator.clipboard.writeText(text).then(() => copied = true)"></i>
                                <span x-show="copied" x-transition @click.outside="copied = false">Disalin</span>
                            </span>
                            <br>
                            <span>
                                <br>Dengan Format berikut :
                                <br>Subjek : Permohonan Pemulihan Password atau Username
                                <br>Nama Perusahaan : (CV atau PT .....)
                                <br>Email : (diisi email perusahaan)
                                <br>Kontak Whatsapp Aktif : (diisi kontak whatsapp aktif)
                            </span>
                            <script>
                                let textformat = "Permohonan Pemulihan Password atau Username" +
                                    "\r\n" + "Nama Perusahaan :" +
                                    "\r\n" + "Email :" +
                                    "\r\n" + "Kontak Whatsapp Aktif :" +
                                    "\r\n" + "Diisi oleh Admin ESDM" +
                                    "\r\n" + "Username : ..." +
                                    "\r\n" + "Password : ...";
                                console.log(textformat);
                            </script>
                            <i x-init="copiedformat = textformat.trim()" class="bi bi-copy filehover" @click="navigator.clipboard.writeText(copiedformat).then(() => copiedd = true)"> Salin Format</i>
                            <span x-show="copiedd" x-transition @click.outside="copiedd = false">Disalin</span>
                        </p>
                        <button @click="panduan = false" class="btn btn-sm btn-warning">Tutup</button>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-bg-primary pb-4">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div class="col-10 col-xl-8 py-3">
                            <img class="img-fluid rounded mb-2" loading="lazy" src="{{ asset('') }}assets/img/newlogo_miners_putih.png" width="260" alt="BootstrapBrain Logo">
                            <h2 class="h1 mb-4">Sistem Informasi Pelayanan Pertambangan</h2>
                            <p class="lead m-0 d-none d-md-block">Adalah Platform digital yang berfungsi untuk mempermudah proses penerbitan surat
                                teknis di sektor pertambangan agar operasional pertambangan berjalan lancar sesuai dengan regulasi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-body p-5 p-md-4 p-xl-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="float-end">
                                    <div class="typewriter">
                                        <div class="slide"><i></i></div>
                                        <div class="paper"></div>
                                        <div class="keyboard"></div>
                                    </div>
                                    <!-- dribbble -->
                                    <a class="dribbble" href="https://dribbble.com/shots/8184246-Typewriter" target="_blank"><img
                                            src="https://cdn.dribbble.com/assets/dribbble-ball-mark-2bd45f09c2fb58dbbfb44766d5d1d07c5a12972d602ef8b32204d28fa3dda554.svg" alt=""></a>
                                </div>
                                <div class="mb-5">
                                    <h3 x-text="formlogin ? 'Log In ': 'Daftar'"></h3>
                                </div>
                            </div>
                        </div>
                        <form x-show="formlogin" wire:submit="login">
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="col-12">
                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                    <input autocomplete="off" wire:model="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" id="username"
                                        placeholder="Username" required>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12" x-data="{ show: true }">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input :type="show ? 'password' : 'text'" wire:model.live="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="password">
                                        <span class="input-group-text" @click="show = !show">
                                            <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary" type="submit"><i class="bi bi-box-arrow-in-right"></i> L o g i n</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form x-show="!formlogin" action="{{ route('daftar') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="col-12">
                                    <label for="name" class="form-label">Nama Lengkap (PIC) <span class="text-danger">*</span></label>
                                    <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Lengkap" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="nohp" class="form-label">No HP PIC <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">62</span>
                                        <input type="nohp" inputmode="numeric" class="form-control @error('nohp') is-invalid @enderror" name="nohp" id="nohp" placeholder="No HP"
                                            required>
                                    </div>
                                    @error('nohp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" required>
                                    <small>Masukan Email yang digunakan di <span class="fw">oss.go.id</span></small>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="name_company" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                    <div class="d-flex">
                                        <select name="type_company" class="form-select" style="width: 85px !important" required>
                                            <option value="">Pilih</option>
                                            <option value="CV">CV</option>
                                            <option value="PT">PT</option>
                                        </select>
                                        <input type="name_company" class="form-control @error('name_company') is-invalid @enderror" name="name_company" id="name_company"
                                            placeholder="Nama Perusahaan" required>
                                    </div>
                                    @error('name_company')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="commodity_id" class="form-label">Pilih Komoditas <span class="text-danger">*</span></label>
                                    <select name="commodity_id" class="form-select" required>
                                        <option value="">Pilihan</option>
                                        @foreach ($commodities as $item)
                                            <option value="{{ $item->id }}">{{ $item->name_commodity . ' - ' . $item->group }}</option>
                                        @endforeach
                                    </select>
                                    @error('commodity_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="region_id" class="form-label">Lokasi Pertambangan <span class="text-danger">*</span></label>
                                    <select name="region_id" class="form-select" required>
                                        <option value="">Pilihan</option>
                                        @foreach ($all_kab as $kab)
                                            <option value="{{ $kab->id }}">{{ $kab->name_region }}</option>
                                        @endforeach
                                    </select>
                                    @error('region_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <hr class="mb-2">
                                <div class="col-12">
                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                    <input autocomplete="off" wire:model="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" id="username"
                                        placeholder="Username" required>
                                    <small>Digunakan untuk login</small>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12" x-data="{ show: true }">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input :type="show ? 'password' : 'text'" wire:model.live="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="password" placeholder="Password">
                                        <span class="input-group-text" @click="show = !show">
                                            <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary" type="submit"><i class="bi bi-box-arrow-in-right"></i> D A F T A R</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <hr class="my-4 border-secondary-subtle">
                                <div class="d-flex gap-2 gap-md-2 flex-column flex-md-row justify-content-md-end">
                                    <a href="https://drive.google.com/drive/folders/11zsrgFtlBtxcELpzHRMSTsaMCluQvdDt?usp=drive_link" target="_blank" class="btn btn-primary btn-sm"><i
                                            class="bi bi-info-circle"></i> Panduan</a>
                                    <button @click="formlogin = !formlogin" class="btn btn-primary btn-sm" type="button"><i class="bi bi-person-plus"></i> <span
                                            x-text="formlogin ? 'Pendaftaran' : 'Login'"></span></button>
                                    <button @click="panduan = !panduan" class="btn btn-primary btn-sm" type="button"><i class="bi bi-question-circle"></i> Lupa Password?</button>
                                    <a href="#!" class="btn btn-primary btn-sm d-none"><i class="bi bi-headset"></i> Hubungi Kami</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
