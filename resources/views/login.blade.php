<x-layouts.applogin>
    <!-- Login 5 - Bootstrap Brain Component -->

    <section class="p-md-1 p-xl-5">
        <div class="container mb-5 mt-2">
            @session('success')
                <div class="zindex alert alert-primary alert-dismissible fade show position-fixed top-50 start-50 translate-middle" x-transition role="alert">
                    <strong>{{ session('success') }}</strong><br>
                    Silahkan Buka Email <span class="fw-bold">{{ session('success') }}</span> untuk mengaktifkan Akun Anda
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endsession
            @session('successdaftar')
                <div class="zindex alert alert-primary alert-dismissible fade show position-fixed top-50 start-50 translate-middle" x-transition role="alert">
                    <strong>{{ session('successdaftar') }}</strong><br>
                    <strong>Silahkan Buka Email untuk mengaktifkan Akun Anda</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endsession
            @session('aktivasi')
                <div class="zindex alert alert-primary alert-dismissible fade show position-fixed top-50 start-50 translate-middle" x-transition role="alert">
                    <strong>{{ session('aktivasi') }}</strong><br>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endsession
            @session('error')
                <div id="zindex alert-error" style="x-index: 999999 !important;" class="alert alert-danger alert-dismissible fade show position-fixed top-50 start-50 translate-middle" x-transition
                    role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endsession
            <div class="card border-light-subtle shadow-sm">
                <div class="row g-0" x-data="{ panduan: false, formlogin: true, }" x-cloak>
                    <div x-cloak x-show="panduan" class="overlay"></div>
                    <div x-cloak x-show="panduan" class="position-fixed bg-white text-white p-3 rounded shadow-lg top-50 start-50 translate-middle zindex ">
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
                                <script nonce="{{ session()->get('csp_nonce') }}">
                                    let textformat = "Permohonan Pemulihan Password atau Username" +
                                        "\r\n" + "Nama Perusahaan :" +
                                        "\r\n" + "Email :" +
                                        "\r\n" + "Kontak Whatsapp Aktif :" +
                                        "\r\n" + "Diisi oleh Admin ESDM" +
                                        "\r\n" + "Username : ..." +
                                        "\r\n" + "Password : ...";
                                </script>
                                <i x-init="copiedformat = textformat.trim()" class="bi bi-copy filehover" @click="navigator.clipboard.writeText(copiedformat).then(() => copiedd = true)"> Salin Format</i>
                                <span x-show="copiedd" x-transition @click.outside="copiedd = false">Disalin</span>
                            </p>
                            <button @click="panduan = false" class="btn btn-sm btn-warning">Tutup</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 text-bg-primary pb-4 rounded">
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
                                        <h3>Login</h3>
                                    </div>
                                    @session('success')
                                        <div class="alert alert-success" role="alert">
                                            <span>{{ session('success') }}</span>
                                        </div>
                                    @endsession
                                    @session('successdaftar')
                                        <div class="alert alert-success" role="alert">
                                            <span>{{ session('successdaftar') }}</span>
                                        </div>
                                    @endsession
                                    @session('aktivasi')
                                        <div class="alert alert-success" role="alert">
                                            <span>{{ session('aktivasi') }}</span>
                                        </div>
                                    @endsession
                                    @session('error')
                                        <div class="alert alert-danger" role="alert">
                                            <span>{{ session('error') }}</span>
                                        </div>
                                    @endsession
                                </div>
                            </div>
                            <div x-data="{ isSubmitting: false }">
                                <form x-on:submit="isSubmitting = true" method="POST" action="{{ url('login') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="row gy-3 gy-md-4 overflow-hidden">
                                        <div class="col-12">
                                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                            <input autocomplete="off" type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username"
                                                value="{{ old('username') }}" required>
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12" x-data="{ show: true }">
                                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input :type="show ? 'password' : 'text'" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" name="password"
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
                                                <button x-bind:disabled="isSubmitting" class="btn bsb-btn-xl btn-primary" type="submit"><i class="bi bi-box-arrow-in-right"></i> L o g i n</button>
                                                <button type="button" x-show="isSubmitting" disabled class="btn bsb-btn-xl btn-secondary">
                                                    ⏳ Sedang login...
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr class="my-4 border-secondary-subtle">
                                    <div class="d-flex gap-2 gap-md-2 flex-column flex-md-row justify-content-md-end">
                                        <a href="https://drive.google.com/drive/folders/11zsrgFtlBtxcELpzHRMSTsaMCluQvdDt?usp=drive_link" target="_blank" class="btn btn-primary btn-sm"><i
                                                class="bi bi-info-circle"></i> Panduan</a>
                                        <a wire:navigate href="{{ url('daftar') }}" class="btn btn-primary btn-sm"><i class="bi bi-person-plus"></i> Pendaftaran</a>
                                        <button @click="panduan = !panduan" class="btn btn-primary btn-sm" type="button"><i class="bi bi-question-circle"></i> Lupa Password?</button>
                                        <a href="#!" class="btn btn-primary btn-sm d-none"><i class="bi bi-headset"></i> Hubungi Kami</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <img class="img-fluid bg-white rounded" src="{{ asset('') }}assets/alur_miners_2025.jpg" alt="">
                </div>
            </div>
            <div class="row p-3">
                <div class="col-12 bg-white p-3 rounded">
                    <table class="table table-striped" x-data="{ layanan: false }">
                        <thead>
                            <tr>
                                <th scope="col">
                                    DAFTAR LAYANAN
                                    <button class="btn btn-sm btn-primary ms-2" @click="layanan = !layanan">Lihat Detail</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody x-show="layanan" x-transition @click.outside="layanan = false">
                            @foreach ($permitworks as $permitwork)
                                <tr>
                                    <td x-data="{ syarat: false }">
                                        {{ $permitwork->name_permit }} <button class="btn btn-sm btn-primary" @click="syarat = !syarat"><i class="bi bi-info-circle"></i></button>
                                        <br>
                                        <div x-show="syarat" x-transition class="px-3">
                                            Persyaratan : <br>
                                            {!! $permitwork->desc_permit !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div id="chartpengajuan" class="mt-3 p-2 bg-white rounded">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div id="chartperizinan" class="mt-3 p-2 bg-white rounded">
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="mt-3 p-4 bg-white rounded shadow-lg">
                        <h3 class="text-center">Link Pintasan</h3>
                        @foreach ($linktautan as $l)
                            <a href="{{ $l['link'] }}" target="_blank" class="btn btn-primary m-2">{{ $l['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scriptlogin')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
        <!-- Alpine's CSP-friendly Core -->
        {{-- <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/csp@3.14.8/dist/cdn.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script nonce="{{ session()->get('csp_nonce') }}">
            // new Splide('.splide', {
            //     type: 'loop', // Agar bisa loop
            //     perPage: 2, // Menampilkan 3 slide per halaman
            //     focus: 'center', // Menjadikan slide aktif berada di tengah
            //     // gap: '1rem', // Jarak antar slide
            //     breakpoints: {
            //         1028: { // Jika layar ≤ 1028px
            //             perPage: 1, // Mobile: 1 slide per halaman
            //             height: "200px" // Mobile: tinggi 250px
            //         }
            //     }
            // }).mount();
            // dataslide = document.querySelectorAll('.splide__slide img');
            // console.log(dataslide[0]);
            // document.querySelectorAll(".splide__slide img").forEach((img) => {
            //     img.addEventListener("click", function() {
            //         let dataUrl = this.getAttribute("data-url");
            //         window.open(dataUrl, "_blank");
            //     });
            // });
            var chartpengajuan = {{ Js::from($chartpengajuan) }};
            Highcharts.chart('chartpengajuan', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Jumlah Pengajuan Tahun 2025'
                },
                subtitle: {
                    text: 'Sumber: ' +
                        '<a href="https://minerskalteng.com" ' +
                        'target="_blank">Minerskalteng.com</a>'
                },
                xAxis: {
                    categories: [
                        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                        'Oct', 'Nov', 'Dec'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Pengajuan'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: true
                    }
                },
                series: [{
                    name: 'Diajukan',
                    data: chartpengajuan['diajukan'],
                }, {
                    name: 'Disposisi',
                    data: chartpengajuan['disposisi'],
                }, {
                    name: 'Diproses',
                    data: chartpengajuan['diproses'],
                }, {
                    name: 'Perbaikan',
                    data: chartpengajuan['perbaikan'],
                }, {
                    name: 'Terbit',
                    data: chartpengajuan['terbit'],
                }, ],
            });
            Highcharts.chart('chartperizinan', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Jumlah Perizinan Pertambangan Kalimantan Tengah'
                },
                subtitle: {
                    text: 'Sumber: ' +
                        '<a href="https://minerskalteng.com" ' +
                        'target="_blank">Minerskalteng.com</a>'
                },
                xAxis: {
                    categories: ['IUP Mineral Bukan Logam', 'IUP Batuan', 'SIPB', 'IUJP', 'IPP'],
                    crosshair: true,
                    accessibility: {
                        description: 'Countries'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Perizinan'
                    }
                },
                tooltip: {
                    valueSuffix: ' Izin'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Jumlah',
                    data: [5, 10, 15, 20, 25]
                }]
            });
        </script>
    @endpush

</x-layouts.applogin>
