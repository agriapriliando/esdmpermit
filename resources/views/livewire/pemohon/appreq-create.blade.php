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
                        <div class="card-body" x-data="{ pass: false, password: '' }">
                            <form wire:submit.prevent="save">
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
                                        <div class="alert alert-success">
                                            <p class="fw-bold">Deskripsi Layanan</p>
                                            {!! $permitwork_desc[0] !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-2">
                                    <label for="file_upload">Upload Berkas</label>
                                    <div class="form-group mb-2">
                                        <div class="custom-file">
                                            <input wire:model.live="file_upload" type="file" class="custom-file-input" id="file_upload" multiple>
                                            <label class="custom-file-label" for="file_upload">Pilih Berkas</label>
                                        </div>
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
                                <div class="mb-2 d-grid">
                                    <button class="btn btn-success" type="submit" wire:loading.attr="disabled" wire:target="file_upload">Ajukan Permohonan Layanan</button>
                                </div>
                            </form>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
    @push('styles')
        {{-- select2 --}}
        <link rel="stylesheet" href="{{ asset('') }}assets/select2/select2.min.css">
        <link rel="stylesheet" href="{{ asset('') }}assets/select2/select2-bootstrap4.min.css">
        {{-- select2 --}}
    @endpush
    @push('scripts')
        <script src="{{ asset('') }}assets/js/jquery-3.3.1.min.js"></script>
        <script src="{{ asset('') }}assets/select2/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#permitwork_id').select2({
                    theme: "bootstrap4",
                }).on('change', function(event) {
                    // var data = $('#penyewa').select2("val");
                    console.log(event.target.value);
                    @this.set('permitwork_id', event.target.value);
                });

            });
        </script>
    @endpush
</main>
@script
    <script>
        $wire.on('appreq-created', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 5000);
        });
    </script>
@endscript
