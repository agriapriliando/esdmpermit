<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Sipbrtp as ModelsSipbrtp;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Sipbrtp extends Component
{
    public $sipbrtp = [];
    public $original = [];

    // field tambah data baru
    public $sipbrtp_no_persetujuan;
    public $sipbrtp_tgl_persetujuan;
    public $sipbrtp_sd_m3_tereka;
    public $sipbrtp_sd_m3_tertunjuk;
    public $sipbrtp_sd_m3_terukur;
    public $sipbrtp_sd_mt_tereka;
    public $sipbrtp_sd_mt_tertunjuk;
    public $sipbrtp_sd_mt_terukur;
    public $sipbrtp_luas_sumber_daya;
    public $sipbrtp_sd_tenaga_ahli;
    public $sipbrtp_cadang_m3_terkira;
    public $sipbrtp_cadang_m3_terbukti;
    public $sipbrtp_cadang_mt_terkira;
    public $sipbrtp_cadang_mt_terbukti;
    public $sipbrtp_luas_cadangan;
    public $sipbrtp_cadang_tenaga_ahli;
    public $sipbrtp_target_produksi_m3;
    public $sipbrtp_target_produksi_mt;

    public $editingId = null;

    protected $messages = [
        'sipbrtp.*.sipbrtp_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'sipbrtp.*.sipbrtp_tgl_persetujuan.required' => 'Tanggal persetujuan wajib diisi.',
        'sipbrtp.*.sipbrtp_tgl_persetujuan.date'     => 'Tanggal persetujuan tidak valid.',
    ];

    public function mount()
    {
        $this->sipbrtp = ModelsSipbrtp::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->sipbrtp;
    }

    protected function rulesForRow($id)
    {
        return [
            "sipbrtp.$id.sipbrtp_no_persetujuan" => 'required|string',
            "sipbrtp.$id.sipbrtp_tgl_persetujuan" => 'required|date',
            "sipbrtp.$id.sipbrtp_sd_m3_tereka" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_sd_m3_tertunjuk" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_sd_m3_terukur" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_sd_mt_tereka" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_sd_mt_tertunjuk" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_sd_mt_terukur" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_luas_sumber_daya" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_sd_tenaga_ahli" => 'nullable|string',
            "sipbrtp.$id.sipbrtp_cadang_m3_terkira" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_cadang_m3_terbukti" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_cadang_mt_terkira" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_cadang_mt_terbukti" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_luas_cadangan" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_cadang_tenaga_ahli" => 'nullable|string',
            "sipbrtp.$id.sipbrtp_target_produksi_m3" => 'nullable|numeric|min:0',
            "sipbrtp.$id.sipbrtp_target_produksi_mt" => 'nullable|numeric|min:0',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "sipbrtp_no_persetujuan" => 'required|string',
            "sipbrtp_tgl_persetujuan" => 'required|date',
            "sipbrtp_sd_m3_tereka" => 'nullable|numeric|min:0',
            "sipbrtp_sd_m3_tertunjuk" => 'nullable|numeric|min:0',
            "sipbrtp_sd_m3_terukur" => 'nullable|numeric|min:0',
            "sipbrtp_sd_mt_tereka" => 'nullable|numeric|min:0',
            "sipbrtp_sd_mt_tertunjuk" => 'nullable|numeric|min:0',
            "sipbrtp_sd_mt_terukur" => 'nullable|numeric|min:0',
            "sipbrtp_luas_sumber_daya" => 'nullable|numeric|min:0',
            "sipbrtp_sd_tenaga_ahli" => 'nullable|string',
            "sipbrtp_cadang_m3_terkira" => 'nullable|numeric|min:0',
            "sipbrtp_cadang_m3_terbukti" => 'nullable|numeric|min:0',
            "sipbrtp_cadang_mt_terkira" => 'nullable|numeric|min:0',
            "sipbrtp_cadang_mt_terbukti" => 'nullable|numeric|min:0',
            "sipbrtp_luas_cadangan" => 'nullable|numeric|min:0',
            "sipbrtp_cadang_tenaga_ahli" => 'nullable|string',
            "sipbrtp_target_produksi_m3" => 'nullable|numeric|min:0',
            "sipbrtp_target_produksi_mt" => 'nullable|numeric|min:0',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsSipbrtp::create([
            'profile_id' => session('id_perusahaan'),
            'sipbrtp_no_persetujuan' => $this->sipbrtp_no_persetujuan,
            'sipbrtp_tgl_persetujuan' => $this->sipbrtp_tgl_persetujuan,
            'sipbrtp_sd_m3_tereka' => $this->sipbrtp_sd_m3_tereka,
            'sipbrtp_sd_m3_tertunjuk' => $this->sipbrtp_sd_m3_tertunjuk,
            'sipbrtp_sd_m3_terukur' => $this->sipbrtp_sd_m3_terukur,
            'sipbrtp_sd_mt_tereka' => $this->sipbrtp_sd_mt_tereka,
            'sipbrtp_sd_mt_tertunjuk' => $this->sipbrtp_sd_mt_tertunjuk,
            'sipbrtp_sd_mt_terukur' => $this->sipbrtp_sd_mt_terukur,
            'sipbrtp_luas_sumber_daya' => $this->sipbrtp_luas_sumber_daya,
            'sipbrtp_sd_tenaga_ahli' => $this->sipbrtp_sd_tenaga_ahli,
            'sipbrtp_cadang_m3_terkira' => $this->sipbrtp_cadang_m3_terkira,
            'sipbrtp_cadang_m3_terbukti' => $this->sipbrtp_cadang_m3_terbukti,
            'sipbrtp_cadang_mt_terkira' => $this->sipbrtp_cadang_mt_terkira,
            'sipbrtp_cadang_mt_terbukti' => $this->sipbrtp_cadang_mt_terbukti,
            'sipbrtp_luas_cadangan' => $this->sipbrtp_luas_cadangan,
            'sipbrtp_cadang_tenaga_ahli' => $this->sipbrtp_cadang_tenaga_ahli,
            'sipbrtp_target_produksi_m3' => $this->sipbrtp_target_produksi_m3,
            'sipbrtp_target_produksi_mt' => $this->sipbrtp_target_produksi_mt,
        ]);

        $this->sipbrtp = ModelsSipbrtp::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->sipbrtp;

        $this->reset([
            'sipbrtp_no_persetujuan',
            'sipbrtp_tgl_persetujuan',
            'sipbrtp_sd_m3_tereka',
            'sipbrtp_sd_m3_tertunjuk',
            'sipbrtp_sd_m3_terukur',
            'sipbrtp_sd_mt_tereka',
            'sipbrtp_sd_mt_tertunjuk',
            'sipbrtp_sd_mt_terukur',
            'sipbrtp_luas_sumber_daya',
            'sipbrtp_sd_tenaga_ahli',
            'sipbrtp_cadang_m3_terkira',
            'sipbrtp_cadang_m3_terbukti',
            'sipbrtp_cadang_mt_terkira',
            'sipbrtp_cadang_mt_terbukti',
            'sipbrtp_luas_cadangan',
            'sipbrtp_cadang_tenaga_ahli',
            'sipbrtp_target_produksi_m3',
            'sipbrtp_target_produksi_mt',
        ]);

        $this->dispatch('store-success', message: 'Data baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->sipbrtp[$id];
        ModelsSipbrtp::find($id)->update($data);

        $this->original = ModelsSipbrtp::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->sipbrtp[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsSipbrtp::whereId($id)->delete();

        unset($this->sipbrtp[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'sipbrtp';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Rencana Teknis Penambangan',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
