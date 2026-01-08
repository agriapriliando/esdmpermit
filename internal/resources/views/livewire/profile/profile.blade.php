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
                            <h6 class="card-title m-0">{{ $nama_pemegang_perizinan }}</h6>
                            <div class="d-flex gap-2">
                                <a href="{{ route('home') }}" class="btn btn-primary btn-sm"><i class="ri-arrow-left-line"></i> DAFTAR</a>

                                @if (!$isEditing)
                                    <button type="button" class="btn btn-sm btn-primary" wire:click="edit({{ $id }})">
                                        <i class="ri-edit-line"></i> Edit
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <form wire:submit.prevent="update">
                                <div class="row">
                                    {{-- Nama Pemegang Perizinan --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Pemegang Perizinan</label>
                                        <input type="text" class="form-control @error('nama_pemegang_perizinan') is-invalid @enderror" wire:model.live="nama_pemegang_perizinan"
                                            @disabled(!$isEditing)>
                                        @error('nama_pemegang_perizinan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Kabupaten / Kota --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kabupaten / Kota</label>
                                        <input type="text" class="form-control @error('kabupaten_kota') is-invalid @enderror" wire:model="kabupaten_kota" @disabled(!$isEditing)>
                                        @error('kabupaten_kota')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Kecamatan --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kecamatan</label>
                                        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" wire:model="kecamatan" @disabled(!$isEditing)>
                                        @error('kecamatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Desa / Kelurahan --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Desa / Kelurahan</label>
                                        <input type="text" class="form-control @error('desa_kelurahan') is-invalid @enderror" wire:model="desa_kelurahan" @disabled(!$isEditing)>
                                        @error('desa_kelurahan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Jenis Izin --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Izin</label>
                                        <select class="form-select @error('jenis_izin') is-invalid @enderror" wire:model.live="jenis_izin" @disabled(!$isEditing)>
                                            <option value="">-- Pilih Jenis Izin --</option>
                                            <option value="IUP">IUP</option>
                                            <option value="SIPB">SIPB</option>
                                            <option value="IPP">IPP</option>
                                            <option value="IUJP">IUJP</option>
                                        </select>
                                        @error('jenis_izin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Nomor SK Izin --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nomor SK Izin</label>
                                        <input type="text" class="form-control @error('nomor_sk_izin') is-invalid @enderror" wire:model="nomor_sk_izin" @disabled(!$isEditing)>
                                        @error('nomor_sk_izin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tanggal Terbit Izin --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Terbit Izin</label>
                                        <input type="date" class="form-control @error('tgl_terbit_izin') is-invalid @enderror" wire:model="tgl_terbit_izin" @disabled(!$isEditing)>
                                        @error('tgl_terbit_izin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tanggal Berakhir Izin --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Berakhir Izin</label>
                                        <input type="date" class="form-control @error('tgl_berakhir_izin') is-invalid @enderror" wire:model="tgl_berakhir_izin" @disabled(!$isEditing)>
                                        @error('tgl_berakhir_izin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @if ($jenis_izin == 'IUP' || $jenis_izin == 'SIPB')
                                        {{-- Luas Ha --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Luas (Ha)</label>
                                            <input type="text" class="form-control @error('luas_ha') is-invalid @enderror" wire:model="luas_ha" @disabled(!$isEditing)>
                                            @error('luas_ha')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Tahapan IUP --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tahapan IUP</label>
                                            <select class="form-select @error('tahapan_iup') is-invalid @enderror" wire:model="tahapan_iup" @disabled(!$isEditing)>
                                                <option value="">-- Pilih Tahapan --</option>
                                                <option value="Eksplorasi">Eksplorasi</option>
                                                <option value="Operasi Produksi">Operasi Produksi</option>
                                            </select>
                                            @error('tahapan_iup')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif

                                    {{-- Komoditas --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Komoditas</label>
                                        <input type="text" class="form-control @error('komoditas') is-invalid @enderror" wire:model="komoditas" @disabled(!$isEditing)>
                                        @error('komoditas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- NIB --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nomor Induk Berusaha (NIB)</label>
                                        <input type="text" class="form-control @error('nomor_induk_berusaha_nib') is-invalid @enderror" wire:model="nomor_induk_berusaha_nib"
                                            @disabled(!$isEditing)>
                                        @error('nomor_induk_berusaha_nib')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- NPWP --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nomor NPWP</label>
                                        <input type="text" class="form-control @error('nomor_npwp') is-invalid @enderror" wire:model="nomor_npwp" @disabled(!$isEditing)>
                                        @error('nomor_npwp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status NPWP --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status NPWP</label>
                                        <input type="text" class="form-control @error('status_npwp') is-invalid @enderror" wire:model="status_npwp" @disabled(!$isEditing)>
                                        @error('status_npwp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Alamat Perusahaan --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Alamat Perusahaan (Sesuai SK Izin)</label>
                                        <textarea class="form-control @error('alamat_perusahaan_berdasarkan_sk_izin') is-invalid @enderror" rows="3" wire:model="alamat_perusahaan_berdasarkan_sk_izin" @disabled(!$isEditing)></textarea>
                                        @error('alamat_perusahaan_berdasarkan_sk_izin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Nama Direktur --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Direktur (Sesuai SK Izin)</label>
                                        <input type="text" class="form-control @error('nama_direktur_sesuai_sk_izin') is-invalid @enderror" wire:model="nama_direktur_sesuai_sk_izin"
                                            @disabled(!$isEditing)>
                                        @error('nama_direktur_sesuai_sk_izin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Dewan Direksi --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Dewan Direksi (BOD)</label>
                                        <textarea class="form-control @error('dewan_direksi_bod') is-invalid @enderror" wire:model="dewan_direksi_bod" rows="3" @disabled(!$isEditing)></textarea>
                                        @error('dewan_direksi_bod')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Modal Kerja --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Modal Kerja</label>
                                        <input type="text" class="form-control @error('modal_kerja') is-invalid @enderror" wire:model="modal_kerja" @disabled(!$isEditing)>
                                        @error('modal_kerja')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Nama PIC --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama PIC</label>
                                        <input type="text" class="form-control @error('nama_pic') is-invalid @enderror" wire:model="nama_pic" @disabled(!$isEditing)>
                                        @error('nama_pic')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- No HP PIC --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP PIC</label>
                                        <input type="text" class="form-control @error('no_hp_pic') is-invalid @enderror" wire:model="no_hp_pic" @disabled(!$isEditing)>
                                        @error('no_hp_pic')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Email Perusahaan --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email Resmi Perusahaan</label>
                                        <input type="email" class="form-control @error('email_resmi_perusahaan') is-invalid @enderror" wire:model="email_resmi_perusahaan"
                                            @disabled(!$isEditing)>
                                        @error('email_resmi_perusahaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- NIB Email OSS --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email OSS</label>
                                        <input type="email" class="form-control @error('nib_email_oss') is-invalid @enderror" wire:model="nib_email_oss" @disabled(!$isEditing)>
                                        @error('nib_email_oss')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- NIB Nomor HP OSS --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nomor HP OSS</label>
                                        <input type="text" class="form-control @error('nib_nomor_hp_oss') is-invalid @enderror" wire:model="nib_nomor_hp_oss" @disabled(!$isEditing)>
                                        @error('nib_nomor_hp_oss')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Keterangan --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" wire:model="keterangan" @disabled(!$isEditing)></textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @if ($jenis_izin == 'IPP' || $jenis_izin == 'IUJP')
                                        {{-- Kontrak Kerja Sama --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Kontrak Kerja Sama</label>
                                            <input type="text" class="form-control @error('kontrak_kerja_sama') is-invalid @enderror" wire:model="kontrak_kerja_sama"
                                                @disabled(!$isEditing)>
                                            @error('kontrak_kerja_sama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- jenis_bidang_sub_bidang_usaha_jasa --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Jenis, Bidang, Sub Bidang Usaha Jasa</label>
                                            <textarea class="form-control @error('jenis_bidang_sub_bidang_usaha_jasa') is-invalid @enderror" rows="3" wire:model="jenis_bidang_sub_bidang_usaha_jasa" @disabled(!$isEditing)></textarea>
                                            @error('jenis_bidang_sub_bidang_usaha_jasa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif
                                </div>

                                <div class="d-flex">
                                    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm me-2">Kembali</a>
                                    @if (!$isEditing)
                                        <button type="button" class="btn btn-sm btn-primary" wire:click="edit({{ $id }})">
                                            <i class="ri-edit-line"></i> Edit
                                        </button>
                                    @endif

                                    @if ($isEditing)
                                        <button type="button" class="btn btn-success btn-sm me-2" wire:click="cancel">
                                            <i class="ri-close-circle-line"></i> Batal
                                        </button>
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="ri-save-3-line"></i> Simpan
                                        </button>
                                    @endif
                                </div>
                            </form>
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
