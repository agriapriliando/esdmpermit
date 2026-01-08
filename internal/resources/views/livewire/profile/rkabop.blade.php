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
                    <div class="card mb-4" x-data="{
                        opendokumen: false,
                        progress: 0,
                        showSd: false,
                        showCad: false,
                        showProd1: false,
                        showProd2: false,
                        showProd3: false,
                        showPajak: false,
                        showTk1: false,
                        showTk2: false,
                        showTk3: false,
                    }" x-on:livewire-upload-progress="progress = $event.detail.progress" x-on:livewire-upload-finish="progress = 0"
                        x-on:livewire-upload-error="progress = 0">
                        <div class="card-header justify-content-between align-items-center d-md-flex">
                            <div>
                                <h5 class="card-title m-0">Daftar {{ $judul_menu . ' | ' . session('nama_pemegang_perizinan') }}</h5>
                                <p><span class="badge text-bg-success">Tahapan : {{ $jenis_tahapan }}</span></p>
                            </div>

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
                            <div class="btn-group mb-2" role="group">
                                <input type="checkbox" @click="showSd = !showSd" class="btn-check" id="showSd" autocomplete="off">
                                <label class="btn btn-sm btn-outline-primary" for="showSd">Sumber Daya</label>
                                <input type="checkbox" @click="showCad = !showCad" class="btn-check" id="showCad" autocomplete="off">
                                <label class="btn btn-sm btn-outline-primary" for="showCad">Cadangan</label>
                                <input type="checkbox" @click="showProd1 = !showProd1" class="btn-check" id="showProd1" autocomplete="off">
                                <label class="btn btn-sm btn-outline-primary" for="showProd1">Produksi Thn I</label>
                                <input type="checkbox" @click="showProd2 = !showProd2" class="btn-check" id="showProd2" autocomplete="off">
                                <label class="btn btn-sm btn-outline-primary" for="showProd2">Produksi Thn II</label>
                                <input type="checkbox" @click="showProd3 = !showProd3" class="btn-check" id="showProd3" autocomplete="off">
                                <label class="btn btn-sm btn-outline-primary" for="showProd3">Produksi Thn III</label>
                                <input type="checkbox" @click="showPajak = !showPajak" class="btn-check" id="showPajak" autocomplete="off">
                                <label class="btn btn-sm btn-outline-primary" for="showPajak">Pajak</label>
                                <input type="checkbox" @click="showTk1 = !showTk1" class="btn-check" id="showTk1" autocomplete="off">
                                <label class="btn btn-sm btn-outline-primary" for="showTk1">Tenaga Kerja Thn I</label>
                                <input type="checkbox" @click="showTk2 = !showTk2" class="btn-check" id="showTk2" autocomplete="off">
                                <label class="btn btn-sm btn-outline-primary" for="showTk2">Tenaga Kerja Thn 2</label>
                                <input type="checkbox" @click="showTk3 = !showTk3" class="btn-check" id="showTk3" autocomplete="off">
                                <label class="btn btn-sm btn-outline-primary" for="showTk3">Tenaga Kerja Thn 3</label>
                            </div>
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>No Persetujuan <br>dan Perihal</th>
                                        <th>Tgl Persetujuan</th>

                                        {{-- Sumber Daya Thn I --}}
                                        <th x-show="showSd">SD I M3 Tereka</th>
                                        <th x-show="showSd">SD I M3 Tertunjuk</th>
                                        <th x-show="showSd">SD I M3 Terukur</th>
                                        <th x-show="showSd">SD I MT Tereka</th>
                                        <th x-show="showSd">SD I MT Tertunjuk</th>
                                        <th x-show="showSd">SD I MT Terukur</th>

                                        {{-- Sumber Daya Thn II --}}
                                        <th x-show="showSd">SD II M3 Tereka</th>
                                        <th x-show="showSd">SD II M3 Tertunjuk</th>
                                        <th x-show="showSd">SD II M3 Terukur</th>
                                        <th x-show="showSd">SD II MT Tereka</th>
                                        <th x-show="showSd">SD II MT Tertunjuk</th>
                                        <th x-show="showSd">SD II MT Terukur</th>

                                        {{-- Sumber Daya Thn III --}}
                                        <th x-show="showSd">SD III M3 Tereka</th>
                                        <th x-show="showSd">SD III M3 Tertunjuk</th>
                                        <th x-show="showSd">SD III M3 Terukur</th>
                                        <th x-show="showSd">SD III MT Tereka</th>
                                        <th x-show="showSd">SD III MT Tertunjuk</th>
                                        <th x-show="showSd">SD III MT Terukur</th>

                                        {{-- Tenaga Ahli --}}
                                        <th x-show="showSd">Competent Person</th>

                                        {{-- Cadangan --}}
                                        <th x-show="showCad">Cad I Terkira</th>
                                        <th x-show="showCad">Cad I Terbukti</th>
                                        <th x-show="showCad">Cad II Terkira</th>
                                        <th x-show="showCad">Cad II Terbukti</th>
                                        <th x-show="showCad">Cad III Terkira</th>
                                        <th x-show="showCad">Cad III Terbukti</th>

                                        {{-- Produksi Thn I --}}
                                        <th x-show="showProd1">Prod I Target M3 Utama</th>
                                        <th x-show="showProd1">Prod I Target M3 Sampingan</th>
                                        <th x-show="showProd1">Prod I Realisasi M3 Utama</th>
                                        <th x-show="showProd1">Prod I Realisasi M3 Sampingan</th>
                                        <th x-show="showProd1">Prod I Target MT Utama</th>
                                        <th x-show="showProd1">Prod I Target MT Sampingan</th>
                                        <th x-show="showProd1">Prod I Realisasi MT Utama</th>
                                        <th x-show="showProd1">Prod I Realisasi MT Sampingan</th>

                                        {{-- Produksi Thn II --}}
                                        <th x-show="showProd2">Prod II Target M3 Utama</th>
                                        <th x-show="showProd2">Prod II Target M3 Sampingan</th>
                                        <th x-show="showProd2">Prod II Realisasi M3 Utama</th>
                                        <th x-show="showProd2">Prod II Realisasi M3 Sampingan</th>
                                        <th x-show="showProd2">Prod II Target MT Utama</th>
                                        <th x-show="showProd2">Prod II Target MT Sampingan</th>
                                        <th x-show="showProd2">Prod II Realisasi MT Utama</th>
                                        <th x-show="showProd2">Prod II Realisasi MT Sampingan</th>

                                        {{-- Produksi Thn III --}}
                                        <th x-show="showProd3">Prod III Target M3 Utama</th>
                                        <th x-show="showProd3">Prod III Target M3 Sampingan</th>
                                        <th x-show="showProd3">Prod III Realisasi M3 Utama</th>
                                        <th x-show="showProd3">Prod III Realisasi M3 Sampingan</th>
                                        <th x-show="showProd3">Prod III Target MT Utama</th>
                                        <th x-show="showProd3">Prod III Target MT Sampingan</th>
                                        <th x-show="showProd3">Prod III Realisasi MT Utama</th>
                                        <th x-show="showProd3">Prod III Realisasi MT Sampingan</th>

                                        {{-- Pajak --}}
                                        <th x-show="showPajak">Pajak I Daerah</th>
                                        <th x-show="showPajak">Pajak I Opsen</th>
                                        <th x-show="showPajak">Pajak II Daerah</th>
                                        <th x-show="showPajak">Pajak II Opsen</th>
                                        <th x-show="showPajak">Pajak III Daerah</th>
                                        <th x-show="showPajak">Pajak III Opsen</th>

                                        {{-- Tenaga Kerja Thn I --}}
                                        <th x-show="showTk1">TK I Lokal</th>
                                        <th x-show="showTk1">TK I Non Lokal</th>
                                        <th x-show="showTk1">TK I TKA</th>

                                        {{-- Tenaga Kerja Thn II --}}
                                        <th x-show="showTk2">TK II Lokal</th>
                                        <th x-show="showTk2">TK II Non Lokal</th>
                                        <th x-show="showTk2">TK II TKA</th>

                                        {{-- Tenaga Kerja Thn III --}}
                                        <th x-show="showTk3">TK III Lokal</th>
                                        <th x-show="showTk3">TK III Non Lokal</th>
                                        <th x-show="showTk3">TK III TKA</th>

                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <style>
                                    th {
                                        white-space: nowrap;
                                    }
                                </style>
                                <tbody>
                                    @foreach ($rkabop as $id => $item)
                                        <tr wire:key="rkabop-row-{{ $id }}" x-data="{ confirmDelete: false }">
                                            <td>{{ $loop->iteration }}</td>

                                            {{-- Persetujuan --}}
                                            <td><input type="text" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_no_persetujuan"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td><input type="date" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_tgl_persetujuan"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Sumber Daya I --}}
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_i_m3_tereka"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_i_m3_tertunjuk"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_i_m3_terukur"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_i_mt_tereka"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_i_mt_tertunjuk"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_i_mt_terukur"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Sumber Daya II --}}
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_ii_m3_tereka"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_ii_m3_tertunjuk"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_ii_m3_terukur"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_ii_mt_tereka"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_ii_mt_tertunjuk"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_ii_mt_terukur"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Sumber Daya III --}}
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_iii_m3_tereka"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_iii_m3_tertunjuk"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_iii_m3_terukur"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_iii_mt_tereka"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_iii_mt_tertunjuk"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showSd"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_thn_iii_mt_terukur"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Tenaga Ahli Sumber Daya --}}
                                            <td x-show="showSd"><input type="text" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_sd_tenaga_ahli"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Cadangan --}}
                                            <td x-show="showCad"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_cadangan_thn_i_terkira"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showCad"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_cadangan_thn_i_terbukti"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showCad"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_cadangan_thn_ii_terkira"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showCad"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_cadangan_thn_ii_terbukti"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showCad"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_cadangan_thn_iii_terkira"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showCad"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_cadangan_thn_iii_terbukti" :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Tenaga Ahli Sumber Daya --}}
                                            <td x-show="showCad"><input type="text" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_cadangan_tenaga_ahli"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Produksi I --}}
                                            <td x-show="showProd1"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_i_target_m3_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd1"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_i_target_m3_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd1"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_i_realisasi_m3_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd1"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_i_realisasi_m3_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd1"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_i_target_mt_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd1"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_i_target_my_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd1"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_i_realisasi_mt_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd1"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_i_realisasi_mt_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Produksi II --}}
                                            <td x-show="showProd2"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_ii_target_m3_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd2"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_ii_target_m3_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd2"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_ii_realisasi_m3_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd2"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_ii_realisasi_m3_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd2"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_ii_target_mt_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd2"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_ii_target_my_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd2"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_ii_realisasi_mt_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd2"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_ii_realisasi_mt_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Produksi III --}}
                                            <td x-show="showProd3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_iii_target_m3_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_iii_target_m3_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_iii_realisasi_m3_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_iii_realisasi_m3_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_iii_target_mt_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_iii_target_my_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_iii_realisasi_mt_utama" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showProd3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_prod_thn_iii_realisasi_mt_sampingan" :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Pajak --}}
                                            <td x-show="showPajak"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_pajak_thn_i_daerah"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showPajak"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_pajak_thn_i_opsen"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showPajak"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_pajak_thn_ii_daerah"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showPajak"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_pajak_thn_ii_opsen"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showPajak"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_pajak_thn_iii_daerah"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showPajak"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_pajak_thn_iii_opsen"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Tenaga Kerja I --}}
                                            <td x-show="showTk1"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_tenaga_kerja_thn_i_lokal" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showTk1"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_tenaga_kerja_thn_i_non_lokal" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showTk1"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_tenaga_kerja_thn_i_tka"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Tenaga Kerja II --}}
                                            <td x-show="showTk2"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_tenaga_kerja_thn_ii_lokal" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showTk2"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_tenaga_kerja_thn_ii_non_lokal" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showTk2"><input type="number" class="form-control form-control-sm" wire:model="rkabop.{{ $id }}.rkabop_tenaga_kerja_thn_ii_tka"
                                                    :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Tenaga Kerja III --}}
                                            <td x-show="showTk3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_tenaga_kerja_thn_iii_lokal" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showTk3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_tenaga_kerja_thn_iii_non_lokal" :disabled="$wire.editingId !== {{ $id }}"></td>
                                            <td x-show="showTk3"><input type="number" class="form-control form-control-sm"
                                                    wire:model="rkabop.{{ $id }}.rkabop_tenaga_kerja_thn_iii_tka" :disabled="$wire.editingId !== {{ $id }}"></td>

                                            {{-- Tombol Aksi --}}
                                            <td>
                                                <div class="d-flex gap-1">
                                                    {{-- Detail --}}
                                                    <a href="{{ route('rkabop.peralatan.show', $id) }}" class="btn btn-primary btn-sm {{ $jenis_tahapan == 'Eksplorasi' ? 'd-none' : '' }}"
                                                        x-show="$wire.editingId !== {{ $id }}">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
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

                                    {{-- Tambah data baru --}}
                                    <tr>
                                        <th>#</th>
                                        <th>No Persetujuan <br>dan Perihal</th>
                                        <th>Tgl Persetujuan</th>

                                        <th>Aksi</th>
                                    </tr>
                                    <tr>
                                        <td>+</td>
                                        {{-- Persetujuan --}}
                                        <td>
                                            <input type="text" class="form-control form-control-sm @error('rkabop_no_persetujuan') is-invalid @enderror" wire:model="rkabop_no_persetujuan"
                                                placeholder="No dan Perihal">
                                            @error('rkabop_no_persetujuan')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="date" class="form-control form-control-sm @error('rkabop_tgl_persetujuan') is-invalid @enderror" wire:model="rkabop_tgl_persetujuan">

                                            @error('rkabop_tgl_persetujuan')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </td>


                                        <td>
                                            <button type="button" class="btn btn-success btn-sm text-white" wire:click="store">
                                                <i class="ri-add-line"></i> Tambah
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <small class="text-muted">Menu Daftar Peralatan Terbuka jika Tahapan : Operasi Produksi</small>
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
