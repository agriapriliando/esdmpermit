<main class="app-main">
    <style>
        #fancybox-left-ico {
            left: 20px;
        }

        #fancybox-right-ico {
            right: 20px;
            left: auto;
        }
    </style>

    <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content mt-3"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div x-data
                    @notify.window="
                    setTimeout(function() {
                        bootstrap.Toast.getOrCreateInstance(document.getElementById('liveToast')).show();
                        document.getElementById('pesan').innerHTML = $event.detail.message;
                        console.log($event.detail.message);
                    }, 1000);
                    "
                    class="toast-container position-fixed top-0 start-50 translate-middle-x">
                    <div id="liveToast" class="toast mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto" id="pesan"></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3>
                                Kode Pengajuan : <span class="badge bg-success">{{ $appreq->ver_code }}</span>
                            </h3>
                            <div x-data="{ panduan: false }" class="mt-3">
                                <button class="float-end btn btn-info" @click="panduan = true"><i class="bi bi-question-circle"></i> Panduan</button>
                                <div x-show="panduan" @click.outside="panduan = false" class="overlay"></div>
                                <div x-show="panduan" @click.outside="panduan = false" x-transition:enter-start="modal-panduan-in" x-transition:leave-end="modal-panduan-out" class="modal-panduan">
                                    <div class="alert alert-danger text-center">
                                        <span class="font-weight-bold">Panduan :</span> <br>
                                        * Fitur Korespondensi akan terbuka saat Status Pengajuan : Disposisi/Diproses/Perbaikan <br>
                                        * Pesan atau File yang telah dibaca tidak bisa dihapus <br>
                                        * Berkas File sebelum diunggah wajib diberi nama/judul<br>
                                        * Berkas File Ajuan tidak bisa dihapus<br>
                                        <button @click="panduan = false" class="btn btn-sm btn-warning">Tutup</button>
                                    </div>
                                </div>
                                <a wire:navigate href="{{ route('admin.appreqdetail', $appreq->id) }}" @click="$dispatch('notify', { message: 'Refresh Daftar Pengajuan Berhasil' })"
                                    class="float-end btn btn-warning me-1 mb-2" type="button" wire:loading.attr="disabled">
                                    <i class="bi bi-arrow-repeat"></i> Refresh
                                </a>
                                <button @click="history.back()" class="float-end btn btn-warning me-1 mb-2" type="button"><i class="bi bi-arrow-left"></i> Kembali</button>
                                <div class="mt-4">
                                    <div style="width: 300px">
                                        <select wire:model.live="stat_id" class="form-select {{ $appreq->stat_id == 6 ? 'text-bg-success' : 'text-bg-warning' }} p-2 rounded" id="status"
                                            x-on:change="$wire.savestat()" {{ Auth::user()->role == 'superadmin' ? 'disabled' : '' }}>
                                            @foreach ($stats as $s)
                                                <option value="{{ $s->id }}" {{ $s->id === $stat_id ? 'selected' : '' }}> Status : {{ $s->desc_stat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div wire:loading class="bg-warning text-bg-warning p-2 rounded mt-2">
                                        Tunggu... Sedang Proses Menyimpan Status Pengajuan
                                    </div>
                                    @session('savestat')
                                        <div id="savestat" class="bg-success text-bg-success p-2 rounded mt-2" x-transition x-init="setTimeout(() => document.getElementById('savestat').remove(), 6000)">
                                            {{ session('savestat') }}
                                        </div>
                                    @endsession
                                </div>
                            </div>
                            {{-- stat id 6 selesai --}}
                            @if ($appreq->stat_id == 6)
                                <div>
                                    <div class="px-1 mt-2 bg-success text-bg-success rounded mb-2">
                                        <h4>Pengajuan ini telah Selesai</h4>
                                    </div>
                                </div>
                            @endif
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table>
                                        <tr>
                                            <td colspan="2" class="fw-bold" style="min-width: 150px">1. Layanan : {{ $appreq->permitwork->name_permit }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">2. Nama Pemohon</td>
                                            <td>: {{ $appreq->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">3. Nama Perusahaan</td>
                                            <td>: {{ $appreq->company->name_company }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">4. Catatan Pemohon</td>
                                            @if ($appreq->notes == null)
                                                <td>: Tidak Ada Catatan</td>
                                            @else
                                                <td>: {!! $appreq->notes !!}</td>
                                            @endif
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table>
                                        <tr>
                                            <td class="fw-bold">5. Tanggal Submit</td>
                                            <td>: {{ Carbon\Carbon::parse($appreq->date_submitted)->translatedFormat('d/m/Y H:i') }} Wib</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">6. Tanggal Disposisi</td>
                                            @if ($appreq->date_disposisi)
                                                <td>: {{ Carbon\Carbon::parse($appreq->date_disposisi)->translatedFormat('d/m/Y H:i') }} Wib
                                                    <span class="badge rounded-pill text-bg-warning">oleh
                                                        {{ $user_disposisi['name'] }}</span>
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">7. Tanggal Proses</td>
                                            @if ($appreq->date_processed != null)
                                                <td>: {{ Carbon\Carbon::parse($appreq->date_processed)->translatedFormat('d/m/Y H:i') }} Wib
                                                    <span class="badge rounded-pill text-bg-warning">oleh
                                                        {{ $user_processed['name'] }}</span>
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">8. Tanggal Perbaikan</td>
                                            @if ($appreq->date_revision != null)
                                                <td>: {{ Carbon\Carbon::parse($appreq->date_revision)->translatedFormat('d/m/Y H:i') }} Wib
                                                    <span class="badge rounded-pill text-bg-warning">oleh
                                                        {{ $user_revision['name'] }}</span>
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">9. Tanggal Selesai</td>
                                            @if ($appreq->date_finished != null)
                                                <td>: {{ Carbon\Carbon::parse($appreq->date_finished)->translatedFormat('d/m/Y H:i') }} Wib
                                                    <span class="badge rounded-pill text-bg-warning">oleh
                                                        {{ $user_finished['name'] }}</span>
                                                </td>
                                            @endif
                                        </tr>
                                        @if ($appreq->date_rejected != null)
                                            <tr>
                                                <td class="fw-bold">Tanggal Ditolak</td>
                                                <td>: {{ Carbon\Carbon::parse($appreq->date_rejected)->translatedFormat('d/m/Y H:i') }} Wib
                                                    <span class="badge rounded-pill text-bg-warning">oleh
                                                        {{ $user_rejected['name'] }}</span>
                                                </td>
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
                                                    @if (Auth::user()->role != 'superadmin')
                                                        @if ($appreq->stat_id == 2 || $appreq->stat_id == 3 || $appreq->stat_id == 4)
                                                            <button
                                                                x-on:click="
                                                open = !open;
                                                document.getElementById('file_uploadd').innerHTML = 'Klik Untuk Upload Berkas...';
                                                $wire.file_upload = '';
                                                "
                                                                class="btn btn-sm btn-success"><i class="bi bi-reply"></i>
                                                                Balas</button>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div x-show="open" class="mb-3" x-transition @click.outside="open = false">
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
                                                                        Pilih berkas
                                                                    </div>
                                                                    <small>Format : pdf,doc,docx,xls,xlsx,jpeg,jpg,zip,rar <br> Size Satu File Max 10MB</small>
                                                                    <input style="z-index: -22;" x-on:change="files = Object.values($event.target.files)" x-ref="upload"
                                                                        wire:model.live="file_upload" type="file" class="custom-file-input d-none @error('file_upload') is-invalid @enderror"
                                                                        id="file_upload" multiple="true">
                                                                </div>
                                                                @error('file_upload')
                                                                    <div id="file-upload" x-init="setTimeout(() => document.getElementById('file-upload').remove(), 4000)" class="alert alert-danger">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                                @error('file_upload.*')
                                                                    <div id="file-uploadd" x-init="setTimeout(() => document.getElementById('file-uploadd').remove(), 4000)" class="alert alert-danger">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div wire:loading wire:target="file_upload" class="bg-warning px-2 rounded mb-2">Tunggu, sedang memeriksa file...</div>
                                                            <div class="mb-2" x-show="uploading">
                                                                <div class="progress" role="progressbar" aria-label="Basic example" :aria-valuenow="progress" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                    <div class="progress-bar" :style="{ width: progress + '%' }"></div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2" wire:loading.remove>
                                                                <input wire:model="desc" id="desc" type="hidden" name="desc">
                                                                <trix-editor input="desc"></trix-editor>
                                                                @error('desc')
                                                                    <div class="alert alert-danger">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <button x-on:click="open = false" type="submit" class="btn btn-success" wire:loading.remove wire:loading.attr="disabled"
                                                                wire:target="file_upload">
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
                                                        <div wire:key="{{ $c->id }}" class="px-3 rounded {{ $c->user->role != 'pemohon' ? 'text-end bg-body-secondary' : '' }}">
                                                            <div class="py-2 mb-2">
                                                                <div class="d-flex flex-row-reverse">
                                                                    <i class="bi bi-clock-history mx-1" style="font-size: 12px">
                                                                        {{ Carbon\Carbon::parse($c->created_at)->translatedFormat('d/m/Y H:i') }} Wib</i>
                                                                    @if ($c->user->role != 'pemohon')
                                                                        <i class="bi bi-eye mx-1" style="font-size: 12px"> {{ $c->viewed ? 'Sudah Dibaca' : 'Belum Dibaca' }}</i>
                                                                    @endif
                                                                    @if ($c->viewed == 0 && $c->user_id == 1)
                                                                        <i x-data="{ cores: false }" class="bi bi-trash filehover position-relative mx-1" @click="cores = true">
                                                                            <div x-show="cores" x-init="setTimeout(() => cores = false, 1000)" @click.outside="cores = false"
                                                                                style="width: 80px; z-index: 99; cursor: pointer" class="position-absolute top-0 end-0 bg-warning rounded px-2">
                                                                                <span @click="cores = false" wire:click="deletePesan({{ $c->id }})">Ya,
                                                                                    hapus</span>
                                                                            </div>
                                                                        </i>
                                                                    @endif
                                                                </div>
                                                                <div>
                                                                    <span class="{{ $c->user->role != 'pemohon' ? 'bg-success' : 'bg-primary' }} text-white px-2 rounded">Pengirim :
                                                                        {{ Auth::id() == $c->user->id ? 'Saya' : $c->user->name }}</span>
                                                                    <br>
                                                                    {!! $c->desc !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between mb-2 pt-3">
                                                <h4>Daftar Berkas File</h4>
                                            </div>
                                            <div class="d-flex mb-3" x-data="{ persyaratan: false }">
                                                <input wire:model.live.debounce="search_docs" style="width: 180px" type="text" class="form-control form-control-sm"
                                                    placeholder="Cari Nama Berkas">
                                                <button wire:click="resetSearchDocs" class="btn btn-sm btn-warning me-2"><i class="bi bi-x"></i></button>
                                                <button @click="persyaratan = true" class="btn btn-sm btn-success me-1" type="button"><i class="bi bi-file-text"></i> Daftar Persyaratan</button>
                                                <div x-show="persyaratan" class="overlay"></div>
                                                <div x-show="persyaratan" x-transition @click.outside="persyaratan = false" class="position-fixed p-3"
                                                    style="z-index: 10000; margin: auto; top: 0; right: 0; bottom: 0; left: 0">
                                                    <div class="alert alert-danger text-center">
                                                        <p>
                                                            <span class="fw-bold">Nama Layanan : {{ $appreq->permitwork->name_permit }}</span><br>
                                                            <span class="fw-bold">Persyaratan:</span><br>
                                                            {!! $appreq->permitwork->desc_permit !!}
                                                        </p>
                                                        <button @click="persyaratan = false" class="btn btn-sm btn-warning">Tutup Panduan</button>
                                                    </div>
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
                                                        <li class="list-group-item" x-data="{ docc: false }">
                                                            {{ $d->name_doc }} <br>
                                                            @if ($d->type_doc == 'Ajuan')
                                                                <i class="bi bi-clock-history me-1" style="font-size: 12px">
                                                                    {{ Carbon\Carbon::parse($d->created_at)->translatedFormat('d/m/Y H:i') }} Wib
                                                                </i>
                                                            @else
                                                                <i class="bi bi-clock-history me-1" style="font-size: 12px">
                                                                    {{ Carbon\Carbon::parse($d->created_at)->diffForHumans() }} Wib
                                                                </i>
                                                            @endif
                                                            <div>
                                                                <div class="badge text-bg-success me-2 py-2">
                                                                    Berkas : {{ $d->type_doc }}
                                                                </div>
                                                                <a class="btn btn-sm btn-success" href="{{ url('storage/file_doc/' . $d->file_name) }}" target="_blank"><i
                                                                        class="bi bi-download"></i></a>
                                                                @if (substr(strtolower($d->file_name), -3) == 'jpg' || substr(strtolower($d->file_name), -4) == 'jpeg')
                                                                    <a class="btn btn-sm btn-success" href="{{ url('storage/file_doc/' . $d->file_name) }}" data-fancybox
                                                                        data-caption="{{ $d->name_doc }}">
                                                                        <i class="bi bi-images"></i>
                                                                    </a>
                                                                @endif

                                                            </div>
                                                            <div class="position-relative">
                                                                @if (Auth::user()->role != 'pemohon' && $d->type_doc == 'By Operator' && $appreq->stat_id != 6)
                                                                    <a class="btn btn-danger btn-sm" @click="docc = true">
                                                                        <i class="bi bi-trash"></i>
                                                                    </a>
                                                                    <div @click="docc= false" x-show="docc" @click.outside="docc= false" class="position-absolute top-0 bg-warning rounded px-2"
                                                                        style="z-index: 99; cursor: pointer; width: 80px">
                                                                        <span wire:click="deleteDoc({{ $d->id }})">Ya, hapus</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="float-end">
                                                            </div>
                                                        </li>
                                                    </div>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                @if ($appreq->stat_id == 5)
                                    <div class="my-2 d-grid mt-5" x-data="{ open: false }">
                                        <button @click="open = true" type="button" class="btn btn-danger">
                                            <i class="bi bi-trash"></i> Menghapus Pengajuan
                                        </button>
                                        <div x-show="open" @click.outside="open = false" class="overlay"></div>
                                        <div x-show="open" @click.away="open = false" x-transition:enter-start="modal-hapus-in" x-transition:leave-end="modal-hapus-out" class="modal-hapus">
                                            <div class="alert alert-danger text-center">
                                                Seluruh Percakapan dan Dokumen Akan Terhapus Secara Permanen, Apakah Anda Yakin Menghapus Pengajuan Ini? <br>
                                                <button class="btn btn-sm btn-danger" wire:click="deleteAppreq"><i class="bi bi-trash"></i> Hapus Pengajuan</button>
                                                <button class="btn btn-sm btn-warning" @click="open = false">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
        Fancybox.bind("[data-fancybox]", {
            closeClickOutside: true,
            clickOutside: 'close'
        });
    </script>
@endscript
