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
                <div class="card-body" x-data="{
                    copyTable() {
                        let rows = Array.from(document.querySelectorAll('#tabel-perusahaan tr'));
                        let text = rows.map(row => {
                            // Ambil hanya data dari <td> (atau <th> kalau mau)
                            return Array.from(row.querySelectorAll('th,td'))
                                .map(cell => cell.innerText)
                                .join('\t'); // Tab sebagai pemisah kolom
                        }).join('\n'); // Enter sebagai pemisah baris
                
                        // Copy ke clipboard
                        navigator.clipboard.writeText(text).then(() => {
                            alert('Data tabel berhasil disalin!');
                        });
                    },
                }">
                    @session('error')
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endsession
                    <!-- Actions-->
                    <div class="d-flex flex-wrap align-items-center mb-3 gap-1">
                        <button class="btn btn-sm btn-outline-secondary text-body me-2 mb-2" type="button" wire:click="resetFilters"><i class="ri-refresh-line align-bottom"></i> Reset</button>
                        <div class="bg-light rounded px-3 py-1 me-2 mb-2">
                            <input wire:model.live="search" class="form-control form-control-sm border-0 bg-transparent px-0 py-2 me-5 fw-bolder" placeholder="Cari Nama Perusahaan">
                        </div>
                        <div style="max-width: 180px" class="bg-light rounded px-3 py-1 me-2 mb-2">
                            <input wire:model.live="kabupaten_kotaSearch" class="form-control form-control-sm border-0 bg-transparent px-0 py-2 me-5 fw-bolder" list="kabupatenKotaList"
                                placeholder="==Kabupaten/Kota==">

                            <datalist id="kabupatenKotaList">
                                @foreach ($kabupaten_kota as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        <div style="max-width: 180px" class="bg-light rounded px-3 py-1 me-2 mb-2">
                            <input wire:model.live="komoditasSearch" class="form-control form-control-sm border-0 bg-transparent px-0 py-2 me-5 fw-bolder" list="komoditasList"
                                placeholder="==Komoditas==">
                            <datalist id="komoditasList">
                                @foreach ($komoditas as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        <select style="max-width: 120px" wire:model.live="jenis_izin" class="form-select form-control-sm me-2 mb-2 rounded">
                            <option value="">Semua Izin</option>
                            <option value="IUP">IUP</option>
                            <option value="SIPB">SIPB</option>
                            <option value="IPP">IPP</option>
                            <option value="IUJP">IUJP</option>
                        </select>
                        <select style="max-width: 120px" wire:model.live="perPage" class="form-select form-control-sm me-2 mb-2 rounded">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="{{ $profiles->total() }}">{{ $profiles->total() }} All</option>
                        </select>
                        <a href="{{ route('exports.view') }}" class="btn btn-sm btn-outline-secondary text-body me-2 mb-2"><i class="ri-file-excel-2-line align-bottom"></i> Excel</a>
                        <a href="{{ route('profile.create') }}" class="btn btn-sm btn-primary text-white me-2 mb-2"><i class="ri-add-circle-line align-bottom"></i> Tambah</a>
                        <button class="d-none btn btn-success text-white" @click="copyTable">Copy Data</button>
                    </div>
                    <!-- /Actions-->

                    <!-- Table-->
                    <div class="table-responsive">
                        <div>
                            {{ $profiles->links('custom-pagination') }}
                        </div>
                        <table class="table m-0 table-striped" id="tabel-perusahaan">
                            <thead>
                                <tr>
                                    <th width="1">No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Komoditas</th>
                                    <th>
                                        <div class="">
                                            <label class="form-check-label" for="checkDefault">
                                                <i class="ri-delete-bin-line" style="font-size: 20px"></i>
                                            </label>
                                            <input wire:model.live="toogleDelete" type="checkbox" style="width: 20px; height: 20px;" id="checkDefault">
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($profiles as $item)
                                    <tr>
                                        <td>
                                            {{ ($profiles->currentPage() - 1) * $profiles->perPage() + $loop->index + 1 }}
                                        </td>
                                        <td>
                                            <span class="badge text-bg-success">{{ $item->jenis_izin }}</span>
                                            <a href="{{ route('profile.show', $item->id) }}" class="text-decoration-underline text-nowrap text-black">
                                                {{ $item->nama_pemegang_perizinan }}
                                            </a>
                                        </td>
                                        <td>{{ $item->kabupaten_kota }}</td>
                                        <td>{{ $item->komoditas }}</td>
                                        <td>
                                            <div x-data="{ confirmDelete: false }">
                                                <button @click="confirmDelete = true" x-show="!confirmDelete" class="btn btn-sm btn-danger text-white" {{ $toogleDelete ? '' : 'disabled' }}> <i
                                                        class="ri-delete-bin-line"></i></button>
                                                <div x-show="confirmDelete" @click.outside="confirmDelete = false">
                                                    <span @click="confirmDelete = false" wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger text-white">Ya Hapus</span>
                                                    <span class="btn btn-sm btn-secondary" @click="confirmDelete = false">Batal</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-1">
                            {{ $profiles->links('custom-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Tabel Perusahaan-->

    </div>
    <!-- / Top Row Widgets-->
</div>
@script
    <script>
        $wire.on('delete-success', (event) => {
            var element = document.getElementById('liveToast');
            console.log(event.message);
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-warning";
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
