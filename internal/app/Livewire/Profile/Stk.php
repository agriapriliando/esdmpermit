<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Stk as ModelsStk;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Stk extends Component
{
    public $stk = [];
    public $original = [];

    // field tambah data baru
    public $stk_no_persetujuan;
    public $stk_tgl_persetujuan;
    public $stk_sd_m3_tereka;
    public $stk_sd_m3_tertunjuk;
    public $stk_sd_m3_terukur;
    public $stk_sd_mt_tereka;
    public $stk_sd_mt_tertunjuk;
    public $stk_sd_mt_terukur;
    public $stk_luas_sumber_daya;
    public $stk_sd_tenaga_ahli;
    public $stk_cadang_m3_terkira;
    public $stk_cadang_m3_terbukti;
    public $stk_cadang_mt_terkira;
    public $stk_cadang_mt_terbukti;
    public $stk_luas_cadangan;
    public $stk_cadang_tenaga_ahli;
    public $stk_target_produksi_m3;
    public $stk_target_produksi_mt;

    public $editingId = null;

    protected $messages = [
        'stk.*.stk_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'stk.*.stk_tgl_persetujuan.required' => 'Tanggal persetujuan wajib diisi.',
        'stk.*.stk_tgl_persetujuan.date'     => 'Tanggal persetujuan tidak valid.',
        // Tambahkan pesan validasi sesuai kebutuhan tiap field
    ];

    public function mount()
    {
        $this->stk = ModelsStk::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->stk;
    }

    protected function rulesForRow($id)
    {
        return [
            "stk.$id.stk_no_persetujuan" => 'required|string',
            "stk.$id.stk_tgl_persetujuan" => 'required|date',
            "stk.$id.stk_sd_m3_tereka" => 'nullable|numeric|min:0',
            "stk.$id.stk_sd_m3_tertunjuk" => 'nullable|numeric|min:0',
            "stk.$id.stk_sd_m3_terukur" => 'nullable|numeric|min:0',
            "stk.$id.stk_sd_mt_tereka" => 'nullable|numeric|min:0',
            "stk.$id.stk_sd_mt_tertunjuk" => 'nullable|numeric|min:0',
            "stk.$id.stk_sd_mt_terukur" => 'nullable|numeric|min:0',
            "stk.$id.stk_luas_sumber_daya" => 'nullable|numeric|min:0',
            "stk.$id.stk_sd_tenaga_ahli" => 'nullable|string',
            "stk.$id.stk_cadang_m3_terkira" => 'nullable|numeric|min:0',
            "stk.$id.stk_cadang_m3_terbukti" => 'nullable|numeric|min:0',
            "stk.$id.stk_cadang_mt_terkira" => 'nullable|numeric|min:0',
            "stk.$id.stk_cadang_mt_terbukti" => 'nullable|numeric|min:0',
            "stk.$id.stk_luas_cadangan" => 'nullable|numeric|min:0',
            "stk.$id.stk_cadang_tenaga_ahli" => 'nullable|string',
            "stk.$id.stk_target_produksi_m3" => 'nullable|numeric|min:0',
            "stk.$id.stk_target_produksi_mt" => 'nullable|numeric|min:0',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "stk_no_persetujuan" => 'required|string',
            "stk_tgl_persetujuan" => 'required|date',
            "stk_sd_m3_tereka" => 'nullable|numeric|min:0',
            "stk_sd_m3_tertunjuk" => 'nullable|numeric|min:0',
            "stk_sd_m3_terukur" => 'nullable|numeric|min:0',
            "stk_sd_mt_tereka" => 'nullable|numeric|min:0',
            "stk_sd_mt_tertunjuk" => 'nullable|numeric|min:0',
            "stk_sd_mt_terukur" => 'nullable|numeric|min:0',
            "stk_luas_sumber_daya" => 'nullable|numeric|min:0',
            "stk_sd_tenaga_ahli" => 'nullable|string',
            "stk_cadang_m3_terkira" => 'nullable|numeric|min:0',
            "stk_cadang_m3_terbukti" => 'nullable|numeric|min:0',
            "stk_cadang_mt_terkira" => 'nullable|numeric|min:0',
            "stk_cadang_mt_terbukti" => 'nullable|numeric|min:0',
            "stk_luas_cadangan" => 'nullable|numeric|min:0',
            "stk_cadang_tenaga_ahli" => 'nullable|string',
            "stk_target_produksi_m3" => 'nullable|numeric|min:0',
            "stk_target_produksi_mt" => 'nullable|numeric|min:0',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsStk::create([
            'profile_id' => session('id_perusahaan'),
            'stk_no_persetujuan' => $this->stk_no_persetujuan,
            'stk_tgl_persetujuan' => $this->stk_tgl_persetujuan,
            'stk_sd_m3_tereka' => $this->stk_sd_m3_tereka,
            'stk_sd_m3_tertunjuk' => $this->stk_sd_m3_tertunjuk,
            'stk_sd_m3_terukur' => $this->stk_sd_m3_terukur,
            'stk_sd_mt_tereka' => $this->stk_sd_mt_tereka,
            'stk_sd_mt_tertunjuk' => $this->stk_sd_mt_tertunjuk,
            'stk_sd_mt_terukur' => $this->stk_sd_mt_terukur,
            'stk_luas_sumber_daya' => $this->stk_luas_sumber_daya,
            'stk_sd_tenaga_ahli' => $this->stk_sd_tenaga_ahli,
            'stk_cadang_m3_terkira' => $this->stk_cadang_m3_terkira,
            'stk_cadang_m3_terbukti' => $this->stk_cadang_m3_terbukti,
            'stk_cadang_mt_terkira' => $this->stk_cadang_mt_terkira,
            'stk_cadang_mt_terbukti' => $this->stk_cadang_mt_terbukti,
            'stk_luas_cadangan' => $this->stk_luas_cadangan,
            'stk_cadang_tenaga_ahli' => $this->stk_cadang_tenaga_ahli,
            'stk_target_produksi_m3' => $this->stk_target_produksi_m3,
            'stk_target_produksi_mt' => $this->stk_target_produksi_mt,
        ]);

        $this->stk = ModelsStk::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->stk;

        $this->reset([
            'stk_no_persetujuan',
            'stk_tgl_persetujuan',
            'stk_sd_m3_tereka',
            'stk_sd_m3_tertunjuk',
            'stk_sd_m3_terukur',
            'stk_sd_mt_tereka',
            'stk_sd_mt_tertunjuk',
            'stk_sd_mt_terukur',
            'stk_luas_sumber_daya',
            'stk_sd_tenaga_ahli',
            'stk_cadang_m3_terkira',
            'stk_cadang_m3_terbukti',
            'stk_cadang_mt_terkira',
            'stk_cadang_mt_terbukti',
            'stk_luas_cadangan',
            'stk_cadang_tenaga_ahli',
            'stk_target_produksi_m3',
            'stk_target_produksi_mt',
        ]);

        $this->dispatch('store-success', message: 'Data STK baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->stk[$id];
        ModelsStk::find($id)->update($data);

        $this->original = ModelsStk::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data STK berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->stk[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsStk::whereId($id)->delete();

        unset($this->stk[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data STK berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'stk';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Studi Kelayakan (Tekno Ekonomi)',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
