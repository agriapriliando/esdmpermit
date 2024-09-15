<main class="app-main">
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="toast-container position-fixed top-0 start-50 translate-middle-x">
                        <div id="liveToast" class="toast mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto" id="pesan"></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Mengajukan Permohonan
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div>
    <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-md-8" id="edit">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Isian Ajuan Permohonan Layanan</h3>
                            <div class="card-tools">
                            </div>
                        </div> <!-- /.card-header -->
                        @session('message')
                            <div id="alertm" class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                <strong>{{ session('message') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession
                        @session('error')
                            <div id="alertm" class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession
                        <div class="card-body">
                            <form wire:submit.prevent="save">
                                <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false"
                                    x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <div class="mb-2">
                                        <div wire:ignore class="form-group mb-2">
                                            <label for="permitwork_id">Daftar Layanan</label>
                                            <select wire:model="permitwork_id" name="permitwork_id" class="form-control select2" id="permitwork_id" style="width: 100%;">
                                                <option value="">== Pilih ==</option>
                                                @foreach ($permitworks as $a)
                                                    <option value="{{ $a->id }}">{{ $a->name_permit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('permitwork_id')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if ($permitwork_desc)
                                            <p class="fw-bold">Deskripsi Layanan</p>
                                            <p>
                                                {!! $permitwork_desc[0] !!}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="mb-2 {{ $permitwork_desc ? '' : 'd-none' }}">
                                        {{-- <label for="file_upload">Upload Berkas</label> --}}
                                        <div class="form-group mb-2" x-data="{ files: null }">
                                            <div class="custom-file bg-warning p-3 pt-4 rounded" @click="$refs.upload.click()" style="min-height: 70px; z-index:11;"
                                                x-html="files ?
                                                files.map(file => '- '+file.name).join('</br> ')
                                                : 'Klik Untuk Pilih Berkas...'">
                                            </div>
                                            {{-- <label class="custom-file-label m-3" for="file_upload">Pilih Berkas</label><br> --}}
                                            <input style="z-index: -22;" x-on:change="files = Object.values($event.target.files)" x-ref="upload" wire:model.live="file_upload" type="file"
                                                class="custom-file-input d-none" id="file_upload" multiple="true">
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
                                    @if ($file_upload)
                                        <div class="mb-2">
                                            <label for="notes">Catatan - Opsional</label>
                                            <input wire:model="notes" id="notes" type="hidden" name="notes">
                                            <trix-editor input="notes"></trix-editor>
                                        </div>
                                    @endif
                                    <div class="mb-2 d-grid" x-data="{ open: false }">
                                        <button @click="open = true" type="button" class="btn btn-sm btn-success" wire:loading.attr="disabled" wire:target="file_upload">
                                            <i class="bi bi-plus"></i> Ajukan Permohonan
                                        </button>
                                        <div x-show="open" @click.outside="open = false" class="overlay"></div>
                                        <div x-show="open" @click.away="open = false" x-transition:enter-start="modal-hapus-in" x-transition:leave-end="modal-hapus-out" class="modal-hapus">
                                            <div class="alert alert-danger text-center">
                                                Apakah Anda Yakin
                                                <button class="btn btn-sm btn-success" type="submit" wire:loading.attr="disabled" wire:target="file_upload">Ajukan Permohonan Layanan</button>
                                                <button class="btn btn-sm btn-warning">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
    @assets
        {{-- select2 --}}
        <link rel="stylesheet" href="{{ asset('') }}assets/select2/select2.min.css">
        <link rel="stylesheet" href="{{ asset('') }}assets/select2/select2-bootstrap4.min.css">
        {{-- select2 --}}
        <script src="{{ asset('') }}assets/js/jquery-3.3.1.min.js"></script>
        <script src="{{ asset('') }}assets/select2/select2.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    @endassets
</main>
@script
    <script>
        $(document).ready(function() {
            $('#permitwork_id').select2({
                theme: "bootstrap4",
            }).on('change', function(event) {
                // var data = $('#penyewa').select2("val");
                // console.log(event.target.value);
                $wire.$set('permitwork_id', event.target.value);
                // @this.set('permitwork_id', event.target.value);
            });

        });
        $wire.on('trix-blur', (event) => {
            var trix = document.getElementById("notes");
            $wire.notes = trix.getAttribute('value');
        });
        $wire.on('appreq-created', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
                // console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
                bootstrap.Alert.getOrCreateInstance("#alertm").close();
            }, 4000);
        });
    </script>
@endscript
