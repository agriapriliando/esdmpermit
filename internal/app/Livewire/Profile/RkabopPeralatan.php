<?php

namespace App\Livewire\Profile;

use App\Models\Rkabop;
use App\Models\RkabopPeralatan as ModelsRkabopPeralatan;
use Livewire\Component;

class RkabopPeralatan extends Component
{
    public $rkabop = [];
    public $original = [];

    // field tambah data baru
    public $rkab_peralatan_pilih_tahun;
    public $rkab_peralatan_jenis;
    public $rkab_peralatan_merk;
    public $rkab_peralatan_jumlah;
    public $rkab_peralatan_no_plat;
    public $rkab_peralatan_status_milik_sendiri;
    public $rkab_peralatan_status_sewa;
    public $rkab_peralatan_bbm_asal_kalteng;
    public $rkab_peralatan_bbm_non_kalteng;
    public $rkab_peralatan_rencana_pakai_bbm;

    public $editingId = null;
    public $rkabop_id; // diambil dari route

    public $rkabop_utama;

    protected $messages = [
        'rkabop.*.rkab_peralatan_pilih_tahun.required' => 'Tahun wajib diisi.',
        'rkabop.*.rkab_peralatan_pilih_tahun.numeric'  => 'Tahun harus berupa angka.',
        'rkabop.*.rkab_peralatan_jumlah.numeric'       => 'Jumlah harus berupa angka.',
    ];

    public function mount($id)
    {
        $this->rkabop_id = $id;

        $this->rkabop_utama = Rkabop::find($id);

        $this->rkabop = ModelsRkabopPeralatan::where('rkabop_id', $id)
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rkabop;
    }

    protected function rulesForRow($id)
    {
        return [
            "rkabop.$id.rkab_peralatan_pilih_tahun" => 'required|numeric',
            "rkabop.$id.rkab_peralatan_jumlah" => 'nullable|numeric',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "rkab_peralatan_pilih_tahun" => 'required|numeric',
            "rkab_peralatan_jumlah" => 'nullable|numeric',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsRkabopPeralatan::create([
            'profile_id' => session('id_perusahaan'),
            'rkabop_id' => $this->rkabop_id,
            'rkab_peralatan_pilih_tahun' => $this->rkab_peralatan_pilih_tahun,
            'rkab_peralatan_jenis' => $this->rkab_peralatan_jenis,
            'rkab_peralatan_merk' => $this->rkab_peralatan_merk,
            'rkab_peralatan_jumlah' => $this->rkab_peralatan_jumlah,
            'rkab_peralatan_no_plat' => $this->rkab_peralatan_no_plat,
            'rkab_peralatan_status_milik_sendiri' => $this->rkab_peralatan_status_milik_sendiri,
            'rkab_peralatan_status_sewa' => $this->rkab_peralatan_status_sewa,
            'rkab_peralatan_bbm_asal_kalteng' => $this->rkab_peralatan_bbm_asal_kalteng,
            'rkab_peralatan_bbm_non_kalteng' => $this->rkab_peralatan_bbm_non_kalteng,
            'rkab_peralatan_rencana_pakai_bbm' => $this->rkab_peralatan_rencana_pakai_bbm,
        ]);

        // refresh data
        $this->rkabop = ModelsRkabopPeralatan::where('rkabop_id', $this->rkabop_id)
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rkabop;

        $this->reset([
            'rkab_peralatan_pilih_tahun',
            'rkab_peralatan_jenis',
            'rkab_peralatan_merk',
            'rkab_peralatan_jumlah',
            'rkab_peralatan_no_plat',
            'rkab_peralatan_status_milik_sendiri',
            'rkab_peralatan_status_sewa',
            'rkab_peralatan_bbm_asal_kalteng',
            'rkab_peralatan_bbm_non_kalteng',
            'rkab_peralatan_rencana_pakai_bbm',
        ]);

        $this->dispatch('store-success', message: 'Data RKAB Peralatan baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->rkabop[$id];
        ModelsRkabopPeralatan::find($id)->update($data);

        $this->original = ModelsRkabopPeralatan::where('rkabop_id', $this->rkabop_id)
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data RKAB Peralatan berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->rkabop[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsRkabopPeralatan::whereId($id)->delete();

        unset($this->rkabop[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data RKAB Peralatan berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.profile.rkabop-peralatan');
    }
}
