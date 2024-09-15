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
                            Daftar Topik
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
                            <h3 class="card-title">Daftar Topik Koresponden</h3>
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
                                <a wire:click="resetForm" href="#edit" class="btn btn-success me-2 mb-2"><i class="bi bi-plus"></i> Tambah</a>
                                <button @click="$dispatch('notify', { message: 'Refresh Daftar Topik Koresponden Berhasil' })" class="btn btn-warning me-2 mb-2" type="button"
                                    x-on:click="$wire.$refresh()" wire:loading.attr="disabled">
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
                                    <select wire:model.live="tertaut_count" class="form-select" aria-label="Default select example" id="tertaut_count">
                                        <option value="">All</option>
                                        <option value="A">Topik Tertaut</option>
                                        <option value="B">Topik : 0</option>
                                    </select>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama Layanan</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th style="width: 40px">Label</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Modal -->

                                    @foreach ($topics as $item)
                                        <tr class="align-middle" x-data="{ open: false }">
                                            <td>{{ ($topics->currentpage() - 1) * $topics->perpage() + $loop->index + 1 }}</td>
                                            <td>{{ $item->name_topic }}<br> <span class="badge text-bg-success">Permohonan : {{ $item->correspondences_count }} Data</span></td>
                                            <td>{!! Str::limit($item->desc_topic, 40, '...') !!}</td>
                                            <td>
                                                <div class="badge text-bg-success">{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') }} Wib</div><br>
                                                <div class="badge text-bg-success">{{ Carbon\Carbon::parse($item->updated_at)->translatedFormat('d F Y H:i') }} Wib</div>
                                            </td>
                                            <td class="d-flex">
                                                <a wire:click="edit({{ $item->id }})" href="#edit" class="btn btn-sm btn-warning me-2">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button @click="open = true" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <div x-show="open" @click.outside="open = false" class="overlay"></div>
                                                <div x-show="open" @click.away="open = false" x-transition:enter-start="modal-hapus-in" x-transition:leave-end="modal-hapus-out" class="modal-hapus">
                                                    <div class="alert alert-danger text-center">
                                                        {{ $item->correspondences_count > 0 ? 'Topik tidak bisa dihapus, Topik ini telah tertaut dengan data Korespondensi' : 'Yakin ingin menghapus Topik?' }}
                                                        <p class="fw-bold">{{ $item->name_topic }}</p>
                                                        @if ($item->correspondences_count == 0)
                                                            <button wire:click.prevent="delete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus!!</button>
                                                        @endif
                                                        <button class="btn btn-sm btn-warning">Batal</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $topics->links() }}
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
                <div class="col-md-8" id="edit">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="card-tools">
                                <button wire:click="resetForm" class="btn btn-sm btn-warning"><i class="bi bi-arrow-counterclockwise"></i> Reset Form</button>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body" x-data="{ pass: false, password: '' }">
                            <form wire:submit.prevent="save({{ $id }})">
                                @if ($title == 'Edit Topik')
                                    <div class="mb-2 alert alert-danger">* PERINGATAN, melakukan perubahan Nama Topik ini berarti merubah seluruh Korespondensi (Topik) yang tertaut
                                    </div>
                                @endif
                                <div class="mb-2">
                                    <label for="name_topic">Nama Topik</label>
                                    <input wire:model="name_topic" type="text" class="form-control @error('name_topic') is-invalid @enderror" id="name_topic">
                                    @error('name_topic')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label>Deskripsi Topik</label>
                                    <input class="d-none" wire:model="desc_topic" id="desc_topic" type="hidden" name="desc_topic" value="{{ $desc_topic ?? '' }}" autocomplete="off">
                                    <trix-editor input="desc_topic" class="@error('desc_topic') is-invalid @enderror"></trix-editor>
                                    @error('desc_topic')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2 d-grid">
                                    <button class="btn btn-success" type="submit" wire:loading.attr="disabled">{{ $title }}</button>
                                </div>
                            </form>
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
            var trix = document.getElementById("desc_topic");
            $wire.desc_topic = trix.getAttribute('value');
            console.log(trix.getAttribute('value'));
        });
        $wire.on('topic-deleted', (event) => {
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
        $wire.on('topic-created', (event) => {
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
        $wire.on('topic-updated', (event) => {
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
        $wire.on('topic-error', (event) => {
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
