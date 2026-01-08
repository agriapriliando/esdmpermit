<div class="container">
    <div class="d-flex justify-content-between">
        <h3>Export Data Profile ke Excel</h3>
        <a href="{{ route('home') }}" class="btn btn-primary">Kembali</a>
    </div>

    <div>
        <p>Data export adalah data terakhir / terbaru.</p>
        <div class="mb-3">
            <label class="form-label fw-bold">Pilih Data untuk Export:</label>
            <div class="mb-2">
                <button wire:click="selectAll" type="button" class="btn btn-sm btn-outline-primary">
                    Pilih Semua
                </button>
                <button wire:click="deselectAll" type="button" class="btn btn-sm btn-outline-danger">
                    Hapus Semua
                </button>
            </div>

            <div class="d-flex flex-wrap gap-3">
                @foreach ($pilihan as $pil)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="{{ $pil }}" wire:model="selectedColumns" id="col_{{ Str::slug($pil, '_') }}">
                        <label class="form-check-label" for="col_{{ Str::slug($pil, '_') }}">
                            {{ $pil }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Pilih Perusahaan:</label>
            <div class="mb-2">
                <button wire:click="selectAllPerusahaan" type="button" class="btn btn-sm btn-outline-primary">
                    Pilih Semua
                </button>
                <button wire:click="deselectAllPerusahaan" type="button" class="btn btn-sm btn-outline-danger">
                    Hapus Semua
                </button>
            </div>
            <div class="d-flex flex-wrap gap-3">
                @foreach ($perusahaanList as $perusahaan)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="{{ $perusahaan }}" wire:model="selectedPerusahaan"
                            id="perusahaan_{{ \Illuminate\Support\Str::slug($perusahaan, '_') }}">
                        <label class="form-check-label" for="perusahaan_{{ \Illuminate\Support\Str::slug($perusahaan, '_') }}">
                            {{ $perusahaan }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-3">
            <button wire:click="export" type="button" class="btn btn-success">
                Export ke Excel
            </button>
        </div>

        @if (session()->has('error'))
            <div class="alert alert-danger mt-2">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>

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
