<?php

namespace App\Livewire;

use App\Exports\ProfilesExport;
use App\Models\Bbc;
use App\Models\Handak;
use App\Models\Iui;
use App\Models\Iuran;
use App\Models\Kim;
use App\Models\Ktt;
use App\Models\Le;
use App\Models\Pa;
use App\Models\Pelabuhan;
use App\Models\Pl;
use App\Models\Profile;
use App\Models\Reportmonth;
use App\Models\Rippm;
use App\Models\RippmDetail;
use App\Models\Rkabop;
use App\Models\RkabopPeralatan;
use App\Models\Rpt;
use App\Models\Stk;
use App\Models\Tb;
use App\Models\Triwulan;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ExportProfiles extends Component
{
    public $pilihan = [];
    public $selectedColumns = [];

    public $perusahaanList = [];       // semua perusahaan unik
    public $selectedPerusahaan = [];

    public $mapping = [];

    // mapping pilihan ke model/relasi + kolom
    public function _mappingConfig()
    {
        return [
            'Profile' => [
                'type' => 'model',
                'columns' => [
                    'kabupaten_kota',
                    'kecamatan',
                    'desa_kelurahan',
                    'luas_ha',
                    'tahapan_iup',
                    'komoditas',
                    'nomor_induk_berusaha_nib',
                    'nomor_npwp',
                    'status_npwp',
                    'jenis_izin',
                    'nomor_sk_izin',
                    'tgl_terbit_izin',
                    'tgl_berakhir_izin',
                    'alamat_perusahaan_berdasarkan_sk_izin',
                    'nama_direktur_sesuai_sk_izin',
                    'dewan_direksi_bod',
                    'modal_kerja',
                    'nama_pic',
                    'no_hp_pic',
                    'email_resmi_perusahaan',
                    'nib_email_oss',
                    'nib_nomor_hp_oss',
                    'keterangan',
                ],
            ],
            'Iuran Tetap Tahunan' => [
                'type' => 'relation',
                'relation' => 'latestIuran',
                'columns' => array_values(array_diff((new Iuran())->getFillable(), ['profile_id'])),
            ],
            'Izin Usaha Industri (IUI)' => [
                'type' => 'relation',
                'relation' => 'latestIui',
                'columns' => array_values(array_diff((new Iui())->getFillable(), ['profile_id'])),
            ],
            'Kepala Teknik Tambang (KTT)' => [
                'type' => 'relation',
                'relation' => 'latestKtt',
                'columns' => array_values(array_diff((new Ktt())->getFillable(), ['profile_id'])),
            ],
            'Kartu Izin Meledakan (KIM)' => [
                'type' => 'relation',
                'relation' => 'latestKim',
                'columns' => array_values(array_diff((new Kim())->getFillable(), ['profile_id'])),
            ],
            'Gudang Bahan Peledak (Handak)' => [
                'type' => 'relation',
                'relation' => 'latestHandak',
                'columns' => array_values(array_diff((new Handak())->getFillable(), ['profile_id'])),
            ],
            'Tangki BBC' => [
                'type' => 'relation',
                'relation' => 'latestBbc',
                'columns' => array_values(array_diff((new Bbc())->getFillable(), ['profile_id'])),
            ],
            'Laporan Eksplorasi' => [
                'type' => 'relation',
                'relation' => 'latestLe',
                'columns' => array_values(array_diff((new Le())->getFillable(), ['profile_id'])),
            ],
            'Pelabuhan' => [
                'type' => 'relation',
                'relation' => 'latestPelabuhan',
                'columns' => array_values(array_diff((new Pelabuhan())->getFillable(), ['profile_id'])),
            ],
            'Persetujuan Lingkungan' => [
                'type' => 'relation',
                'relation' => 'latestPl',
                'columns' => array_values(array_diff((new Pl())->getFillable(), ['profile_id'])),
            ],
            'Project Area' => [
                'type' => 'relation',
                'relation' => 'latestPa',
                'columns' => array_values(array_diff((new Pa())->getFillable(), ['profile_id'])),
            ],
            'Rencana Pascatambang RPT' => [
                'type' => 'relation',
                'relation' => 'latestRpt',
                'columns' => array_values(array_diff((new Rpt())->getFillable(), ['profile_id'])),
            ],
            'Studi Kelayakan Tekno Ekonomi' => [
                'type' => 'relation',
                'relation' => 'latestStk',
                'columns' => array_values(array_diff((new Stk())->getFillable(), ['profile_id'])),
            ],
            'Tanda Batas' => [
                'type' => 'relation',
                'relation' => 'latestTb',
                'columns' => array_values(array_diff((new Tb())->getFillable(), ['profile_id'])),
            ],
            'Laporan Bulanan' => [
                'type' => 'relation',
                'relation' => 'latestReportmonth',
                'columns' => array_values(array_diff((new Reportmonth())->getFillable(), ['profile_id'])),
            ],
            'Laporan Triwulan' => [
                'type' => 'relation',
                'relation' => 'latestTriwulan',
                'columns' => array_values(array_diff((new Triwulan())->getFillable(), ['profile_id'])),
            ],
            'RIPPM' => [
                'type' => 'relation',
                'relation' => 'latestRippm',
                'columns' => array_values(
                    array_diff((new Rippm())->getFillable(), ['profile_id'])
                ),
            ],
            'RIPPM Detail' => [
                'type' => 'relation',
                'relation' => 'latestRippmDetails', // ini kita handle khusus di atas
                'columns' => array_values(
                    array_diff((new RippmDetail())->getFillable(), ['profile_id', 'rippm_id'])
                ),
            ],
            'RKABOP' => [
                'type' => 'relation',
                'relation' => 'latestRkabop',
                'columns' => array_values(
                    array_diff((new Rkabop())->getFillable(), ['profile_id'])
                ),
            ],

            'RKABOP Peralatan' => [
                'type' => 'relation',
                'relation' => 'latestRkabopPeralatans', // penanda khusus, handle manual di export
                'columns' => array_values(
                    array_diff((new RkabopPeralatan())->getFillable(), ['profile_id', 'rkabop_id'])
                ),
            ],
        ];
    }


    public function mount()
    {
        $this->mapping = $this->_mappingConfig();
        // mengambil key dari array, dijadikan array pilihan
        $this->pilihan = array_keys($this->mapping);

        // ambil daftar nama perusahaan unik dan urutkan
        $this->perusahaanList = Profile::select('nama_pemegang_perizinan')
            ->distinct()
            ->orderBy('nama_pemegang_perizinan', 'asc')
            ->pluck('nama_pemegang_perizinan')
            ->toArray();
    }

    public function selectAll()
    {
        $this->selectedColumns = $this->pilihan;
    }
    public function deselectAll()
    {
        $this->selectedColumns = [];
    }
    public function selectAllPerusahaan()
    {
        $this->selectedPerusahaan = $this->perusahaanList;
    }
    public function deselectAllPerusahaan()
    {
        $this->selectedPerusahaan = [];
    }


    public function export()
    {
        if (empty($this->selectedColumns)) {
            session()->flash('error', 'Pilih minimal satu kolom.');
            return;
        }

        return Excel::download(
            new ProfilesExport($this->selectedColumns, $this->mapping, $this->selectedPerusahaan),
            'export.xlsx'
        );
    }

    public function render()
    {
        return view('livewire.export-profiles');
    }
}
