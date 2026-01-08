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
                    <div class="card mb-4" x-data="{ opendokumen: false, progress: 0 }" x-on:livewire-upload-progress="progress = $event.detail.progress" x-on:livewire-upload-finish="progress = 0"
                        x-on:livewire-upload-error="progress = 0">
                        <div class="card-header justify-content-between align-items-center d-md-flex">
                            <h5 class="card-title m-0">Daftar {{ $judul_menu . ' | ' . session('nama_pemegang_perizinan') }}</h5>
                            <div class="d-flex gap-1 mt-md-0 mt-2">
                                <button type="button" @click="opendokumen = !opendokumen" class="btn btn-primary btn-sm"><i class="ri-menu-line"></i> <span
                                        x-text="opendokumen ? 'Tutup Dokumen' : 'Lihat Dokumen'"></span></button>
                                <a href="{{ route('profile.show', session('id_perusahaan')) }}" wire:navigate class="btn btn-primary btn-sm mx-3">PROFIL</a>
                            </div>
                        </div>
                        {{-- start daftar dokumen --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body table-responsive" x-show="opendokumen" x-transition>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <form wire:submit.prevent="saveDokumen('{{ $input_model_dokumen }}')">
                                        <div class="row">
                                            <div class="col-12 col-md-4 mb-2">
                                                <label for="jenis_dokumen">Jenis Dokumen</label>
                                                <select id="jenis_dokumen" class="form-control" wire:model="jenis_dokumen" required>
                                                    <option value="">-- Pilih Jenis Dokumen --</option>
                                                    @foreach ($jenis_dokumens as $d)
                                                        <option value="{{ $d }}">{{ $d }}</option>
                                                    @endforeach
                                                </select>
                                                @error('jenis_dokumen')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-8 mb-2">
                                                <div class="mb-1">
                                                    <span class="text-muted">Size Maksimal: 10 MB (10240 KB)
                                                        <br> Ekstensi: .jpg, .jpeg, .png, .pdf, .doc, .docx, .xls, .xlsx
                                                    </span>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="file" class="form-control" wire:model="file">
                                                    @error('file')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                {{-- Progress bar --}}
                                                <div x-show="progress > 0" class="progress mb-2">
                                                    <div class="progress-bar" role="progressbar" :style="`width: ${progress}%`" x-text="progress + '%'"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-success btn-sm text-white" wire:loading.attr="disabled">
                                                <span wire:loading wire:target="file">Mengunggah...</span>
                                                <span wire:loading.remove wire:target="file">Unggah Dokumen</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <hr>

                                <div class="col-12">
                                    <div class="justify-content-between align-items-center d-md-flex">
                                        <h5>Daftar Dokumen {{ $judul_menu }}</h5>
                                        <div class="my-2">
                                            <input type="text" class="form-control form-control-sm" wire:model.live.debounce.500ms="searchdok" placeholder="Cari Dokumen">
                                        </div>
                                    </div>
                                    <ul class="list-group">
                                        @forelse($dokumens as $dok)
                                            <li class="list-group-item" x-data="{ confirmDelete: false }">
                                                <span>{{ $loop->iteration + ($dokumens->currentPage() - 1) * $dokumens->perPage() }}. </span>
                                                {{ $dok->judul_dokumen }}.{{ $dok->ext_dokumen }}
                                                <span class="badge text-bg-success">{{ $dok->jenis_dokumen }}</span>
                                                <span class="badge text-bg-success">({{ number_format($dok->size_dokumen / 1024, 2) }} KB)</span>
                                                <div class="d-flex gap-1 float-end" @click.outside="confirmDelete = false">
                                                    {{-- btn unduh --}}
                                                    <a class="d-none btn btn-success btn-sm text-white" href="{{ asset($dok->link_dokumen) }}" target="_blank"><i class="ri-download-2-line"></i></a>
                                                    <button wire:click="downloadDokumen({{ $dok->id }})" class="btn btn-success btn-sm text-white"><i class="ri-download-2-line"></i></button>
                                                    <span wire:loading wire:target="downloadDokumen({{ $dok->id }})">Proses...</span>
                                                    {{-- btn unduh --}}
                                                    {{-- Konfirmasi hapus --}}
                                                    <div x-cloak x-show="confirmDelete" x-transition>
                                                        <div class="d-flex">
                                                            <button type="button" class="btn text-white btn-danger btn-sm" @click="confirmDelete = false"
                                                                wire:click="deleteDokumen({{ $dok->id }})">
                                                                Hapus
                                                            </button>
                                                            <button type="button" class="btn btn-secondary btn-sm" @click="confirmDelete = false">
                                                                Batal
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <button x-show="!confirmDelete" type="button" class="btn btn-danger btn-sm text-white" @click.stop="confirmDelete = true">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="list-group-item text-muted">Belum ada dokumen.</li>
                                        @endforelse
                                    </ul>
                                    <div class="d-flex justify-content-end mt-2">
                                        {{ $dokumens->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- end daftar dokumen --}}
                        {{-- tabel data --}}
                        <div class="card-body table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th class="text-nowrap">No Persetujuan <br>dan Perihal</th>
                                        <th class="text-nowrap">Tanggal Persetujuan</th>
                                        <th class="text-nowrap">Nominal yang Ditetapkan</th>
                                        <th class="text-nowrap">Nominal yang Ditempatkan</th>
                                        <th class="text-nowrap">Tahun Pembayaran</th>
                                        <th style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rpt as $id => $item)
                                        <tr wire:key="rpt-row-{{ $id }}" x-data="{ confirmDelete: false }">
                                            <td>{{ $loop->iteration }}</td>

                                            {{-- No Persetujuan dan Perihal --}}
                                            <td>
                                                <input type="text" class="form-control form-control-sm @error('rpt.' . $id . '.rpt_no_persetujuan') is-invalid @enderror"
                                                    wire:model="rpt.{{ $id }}.rpt_no_persetujuan" :disabled="$wire.editingId !== {{ $id }}">
                                                @error('rpt.' . $id . '.rpt_no_persetujuan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>

                                            {{-- Tanggal Persetujuan --}}
                                            <td>
                                                <input type="date" class="form-control form-control-sm @error('rpt.' . $id . '.rpt_tgl_persetujuan') is-invalid @enderror"
                                                    wire:model="rpt.{{ $id }}.rpt_tgl_persetujuan" :disabled="$wire.editingId !== {{ $id }}">
                                                @error('rpt.' . $id . '.rpt_tgl_persetujuan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>

                                            {{-- Nominal yang Ditetapkan --}}
                                            <td>
                                                <input type="text" class="form-control form-control-sm @error('rpt.' . $id . '.rpt_nominal_yang_ditetapkan') is-invalid @enderror"
                                                    wire:model="rpt.{{ $id }}.rpt_nominal_yang_ditetapkan" :disabled="$wire.editingId !== {{ $id }}">
                                                @error('rpt.' . $id . '.rpt_nominal_yang_ditetapkan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>

                                            {{-- Nominal yang Ditempatkan --}}
                                            <td>
                                                <input type="text" class="form-control form-control-sm @error('rpt.' . $id . '.rpt_nominal_yang_ditempatkan') is-invalid @enderror"
                                                    wire:model="rpt.{{ $id }}.rpt_nominal_yang_ditempatkan" :disabled="$wire.editingId !== {{ $id }}">
                                                @error('rpt.' . $id . '.rpt_nominal_yang_ditempatkan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>

                                            {{-- Tahun Pembayaran --}}
                                            <td>
                                                <input type="number" class="form-control form-control-sm @error('rpt.' . $id . '.rpt_tahun_pembayaran') is-invalid @enderror"
                                                    wire:model="rpt.{{ $id }}.rpt_tahun_pembayaran" :disabled="$wire.editingId !== {{ $id }}">
                                                @error('rpt.' . $id . '.rpt_tahun_pembayaran')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>

                                            {{-- Tombol Aksi --}}
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    {{-- Simpan --}}
                                                    <button type="button" class="btn btn-primary btn-sm" wire:click="update({{ $id }})"
                                                        x-show="$wire.editingId === {{ $id }}">
                                                        Simpan
                                                    </button>

                                                    {{-- Edit --}}
                                                    <button type="button" class="btn btn-secondary btn-sm" @click="$wire.editingId = {{ $id }}"
                                                        x-show="$wire.editingId !== {{ $id }}">
                                                        <i class="ri-edit-line"></i>
                                                    </button>

                                                    {{-- Batal --}}
                                                    <button type="button" class="btn btn-secondary btn-sm" wire:click="batal({{ $id }})"
                                                        x-show="$wire.editingId === {{ $id }}">
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
                                            <input type="text" class="form-control form-control-sm @error('rpt_no_persetujuan') is-invalid @enderror" wire:model="rpt_no_persetujuan"
                                                placeholder="No dan Perihal">
                                            @error('rpt_no_persetujuan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="date" class="form-control form-control-sm @error('rpt_tgl_persetujuan') is-invalid @enderror" wire:model="rpt_tgl_persetujuan">
                                            @error('rpt_tgl_persetujuan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm @error('rpt_nominal_yang_ditetapkan') is-invalid @enderror"
                                                wire:model="rpt_nominal_yang_ditetapkan" placeholder="Nominal Ditetapkan">
                                            @error('rpt_nominal_yang_ditetapkan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm @error('rpt_nominal_yang_ditempatkan') is-invalid @enderror"
                                                wire:model="rpt_nominal_yang_ditempatkan" placeholder="Nominal Ditempatkan">
                                            @error('rpt_nominal_yang_ditempatkan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm @error('rpt_tahun_pembayaran') is-invalid @enderror" wire:model="rpt_tahun_pembayaran"
                                                placeholder="Tahun">
                                            @error('rpt_tahun_pembayaran')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm text-white text-nowrap" wire:click="store">
                                                <i class="ri-add-line"></i> Tambah
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- tabel data --}}
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
