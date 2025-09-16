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
                            <h3 class="card-title">Daftar Pengajuan {{ request()->is('pengajuan/terbit') ? 'Terbit' : '' }}</h3>
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
                            <div class="mb-2">
                                Panduan : <br>
                                * Klik Detail untuk melihat detail pengajuan<br>
                                * Pengajuan yang telah diproses tidak dapat dihapus/ dibatalkan<br>
                            </div>
                            @session('delete')
                                <div id="alertm" class="alert alert-success alert-dismissible fade show" x-init="setTimeout(() => document.getElementById('alertm').remove(), 3000)" role="alert">
                                    <strong>Pengajuan Berhasil Dihapus / Dibatalkan
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endsession
                            <div class="d-flex flex-column flex-lg-row float-end">
                                <a wire:navigate href="{{ url('create') }}" class="btn btn-success me-2 mb-2"><i class="bi bi-plus"></i> Tambah Pengajuan</a>
                                <button @click="$dispatch('notify', { message: 'Refresh Daftar Pengajuan Berhasil' })" class="btn btn-warning me-2 mb-2" type="button" x-on:click="$wire.$refresh()"
                                    wire:loading.attr="disabled">
                                    <i class="bi bi-arrow-repeat"></i> Refresh
                                </button>
                            </div>
                            <div class="d-flex flex-column flex-lg-row">
                                <div class="me-2 mb-2">
                                    <select wire:model.live="pagelength" class="form-select" id="pagelength">
                                        <option value="">All</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                                <div class="me-2 mb-2 {{ request()->is('pengajuan/terbit') ? 'd-none' : '' }}">
                                    <select wire:model.live="stat_id" class="form-select" id="tertaut_count">
                                        <option value="">All Status</option>
                                        @foreach ($stats as $stat)
                                            <option value="{{ $stat->id }}">{{ $stat->desc_stat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama Layanan</th>
                                        <th>Kode Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Modal -->
                                    @foreach ($appreqs as $item)
                                        <?php
                                        $correspondences = [];
                                        foreach ($item->correspondences as $correspondence) {
                                            // sender 1 dari operator
                                            if ($correspondence->sender == 0 && $correspondence->viewed == 0) {
                                                $correspondences[] = $correspondence->name_doc;
                                            }
                                        }
                                        $docs = [];
                                        foreach ($item->docs as $doc) {
                                            if ($doc->sender == 0 && $doc->viewed == 0) {
                                                $docs[] = $doc->name_doc;
                                            }
                                        }
                                        ?>
                                        <tr class="align-middle" x-data="{ open: false }">
                                            <td>{{ ($appreqs->currentpage() - 1) * $appreqs->perpage() + $loop->index + 1 }}</td>
                                            <td class="">
                                                {{ $item->permitwork->name_permit }}
                                                <div x-data="{ open: false }">
                                                    <a wire:navigate href="{{ route('appreq.detail', $item->ver_code) }}" class="btn btn-sm btn-success mb-1">
                                                        <i class="bi bi-eye"></i> Detail
                                                    </a>
                                                    <span class="btn btn-sm btn-success mb-1">Status :
                                                        {{ $item->stat->desc_stat . ' ' }}
                                                        @if ($item->stat_id == 1)
                                                            {{ Carbon\Carbon::parse($item->date_submitted)->DiffForHumans() }}
                                                        @elseif($item->stat_id == 2)
                                                            {{ Carbon\Carbon::parse($item->date_disposisi)->DiffForHumans() }}
                                                        @elseif($item->stat_id == 3)
                                                            {{ Carbon\Carbon::parse($item->date_processed)->DiffForHumans() }}
                                                        @elseif($item->stat_id == 4)
                                                            {{ Carbon\Carbon::parse($item->date_finished)->DiffForHumans() }}
                                                        @elseif($item->stat_id == 5)
                                                            {{ Carbon\Carbon::parse($item->date_rejected)->DiffForHumans() }}
                                                        @elseif($item->stat_id == 6)
                                                            {{ Carbon\Carbon::parse($item->date_finished)->DiffForHumans() }}
                                                        @endif
                                                    </span>
                                                    @if (count($correspondences) > 0 || count($docs) > 0)
                                                        <span class="btn btn-sm btn-danger mb-1">
                                                            {{ count($correspondences) }} Pesan Belum Dibaca
                                                        </span>
                                                        <span class="btn btn-sm btn-danger mb-1">
                                                            {{ count($docs) }} File Baru Ditambahkan
                                                        </span>
                                                    @endif
                                                    @if ($item->stat_id == 1)
                                                        <button @click="open = true" class="btn btn-sm btn-danger mb-1">
                                                            <i class="bi bi-trash"></i> Hapus Pengajuan
                                                        </button>
                                                        <div x-show="open" @click.outside="open = false" class="overlay"></div>
                                                        <div x-show="open" @click.away="open = false" x-transition:enter-start="modal-hapus-in" x-transition:leave-end="modal-hapus-out"
                                                            class="modal-hapus">
                                                            <div class="alert alert-danger text-center">Yakin ingin menghapus/ membatalkan pengajuan ini?
                                                                <p class="fw-bold">{{ $item->name }}</p>
                                                                <button @click="$dispatch('notify', { message: 'Pengajuan Berhasil Dihapus..' })" wire:click.prevent="delete('{{ $item->ver_code }}')"
                                                                    class="btn btn-sm btn-danger">Hapus!!</button>
                                                                <button @click="open = false" class="btn btn-sm btn-warning">Batal</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $item->ver_code }}</td>
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
