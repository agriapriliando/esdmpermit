<div>
    <!-- Top Row Widgets-->
    <div class="row">
        {{-- toast --}}
        <div class="toast-container position-fixed top-0 start-50 translate-middle-x">
            <div id="liveToast" class="toast mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto" id="pesan"></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        {{-- toast --}}
        <!-- Tabel Perusahaan-->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Example-->
                    <div class="card mb-4">
                        <div class="card-header justify-content-between align-items-center d-flex">
                            <h6 class="card-title m-0">RKABOP Peralatan | {{ session('nama_pemegang_perizinan') }}</h6>
                            <div class="d-flex gap-2">
                                <a href="{{ route('profile.show', session('id_perusahaan')) }}" class="btn btn-primary btn-sm">Profil</a>
                                <a href="{{ route('rkabop.show') }}" class="btn btn-primary btn-sm">Kembali</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="mb-2">
                                <span class="badge text-bg-success">Nomor Persetujuan : {{ $rkabop_utama->rkab_no_persetujuan ?? '-' }}</span>
                                <span class="badge text-bg-success">Tgl : {{ optional($rkabop_utama->rkab_tgl_persetujuan)->format('d-m-Y') }}</span>
                                <span class="badge text-bg-success">Keterangan : {{ $rkabop_utama->rkab_keterangan ?? '-' }}</span>
                            </div>

                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th class="text-nowrap">Tahun</th>
                                        <th class="text-nowrap">Jenis</th>
                                        <th class="text-nowrap">Merk</th>
                                        <th class="text-nowrap">Jumlah</th>
                                        <th class="text-nowrap">No Plat</th>
                                        <th class="text-nowrap">Status Milik Sendiri</th>
                                        <th class="text-nowrap">Status Sewa</th>
                                        <th class="text-nowrap">BBM Asal Kalteng</th>
                                        <th class="text-nowrap">BBM Non Kalteng</th>
                                        <th class="text-nowrap">Rencana Pakai BBM</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rkabop as $id => $item)
                                        <tr wire:key="rkabop-row-{{ $id }}" x-data="{ confirmDelete: false }">
                                            <td>{{ $loop->iteration }}</td>

                                            {{-- Tahun --}}
                                            <td style="min-width: 100px">
                                                <input type="text" class="form-control form-control-sm @error('rkabop.' . $id . '.rkab_peralatan_pilih_tahun') is-invalid @enderror"
                                                    wire:model="rkabop.{{ $id }}.rkab_peralatan_pilih_tahun" :disabled="$wire.editingId !== {{ $id }}">
                                                @error('rkabop.' . $id . '.rkab_peralatan_pilih_tahun')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>

                                            {{-- Kolom lainnya --}}
                                            @foreach (['rkab_peralatan_jenis' => 'text', 'rkab_peralatan_merk' => 'text', 'rkab_peralatan_jumlah' => 'number', 'rkab_peralatan_no_plat' => 'text', 'rkab_peralatan_status_milik_sendiri' => 'text', 'rkab_peralatan_status_sewa' => 'text', 'rkab_peralatan_bbm_asal_kalteng' => 'text', 'rkab_peralatan_bbm_non_kalteng' => 'text', 'rkab_peralatan_rencana_pakai_bbm' => 'text'] as $field => $type)
                                                <td>
                                                    <input type="{{ $type }}" class="form-control form-control-sm @error('rkabop.' . $id . '.' . $field) is-invalid @enderror"
                                                        wire:model="rkabop.{{ $id }}.{{ $field }}" :disabled="$wire.editingId !== {{ $id }}">
                                                    @error('rkabop.' . $id . '.' . $field)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            @endforeach

                                            {{-- Tombol Aksi --}}
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    {{-- Simpan --}}
                                                    <button type="button" class="btn btn-primary btn-sm" wire:click="update({{ $id }})" x-show="$wire.editingId === {{ $id }}">
                                                        Simpan
                                                    </button>

                                                    {{-- Edit --}}
                                                    <button type="button" class="btn btn-secondary btn-sm" @click="$wire.editingId = {{ $id }}"
                                                        x-show="$wire.editingId !== {{ $id }}">
                                                        <i class="ri-edit-line"></i>
                                                    </button>

                                                    {{-- Batal --}}
                                                    <button type="button" class="btn btn-secondary btn-sm" wire:click="batal({{ $id }})" x-show="$wire.editingId === {{ $id }}">
                                                        <i class="ri-close-line"></i>
                                                    </button>

                                                    {{-- Hapus --}}
                                                    <button type="button" class="btn btn-danger btn-sm text-white" @click.stop="confirmDelete = true"
                                                        x-show="$wire.editingId !== {{ $id }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </div>

                                                {{-- Konfirmasi hapus --}}
                                                <div x-cloak x-show="confirmDelete" x-transition class="mt-2">
                                                    <span class="small d-block mb-1">Yakin hapus?</span>
                                                    <div class="d-flex gap-1">
                                                        <button type="button" class="btn btn-danger btn-sm" @click="confirmDelete = false" wire:click="delete({{ $id }})">
                                                            Ya
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-sm" @click="confirmDelete = false">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- Form tambah data baru --}}
                                    <tr>
                                        <td>+</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm @error('rkab_peralatan_pilih_tahun') is-invalid @enderror" wire:model="rkab_peralatan_pilih_tahun"
                                                placeholder="Tahun">
                                            @error('rkab_peralatan_pilih_tahun')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>

                                        @foreach (['rkab_peralatan_jenis' => 'text', 'rkab_peralatan_merk' => 'text', 'rkab_peralatan_jumlah' => 'number', 'rkab_peralatan_no_plat' => 'text', 'rkab_peralatan_status_milik_sendiri' => 'text', 'rkab_peralatan_status_sewa' => 'text', 'rkab_peralatan_bbm_asal_kalteng' => 'text', 'rkab_peralatan_bbm_non_kalteng' => 'text', 'rkab_peralatan_rencana_pakai_bbm' => 'text'] as $field => $type)
                                            <td>
                                                <input type="{{ $type }}" class="form-control form-control-sm @error($field) is-invalid @enderror" wire:model="{{ $field }}"
                                                    placeholder="{{ ucfirst(str_replace('_', ' ', str_replace('rkab_peralatan_', '', $field))) }}">
                                                @error($field)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        @endforeach

                                        <td>
                                            <button type="button" class="btn btn-success btn-sm text-white text-nowrap" wire:click="store">
                                                <i class="ri-add-line"></i> Tambah
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- / Example-->
                </div>
            </div>
        </div>
        <!-- /Tabel Perusahaan-->

    </div>
    <!-- / Top Row Widgets-->
</div>
@script
    <script>
        $wire.on('store-success', (event) => {
            var element = document.getElementById('liveToast');
            console.log(event.message);
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 3000);
        });
        $wire.on('update-success', (event) => {
            var element = document.getElementById('liveToast');
            console.log(event.message);
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 3000);
        });
        $wire.on('delete-success', (event) => {
            var element = document.getElementById('liveToast');
            console.log(event.message);
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-warning";
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 3000);
        });
    </script>
@endscript

@push('scriptsatas')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/libs.bundle.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/theme.bundle.css" />
@endpush

@push('scriptsbawah')
    <!-- Theme JS -->
    <!-- Vendor JS -->
    <script src="{{ asset('') }}assets/js/vendor.bundle.js"></script>

    <!-- Theme JS -->
    <script src="{{ asset('') }}assets/js/theme.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
