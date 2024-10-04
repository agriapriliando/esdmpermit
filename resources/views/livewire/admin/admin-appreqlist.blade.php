<main class="app-main">
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-12">
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
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Daftar Permohonan
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
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Permohonan Layanan</h3>
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
                            <div class="d-flex flex-column flex-lg-row float-end">
                                <button @click="$dispatch('notify', { message: 'Refresh Daftar Layanan Berhasil' })" class="btn btn-warning me-2 mb-2" type="button" x-on:click="$wire.$refresh()"
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
                                    <select wire:model.live="stat_id" class="form-select" aria-label="Default select example" id="tertaut_count">
                                        <option value="">All Status</option>
                                        @foreach ($stats as $stat)
                                            <option value="{{ $stat->id }}">{{ $stat->name_stat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama Layanan</th>
                                        <th>Pemohon</th>
                                        <th>VerCode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Modal -->

                                    @foreach ($appreqs as $item)
                                        <tr class="align-middle" x-data="{ open: false }">
                                            <td>{{ ($appreqs->currentpage() - 1) * $appreqs->perpage() + $loop->index + 1 }}</td>
                                            <td>{{ $item->permitwork->name_permit }}
                                                <a wire:navigate href="{{ url('admin/appreqdetail/' . $item->id) }}" class="btn btn-sm btn-success ms-1"><i class="bi bi-eye"></i></a>
                                                <div class="text-decoration-underline">Status : {{ $item->stat->name_stat }}</div>
                                            </td>
                                            <td>
                                                {{ $item->user->name }} </br> {{ $item->company->name_company }}
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
