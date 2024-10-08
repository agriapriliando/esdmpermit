<main class="app-main">
    <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content mt-3"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2>Detail Permohonan<div class="float-end badge badge-success text-bg-success">Kode : {{ $appreq->ver_code }}</div>
                            </h2>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table>
                                        <tr>
                                            <td class="fw-bold" style="min-width: 150px">1. Layanan</td>
                                            <td>: {{ $appreqdata->permitwork->name_permit }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">2. Pemohon</td>
                                            <td>: {{ $appreqdata->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">3. Nama Perusahaan</td>
                                            <td>: {{ $appreqdata->company->name_company }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Catatan Pemohon :</td>
                                            <td> {!! $appreqdata->notes !!}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table>
                                        <tr>
                                            <td class="fw-bold">Tanggal Submit</td>
                                            <td>: {{ Carbon\Carbon::parse($appreqdata->date_submitted)->translatedFormat('d/m/Y H:i') }} Wib</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tanggal Proses</td>
                                            @if ($appreqdata->date_processed != null)
                                                <td>: {{ Carbon\Carbon::parse($appreqdata->date_processed)->translatedFormat('d/m/Y H:i') }} Wib</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tanggal Selesai</td>
                                            @if ($appreqdata->date_finished != null)
                                                <td>: {{ Carbon\Carbon::parse($appreqdata->date_finished)->translatedFormat('d/m/Y H:i') }} Wib</td>
                                            @endif
                                        </tr>
                                        @if ($appreqdata->date_rejected != null)
                                            <tr>
                                                <td class="fw-bold">Tanggal Ditolak</td>
                                                <td>: {{ Carbon\Carbon::parse($appreqdata->date_rejected)->translatedFormat('d/m/Y H:i') }} Wib</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Alasan Ditolak</td>
                                                <td>: {{ $appreqdata->reason_rejected }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                                <hr class="mt-4">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="p-3 rounded shadow" x-data="{ open: false }">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <h3>Korespondensi</h3>
                                                    <button
                                                        x-on:click="
                                                    open = !open;
                                                    document.getElementById('file_uploadd').innerHTML = 'Klik Untuk Upload Berkas...';
                                                    $wire.file_upload = '';
                                                    "
                                                        class="btn btn-sm btn-success"><i class="bi bi-reply"></i>
                                                        Balas</button>
                                                </div>
                                                <div x-show="open" class="mb-3" x-transition>
                                                    <style>
                                                        .trix-button--icon-code,
                                                        .trix-button--icon-strike {
                                                            display: none;
                                                        }
                                                    </style>
                                                    <form wire:submit.prevent = "save">
                                                        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false"
                                                            x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                            <div class="mb-2">
                                                                <div class="form-group mb-2 filehover" x-data="{ files: null }">
                                                                    <div id="file_uploadd" class="custom-file p-2 ps-3 bg-warning rounded" @click="$refs.upload.click()"
                                                                        x-html="files ?
                                                                    files.map(file => '- '+file.name).join('</br> ')
                                                                    : 'Klik Untuk Upload Berkas...'">
                                                                        Klik Untuk Upload Berkas...
                                                                    </div>
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
                                                            <div class="mb-2">
                                                                <input wire:model="desc" id="desc" type="hidden" name="desc">
                                                                <trix-editor input="desc"></trix-editor>
                                                                @error('desc')
                                                                    <div class="alert alert-danger">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <button x-on:click="open = false" type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:target="file_upload">
                                                                <i class="bi bi-send"></i> Kirim
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <hr>
                                                </div>
                                                <div>
                                                    @session('deletec')
                                                        <div id="alert-cor" x-init="setTimeout(() => document.getElementById('alert-cor').remove(), 3000)">
                                                            <div class="alert alert-warning">{{ session('deletec') }}</div>
                                                        </div>
                                                    @endsession
                                                    @foreach ($correspondences as $c)
                                                        <div wire:key="{{ $c->id }}" class="px-3 pb-2 rounded {{ $c->user->role == 'pemohon' ? 'text-end bg-body-secondary' : '' }}">
                                                            <p>
                                                                <i class="bi bi-clock-history me-1" style="font-size: 12px">
                                                                    {{ Carbon\Carbon::parse($c->created_at)->translatedFormat('d/m/Y H:i') }} Wib</i>
                                                                @if ($c->user->role == 'pemohon')
                                                                    <i class="bi bi-eye" style="font-size: 12px"> {{ $c->viewed ? 'Sudah Dibaca' : 'Belum Dibaca' }}</i>
                                                                @endif
                                                                @if ($c->viewed == 0 && $c->user_id == 2)
                                                                    <i wire:click="deletePesan({{ $c->id }})" wire:confirm="Yakin ingin hapus Pesan ini?" class="bi bi-trash filehover"></i>
                                                                @endif
                                                                <br>
                                                                Pengirim : {{ $c->user->name }}
                                                                <br>
                                                                Pesan : {!! $c->desc !!}
                                                            </p>
                                                        </div>
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between mb-2 pt-3">
                                                <h4>Daftar Berkas File</h4>
                                                <div class="d-flex">
                                                    <input wire:model.live.debounce="search_docs" style="width: 180px" type="text" class="form-control form-control-sm"
                                                        placeholder="Cari Nama Berkas">
                                                    <button wire:click="resetSearchDocs" class="btn btn-sm btn-warning"><i class="bi bi-x"></i></button>
                                                </div>
                                            </div>
                                            <ol class="list-group list-group-numbered">
                                                @session('delete')
                                                    <div id="alert-doc" x-init="setTimeout(() => document.getElementById('alert-doc').remove(), 3000)">
                                                        <div class="alert alert-warning">{{ session('delete') }}</div>
                                                    </div>
                                                @endsession
                                                @foreach ($docs as $d)
                                                    <div wire:key="d-{{ $d->id }}">
                                                        <li class="list-group-item">{{ $d->name_doc }}
                                                            @if ($d->type_doc == 'Revisi')
                                                                <a class="float-end btn btn-danger btn-sm" wire:click="deleteDoc({{ $d->id }})" wire:confirm="Yakin ingin hapus Dokumen?"><i
                                                                        class="bi bi-trash"></i></a>
                                                            @endif
                                                            <div class="float-end badge text-bg-success me-2">{{ $d->type_doc }}</div>
                                                            <br><i class="bi bi-clock-history me-1" style="font-size: 12px">
                                                                {{ Carbon\Carbon::parse($d->created_at)->translatedFormat('d/m/Y H:i') }} Wib
                                                            </i>
                                                            <a href="{{ url('storage/file_doc/' . $d->file_name) }}" target="_blank"><i class="bi bi-download"></i></a>
                                                        </li>
                                                    </div>
                                                @endforeach
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
@script
    <script>
        $wire.on('trix-blur', (event) => {
            var trix = document.getElementById("desc");
            $wire.desc = trix.getAttribute('value');
        });
    </script>
@endscript
