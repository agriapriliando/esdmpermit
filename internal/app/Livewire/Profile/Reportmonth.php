<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Reportmonth as ModelsReportmonth;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Reportmonth extends Component
{
    public $reports = [];
    public $original = [];

    // field tambah data baru
    public $tahun_laporan;
    public $laporan_keterangan;

    // semua field laporan bulan 1–12
    public $laporan_1_rencana_produksi_utama;
    public $laporan_1_rencana_produksi_sampingan;
    public $laporan_1_realisasi_produksi_utama;
    public $laporan_1_realisasi_produksi_sampingan;
    public $laporan_1_realisasi_penjualan_utama;
    public $laporan_1_realisasi_penjualan_sampingan;

    public $laporan_2_rencana_produksi_utama;
    public $laporan_2_rencana_produksi_sampingan;
    public $laporan_2_realisasi_produksi_utama;
    public $laporan_2_realisasi_produksi_sampingan;
    public $laporan_2_realisasi_penjualan_utama;
    public $laporan_2_realisasi_penjualan_sampingan;

    public $laporan_3_rencana_produksi_utama;
    public $laporan_3_rencana_produksi_sampingan;
    public $laporan_3_realisasi_produksi_utama;
    public $laporan_3_realisasi_produksi_sampingan;
    public $laporan_3_realisasi_penjualan_utama;
    public $laporan_3_realisasi_penjualan_sampingan;

    public $laporan_4_rencana_produksi_utama;
    public $laporan_4_rencana_produksi_sampingan;
    public $laporan_4_realisasi_produksi_utama;
    public $laporan_4_realisasi_produksi_sampingan;
    public $laporan_4_realisasi_penjualan_utama;
    public $laporan_4_realisasi_penjualan_sampingan;

    public $laporan_5_rencana_produksi_utama;
    public $laporan_5_rencana_produksi_sampingan;
    public $laporan_5_realisasi_produksi_utama;
    public $laporan_5_realisasi_produksi_sampingan;
    public $laporan_5_realisasi_penjualan_utama;
    public $laporan_5_realisasi_penjualan_sampingan;

    public $laporan_6_rencana_produksi_utama;
    public $laporan_6_rencana_produksi_sampingan;
    public $laporan_6_realisasi_produksi_utama;
    public $laporan_6_realisasi_produksi_sampingan;
    public $laporan_6_realisasi_penjualan_utama;
    public $laporan_6_realisasi_penjualan_sampingan;

    public $laporan_7_rencana_produksi_utama;
    public $laporan_7_rencana_produksi_sampingan;
    public $laporan_7_realisasi_produksi_utama;
    public $laporan_7_realisasi_produksi_sampingan;
    public $laporan_7_realisasi_penjualan_utama;
    public $laporan_7_realisasi_penjualan_sampingan;

    public $laporan_8_rencana_produksi_utama;
    public $laporan_8_rencana_produksi_sampingan;
    public $laporan_8_realisasi_produksi_utama;
    public $laporan_8_realisasi_produksi_sampingan;
    public $laporan_8_realisasi_penjualan_utama;
    public $laporan_8_realisasi_penjualan_sampingan;

    public $laporan_9_rencana_produksi_utama;
    public $laporan_9_rencana_produksi_sampingan;
    public $laporan_9_realisasi_produksi_utama;
    public $laporan_9_realisasi_produksi_sampingan;
    public $laporan_9_realisasi_penjualan_utama;
    public $laporan_9_realisasi_penjualan_sampingan;

    public $laporan_10_rencana_produksi_utama;
    public $laporan_10_rencana_produksi_sampingan;
    public $laporan_10_realisasi_produksi_utama;
    public $laporan_10_realisasi_produksi_sampingan;
    public $laporan_10_realisasi_penjualan_utama;
    public $laporan_10_realisasi_penjualan_sampingan;

    public $laporan_11_rencana_produksi_utama;
    public $laporan_11_rencana_produksi_sampingan;
    public $laporan_11_realisasi_produksi_utama;
    public $laporan_11_realisasi_produksi_sampingan;
    public $laporan_11_realisasi_penjualan_utama;
    public $laporan_11_realisasi_penjualan_sampingan;

    public $laporan_12_rencana_produksi_utama;
    public $laporan_12_rencana_produksi_sampingan;
    public $laporan_12_realisasi_produksi_utama;
    public $laporan_12_realisasi_produksi_sampingan;
    public $laporan_12_realisasi_penjualan_utama;
    public $laporan_12_realisasi_penjualan_sampingan;

    public $editingId = null;

    protected $messages = [
        'reports.*.tahun_laporan.required' => 'Tahun laporan wajib diisi.',
    ];

    public function mount()
    {
        $this->reports = ModelsReportmonth::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->reports;
    }

    protected function rulesForRow($id)
    {
        return [
            "reports.$id.tahun_laporan" => 'required|numeric',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "tahun_laporan" => 'required|numeric',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        // data dasar
        $data = [
            'profile_id'       => session('id_perusahaan'),
            'tahun_laporan'    => $this->tahun_laporan,
            'laporan_keterangan' => $this->laporan_keterangan,
        ];

        // isi otomatis untuk bulan 1–12
        for ($i = 1; $i <= 12; $i++) {
            $data["laporan_{$i}_rencana_produksi_utama"]      = $this->{"laporan_{$i}_rencana_produksi_utama"};
            $data["laporan_{$i}_rencana_produksi_sampingan"]  = $this->{"laporan_{$i}_rencana_produksi_sampingan"};
            $data["laporan_{$i}_realisasi_produksi_utama"]    = $this->{"laporan_{$i}_realisasi_produksi_utama"};
            $data["laporan_{$i}_realisasi_produksi_sampingan"] = $this->{"laporan_{$i}_realisasi_produksi_sampingan"};
            $data["laporan_{$i}_realisasi_penjualan_utama"]   = $this->{"laporan_{$i}_realisasi_penjualan_utama"};
            $data["laporan_{$i}_realisasi_penjualan_sampingan"] = $this->{"laporan_{$i}_realisasi_penjualan_sampingan"};
        }

        // simpan ke database
        ModelsReportmonth::create($data);

        // refresh data
        $this->reports = ModelsReportmonth::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->reports;

        // reset semua input field
        $this->resetExcept('reports', 'original');

        $this->dispatch('store-success', message: 'Data laporan baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->reports[$id];
        ModelsReportmonth::find($id)->update($data);

        $this->original = ModelsReportmonth::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data laporan berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->reports[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsReportmonth::whereId($id)->delete();

        unset($this->reports[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data laporan berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'reportmonth';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Bulanan'],
            'judul_menu' => 'Laporan Bulanan',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
