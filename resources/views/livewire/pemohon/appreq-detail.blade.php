<main class="app-main">
    <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content mt-3"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2>Detail Permohonan : 12322432</h2>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table>
                                        <tr>
                                            <td class="fw-bold">1. Layanan</td>
                                            <td>: Layanan</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">2. Pemohon</td>
                                            <td>: Nama Pemohon</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">3. Nama Perusahaan</td>
                                            <td>: PT ....</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">4. Ver Code</td>
                                            <td>: 2334324</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Catatan Pemohon</td>
                                            <td>: Catatan</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table>
                                        <tr>
                                            <td class="fw-bold">Tanggal Submit</td>
                                            <td>: Tgl</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tanggal Proses</td>
                                            <td>: Tgl</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tanggal Selesai</td>
                                            <td>: Tgl</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tanggal Ditolak</td>
                                            <td>: Tgl (Alasan ditolak : )</td>
                                        </tr>
                                    </table>
                                </div>
                                <hr class="mt-4">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="p-3 rounded shadow" x-data="{ open: true }">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <h3>Korespondensi</h3>
                                                    <button @click="open = !open" class="btn btn-sm btn-success"><i class="bi bi-reply"></i> Balas</button>
                                                </div>
                                                <div x-show="open" class="mb-3" x-transition>
                                                    <style>
                                                        .trix-button--icon-code,
                                                        .trix-button--icon-strike {
                                                            display: none;
                                                        }
                                                    </style>
                                                    <form action="">
                                                        <div class="mb-2">
                                                            <input wire:model="notes" id="notes" type="hidden" name="notes">
                                                            <trix-editor input="notes"></trix-editor>
                                                        </div>
                                                        <div class="mb-2">
                                                            {{-- <label for="file_upload">Upload Berkas</label> --}}
                                                            <div class="form-group mb-2" x-data="{ files: null }">
                                                                <div class="custom-file p-2 ps-3 bg-warning rounded" @click="$refs.upload.click()"
                                                                    x-html="files ?
                                                                    files.map(file => '- '+file.name).join('</br> ')
                                                                    : 'Klik Untuk Upload Berkas...'">
                                                                    Klik Untuk Upload Berkas...
                                                                </div>
                                                                {{-- <label class="custom-file-label m-3" for="file_upload">Pilih Berkas</label><br> --}}
                                                                <input style="z-index: -22;" x-on:change="files = Object.values($event.target.files)" x-ref="upload" wire:model.live="file_upload"
                                                                    type="file" class="custom-file-input d-none" id="file_upload" multiple="true">
                                                            </div>
                                                            @error('file_upload')
                                                                <div class="alert alert-danger">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            @error('file_upload.*')
                                                                <div class="alert alert-danger">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2" x-show="uploading">
                                                            <div class="progress" role="progressbar" aria-label="Basic example" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-bar" :style="{ width: progress + '%' }"></div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-success" wire:loading.attr="disabled" wire:target="file_upload">
                                                            <i class="bi bi-send"></i> Kirim
                                                        </button>
                                                    </form>
                                                    <hr>
                                                </div>
                                                <div>
                                                    <p>Pengirim : Adul - <small><i class="bi bi-clock-history"></i> 28/09/2024 17:14 Wib</small><br>
                                                        Pesan : Berkas belum lengkap, silahkan tambahkan KTP Penanggung Jawab
                                                    </p>
                                                    <hr>
                                                    <p class="text-end">Pengirim : Adul - <small><i class="bi bi-clock-history"></i> 28/09/2024 17:14 Wib</small><br>
                                                        Pesan : Berkas belum lengkap, silahkan tambahkan KTP Penanggung Jawab
                                                    </p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h4>Daftar Berkas File</h4>
                                                <div class="d-flex">
                                                    <input style="width: 180px" type="text" class="form-control form-control-sm" placeholder="Cari berkas">
                                                    <button class="btn btn-sm btn-warning"><i class="bi bi-x"></i></button>
                                                </div>
                                            </div>
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">Dokumen Scan KTP Direktur - <small>15/09/2024 18:20 Wib (Ajuan)</small></li>
                                                <li class="list-group-item">Dokumen Scan KTP Direktur - <small>15/09/2024 18:20 Wib (Ajuan)</small></li>
                                                <li class="list-group-item">Dokumen Scan KTP Direktur - <small>15/09/2024 18:20 Wib (Ajuan)</small></li>
                                                <li class="list-group-item">Dokumen Scan KTP Direktur - <small>15/09/2024 18:20 Wib (Ajuan)</small></li>
                                                <li class="list-group-item">Dokumen Scan KTP Direktur - <small>15/09/2024 18:20 Wib (Ajuan)</small></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main>
