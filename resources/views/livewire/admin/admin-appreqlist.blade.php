<main class="app-main">
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
                            <h3 class="card-title">Daftar Pengajuan</h3><br>
                            <span class="bg-primary text-white px-2 rounded">Status : {{ $stat->desc_stat }}</span>
                            <div class="card-tools">
                                <div class="input-group" x-data="{ search: '' }">
                                    <input wire:model.live.debounce="search" x-model="search" type="text" name="search" class="form-control form-control-sm float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button wire:click="resetSearch" type="submit" class="btn btn-warning">
                                            <i class="bi bi-x-square-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <div class="mb-2" x-data="{ show: false }">
                                <span @click="show = !show" class="btn btn-sm btn-warning"><i class="bi bi-question-circle"></i> Panduan</span>
                                <div x-show="show" x-transition class="mt-1" @click.outside="show = false">
                                    * Klik Detail untuk melihat detail pengajuan<br>
                                    * Diajukan = Status saat pengajuan pertama kali diajukan oleh Pemohon<br>
                                    * Disposisi = Status saat pengajuan diterima/dibuka oleh Admin Disposisi<br>
                                    * Diproses = Status saat pengajuan diterima/dibuka oleh Admin Verifikator/Validator<br>
                                    * Perbaikan = Status Perbaikan Pengajuan, Pemohon bisa memakai Fitur Korespondensi<br>
                                    * Dibatalkan = Status Penangguhan atau Pembatalan atau Kesalahan<br>
                                    * Selesai = Status Penangguhan atau Pembatalan atau Kesalahan<br>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-lg-row float-end">
                                <button @click="$dispatch('notify', { message: 'Refresh Daftar Pengajuan Berhasil' })" class="btn btn-warning me-2 mb-2" type="button" x-on:click="$wire.$refresh()"
                                    wire:loading.attr="disabled">
                                    <i class="bi bi-arrow-repeat"></i> Refresh
                                </button>
                            </div>
                            <div class="d-flex flex-column flex-lg-row">
                                <div class="me-2 mb-2">
                                    <select wire:model.live="pagelength" class="form-select" aria-label="Default select example" id="pagelength">
                                        <option value="">All</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                                <div class="me-2 mb-2">
                                    <select wire:model.live="company_id" class="form-select" aria-label="Default select example" id="tertaut_count">
                                        <option value="">Pilih Perusahaan</option>
                                        @foreach ($companies as $com)
                                            <option value="{{ $com->id }}">{{ $com->name_company }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Layanan | Kode Verifikasi</th>
                                        <th>Data Pemohon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Modal -->
                                    @foreach ($appreqs as $item)
                                        <?php
                                        $correspondences = [];
                                        foreach ($item->correspondences as $correspondence) {
                                            // sender 0 pemohon
                                            if ($correspondence->sender == 1 && $correspondence->viewed == 0) {
                                                $correspondences[] = $correspondence->name_doc;
                                            }
                                        }
                                        $docs = [];
                                        foreach ($item->docs as $doc) {
                                            if ($doc->sender == 1 && $doc->viewed == 0) {
                                                $docs[] = $doc->name_doc;
                                            }
                                        }
                                        ?>

                                        <tr class="align-middle" x-data="{ open: false }">
                                            <td>{{ ($appreqs->currentpage() - 1) * $appreqs->perpage() + $loop->index + 1 }}</td>
                                            <td>
                                                {{ $item->permitwork->name_permit }} <br>
                                                <span class="bg-warning px-2 rounded">{{ $item->ver_code }}</span>
                                                <div class="mt-1">
                                                    <a wire:navigate href="{{ url('admin/appreqdetail/' . $item->id) }}" class="btn btn-sm btn-success mb-1"><i class="bi bi-eye"></i> Detail</a>
                                                    <span class="btn btn-sm btn-success mb-1">Status :
                                                        {{ $item->stat->desc_stat . ' ' . Carbon\Carbon::parse($item->date_submitted)->DiffForHumans() }}
                                                    </span><br>
                                                    @if (count($correspondences) > 0 || count($docs) > 0)
                                                        <span class="btn btn-sm btn-danger mb-1">
                                                            {{ count($correspondences) }} Pesan Belum Dibaca
                                                        </span>
                                                        <span class="btn btn-sm btn-danger mb-1">
                                                            {{ count($docs) }} File Baru Ditambahkan
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                {{ $item->user->name }} <br>
                                                {{ $item->company->name_company }} <br>
                                                <a href="#" class="btn btn-success btn-sm"><i class="bi bi-whatsapp"></i> {{ $item->user->nohp }}</a></br>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $appreqs->links() }}
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main>
@script
    <script>
        $wire.on('trix-blur', (event) => {
            var trix = document.getElementById("desc_permit");
            $wire.desc_permit = trix.getAttribute('value');
        });
        $wire.on('permitwork-deleted', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                element.className += " text-bg-success";
                document.getElementById('pesan').innerHTML = event.message;
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 5000);
        });
        $wire.on('permitwork-created', (event) => {
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
        $wire.on('permitwork-updated', (event) => {
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
        $wire.on('permitwork-error', (event) => {
            var element = document.getElementById('liveToast');
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                element.className += " text-bg-danger";
                document.getElementById('pesan').innerHTML = event.message;
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 5000);
        });
    </script>
@endscript
