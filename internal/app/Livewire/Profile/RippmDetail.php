<?php

namespace App\Livewire\Profile;

use App\Models\Rippm;
use App\Models\RippmDetail as ModelsRippmDetail;
use Livewire\Component;

class RippmDetail extends Component
{
    public $rippm = [];
    public $original = [];

    // field tambah data baru
    public $rippm_tahun;
    public $rippm_pendidikan_rencana;
    public $rippm_pendidikan_realisasi;
    public $rippm_kesehatan_rencana;
    public $rippm_kesehatan_realisasi;
    public $rippm_kemandirian_rencana;
    public $rippm_kemandirian_realisasi;
    public $rippm_tenaga_kerja_rencana;
    public $rippm_tenaga_kerja_realisasi;
    public $rippm_sosbud_rencana;
    public $rippm_sosbud_realisasi;
    public $rippm_lingkungan_rencana;
    public $rippm_lingkungan_realisasi;
    public $rippm_lembaga_komunitas_rencana;
    public $rippm_lembaga_komunitas_realisasi;
    public $rippm_infrastruktur_rencana;
    public $rippm_infrastruktur_realisasi;

    public $editingId = null;
    public $rippm_id; // diambil dari route

    public $rippm_utama;

    protected $messages = [
        'rippm.*.rippm_tahun.required' => 'Tahun wajib diisi.',
        'rippm.*.rippm_tahun.numeric'  => 'Tahun harus berupa angka.',
    ];

    public function mount($id)
    {
        $this->rippm_id = $id;

        $this->rippm_utama = Rippm::find($id);

        $this->rippm = ModelsRippmDetail::where('rippm_id', $id)
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rippm;
    }

    protected function rulesForRow($id)
    {
        return [
            "rippm.$id.rippm_tahun" => 'required|numeric',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "rippm_tahun" => 'required|numeric',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsRippmDetail::create([
            'profile_id' => session('id_perusahaan'),
            'rippm_id' => $this->rippm_id,
            'rippm_tahun' => $this->rippm_tahun,
            'rippm_pendidikan_rencana' => $this->rippm_pendidikan_rencana,
            'rippm_pendidikan_realisasi' => $this->rippm_pendidikan_realisasi,
            'rippm_kesehatan_rencana' => $this->rippm_kesehatan_rencana,
            'rippm_kesehatan_realisasi' => $this->rippm_kesehatan_realisasi,
            'rippm_kemandirian_rencana' => $this->rippm_kemandirian_rencana,
            'rippm_kemandirian_realisasi' => $this->rippm_kemandirian_realisasi,
            'rippm_tenaga_kerja_rencana' => $this->rippm_tenaga_kerja_rencana,
            'rippm_tenaga_kerja_realisasi' => $this->rippm_tenaga_kerja_realisasi,
            'rippm_sosbud_rencana' => $this->rippm_sosbud_rencana,
            'rippm_sosbud_realisasi' => $this->rippm_sosbud_realisasi,
            'rippm_lingkungan_rencana' => $this->rippm_lingkungan_rencana,
            'rippm_lingkungan_realisasi' => $this->rippm_lingkungan_realisasi,
            'rippm_lembaga_komunitas_rencana' => $this->rippm_lembaga_komunitas_rencana,
            'rippm_lembaga_komunitas_realisasi' => $this->rippm_lembaga_komunitas_realisasi,
            'rippm_infrastruktur_rencana' => $this->rippm_infrastruktur_rencana,
            'rippm_infrastruktur_realisasi' => $this->rippm_infrastruktur_realisasi,
        ]);

        // refresh data
        $this->rippm = ModelsRippmDetail::where('rippm_id', $this->rippm_id)
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rippm;

        $this->reset([
            'rippm_tahun',
            'rippm_pendidikan_rencana',
            'rippm_pendidikan_realisasi',
            'rippm_kesehatan_rencana',
            'rippm_kesehatan_realisasi',
            'rippm_kemandirian_rencana',
            'rippm_kemandirian_realisasi',
            'rippm_tenaga_kerja_rencana',
            'rippm_tenaga_kerja_realisasi',
            'rippm_sosbud_rencana',
            'rippm_sosbud_realisasi',
            'rippm_lingkungan_rencana',
            'rippm_lingkungan_realisasi',
            'rippm_lembaga_komunitas_rencana',
            'rippm_lembaga_komunitas_realisasi',
            'rippm_infrastruktur_rencana',
            'rippm_infrastruktur_realisasi',
        ]);

        $this->dispatch('store-success', message: 'Data RIPPm baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->rippm[$id];
        ModelsRippmDetail::find($id)->update($data);

        $this->original = ModelsRippmDetail::where('rippm_id', $this->rippm_id)
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data RIPPm berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->rippm[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsRippmDetail::whereId($id)->delete();

        unset($this->rippm[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data RIPPm berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.profile.rippm-detail');
    }
}
