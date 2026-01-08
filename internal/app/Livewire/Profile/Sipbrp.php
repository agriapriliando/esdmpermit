<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Sipbrp as ModelsSipbrp;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Sipbrp extends Component
{
    public $sipbrp = [];
    public $original = [];

    // field tambah data baru
    public $sipbrp_no_persetujuan;
    public $sipbrp_tgl_persetujuan;
    public $sipbrp_sd_m3_tereka;
    public $sipbrp_sd_m3_tertunjuk;
    public $sipbrp_sd_m3_terukur;
    public $sipbrp_sd_mt_tereka;
    public $sipbrp_sd_mt_tertunjuk;
    public $sipbrp_sd_mt_terukur;
    public $sipbrp_luas_sumber_daya;
    public $sipbrp_sd_tenaga_ahli;
    public $sipbrp_cadang_m3_terkira;
    public $sipbrp_cadang_m3_terbukti;
    public $sipbrp_cadang_mt_terkira;
    public $sipbrp_cadang_mt_terbukti;
    public $sipbrp_luas_cadangan;
    public $sipbrp_cadang_tenaga_ahli;
    public $sipbrp_target_produksi_m3;
    public $sipbrp_target_produksi_mt;

    public $editingId = null;

    protected $messages = [
        'sipbrp.*.sipbrp_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'sipbrp.*.sipbrp_tgl_persetujuan.required' => 'Tanggal persetujuan wajib diisi.',
        'sipbrp.*.sipbrp_tgl_persetujuan.date'     => 'Tanggal persetujuan tidak valid.',
    ];

    public function mount()
    {
        $this->sipbrp = ModelsSipbrp::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->sipbrp;
    }

    protected function rulesForRow($id)
    {
        return [
            "sipbrp.$id.sipbrp_no_persetujuan" => 'required|string',
            "sipbrp.$id.sipbrp_tgl_persetujuan" => 'required|date',
            "sipbrp.$id.sipbrp_sd_m3_tereka" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_sd_m3_tertunjuk" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_sd_m3_terukur" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_sd_mt_tereka" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_sd_mt_tertunjuk" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_sd_mt_terukur" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_luas_sumber_daya" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_sd_tenaga_ahli" => 'nullable|string',
            "sipbrp.$id.sipbrp_cadang_m3_terkira" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_cadang_m3_terbukti" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_cadang_mt_terkira" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_cadang_mt_terbukti" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_luas_cadangan" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_cadang_tenaga_ahli" => 'nullable|string',
            "sipbrp.$id.sipbrp_target_produksi_m3" => 'nullable|numeric|min:0',
            "sipbrp.$id.sipbrp_target_produksi_mt" => 'nullable|numeric|min:0',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "sipbrp_no_persetujuan" => 'required|string',
            "sipbrp_tgl_persetujuan" => 'required|date',
            "sipbrp_sd_m3_tereka" => 'nullable|numeric|min:0',
            "sipbrp_sd_m3_tertunjuk" => 'nullable|numeric|min:0',
            "sipbrp_sd_m3_terukur" => 'nullable|numeric|min:0',
            "sipbrp_sd_mt_tereka" => 'nullable|numeric|min:0',
            "sipbrp_sd_mt_tertunjuk" => 'nullable|numeric|min:0',
            "sipbrp_sd_mt_terukur" => 'nullable|numeric|min:0',
            "sipbrp_luas_sumber_daya" => 'nullable|numeric|min:0',
            "sipbrp_sd_tenaga_ahli" => 'nullable|string',
            "sipbrp_cadang_m3_terkira" => 'nullable|numeric|min:0',
            "sipbrp_cadang_m3_terbukti" => 'nullable|numeric|min:0',
            "sipbrp_cadang_mt_terkira" => 'nullable|numeric|min:0',
            "sipbrp_cadang_mt_terbukti" => 'nullable|numeric|min:0',
            "sipbrp_luas_cadangan" => 'nullable|numeric|min:0',
            "sipbrp_cadang_tenaga_ahli" => 'nullable|string',
            "sipbrp_target_produksi_m3" => 'nullable|numeric|min:0',
            "sipbrp_target_produksi_mt" => 'nullable|numeric|min:0',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsSipbrp::create([
            'profile_id' => session('id_perusahaan'),
            'sipbrp_no_persetujuan' => $this->sipbrp_no_persetujuan,
            'sipbrp_tgl_persetujuan' => $this->sipbrp_tgl_persetujuan,
            'sipbrp_sd_m3_tereka' => $this->sipbrp_sd_m3_tereka,
            'sipbrp_sd_m3_tertunjuk' => $this->sipbrp_sd_m3_tertunjuk,
            'sipbrp_sd_m3_terukur' => $this->sipbrp_sd_m3_terukur,
            'sipbrp_sd_mt_tereka' => $this->sipbrp_sd_mt_tereka,
            'sipbrp_sd_mt_tertunjuk' => $this->sipbrp_sd_mt_tertunjuk,
            'sipbrp_sd_mt_terukur' => $this->sipbrp_sd_mt_terukur,
            'sipbrp_luas_sumber_daya' => $this->sipbrp_luas_sumber_daya,
            'sipbrp_sd_tenaga_ahli' => $this->sipbrp_sd_tenaga_ahli,
            'sipbrp_cadang_m3_terkira' => $this->sipbrp_cadang_m3_terkira,
            'sipbrp_cadang_m3_terbukti' => $this->sipbrp_cadang_m3_terbukti,
            'sipbrp_cadang_mt_terkira' => $this->sipbrp_cadang_mt_terkira,
            'sipbrp_cadang_mt_terbukti' => $this->sipbrp_cadang_mt_terbukti,
            'sipbrp_luas_cadangan' => $this->sipbrp_luas_cadangan,
            'sipbrp_cadang_tenaga_ahli' => $this->sipbrp_cadang_tenaga_ahli,
            'sipbrp_target_produksi_m3' => $this->sipbrp_target_produksi_m3,
            'sipbrp_target_produksi_mt' => $this->sipbrp_target_produksi_mt,
        ]);

        $this->sipbrp = ModelsSipbrp::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->sipbrp;

        $this->reset([
            'sipbrp_no_persetujuan',
            'sipbrp_tgl_persetujuan',
            'sipbrp_sd_m3_tereka',
            'sipbrp_sd_m3_tertunjuk',
            'sipbrp_sd_m3_terukur',
            'sipbrp_sd_mt_tereka',
            'sipbrp_sd_mt_tertunjuk',
            'sipbrp_sd_mt_terukur',
            'sipbrp_luas_sumber_daya',
            'sipbrp_sd_tenaga_ahli',
            'sipbrp_cadang_m3_terkira',
            'sipbrp_cadang_m3_terbukti',
            'sipbrp_cadang_mt_terkira',
            'sipbrp_cadang_mt_terbukti',
            'sipbrp_luas_cadangan',
            'sipbrp_cadang_tenaga_ahli',
            'sipbrp_target_produksi_m3',
            'sipbrp_target_produksi_mt',
        ]);

        $this->dispatch('store-success', message: 'Data sipbrp baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->sipbrp[$id];
        ModelsSipbrp::find($id)->update($data);

        $this->original = ModelsSipbrp::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data Rencana Penambangan berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->sipbrp[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsSipbrp::whereId($id)->delete();

        unset($this->sipbrp[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'sipbrp';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Rencana Penambangan',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
