<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Le as ModelsLe;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Le extends Component
{
    public $le = [];
    public $original = [];

    // field tambah data baru
    public $le_no_persetujuan;
    public $le_tgl_persetujuan;
    public $le_sd_m3_tereka;
    public $le_sd_m3_tertunjuk;
    public $le_sd_m3_terukur;
    public $le_sd_mt_tereka;
    public $le_sd_mt_tertunjuk;
    public $le_sd_mt_terukur;

    public $editingId = null;

    protected $messages = [
        'le.*.le_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'le.*.le_tgl_persetujuan.required' => 'Tanggal persetujuan wajib diisi.',
        'le.*.le_tgl_persetujuan.date' => 'Tanggal persetujuan tidak valid.',

        'le.*.le_sd_m3_tereka.numeric' => 'Harus berupa angka.',
        'le.*.le_sd_m3_tertunjuk.numeric' => 'Harus berupa angka.',
        'le.*.le_sd_m3_terukur.numeric' => 'Harus berupa angka.',
        'le.*.le_sd_mt_tereka.numeric' => 'Harus berupa angka.',
        'le.*.le_sd_mt_tertunjuk.numeric' => 'Harus berupa angka.',
        'le.*.le_sd_mt_terukur.numeric' => 'Harus berupa angka.',
    ];

    public function mount()
    {
        $this->le = ModelsLe::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->le;
    }

    protected function rulesForRow($id)
    {
        return [
            "le.$id.le_no_persetujuan" => 'required',
            "le.$id.le_tgl_persetujuan" => 'required|date',
            "le.$id.le_sd_m3_tereka" => 'nullable|numeric',
            "le.$id.le_sd_m3_tertunjuk" => 'nullable|numeric',
            "le.$id.le_sd_m3_terukur" => 'nullable|numeric',
            "le.$id.le_sd_mt_tereka" => 'nullable|numeric',
            "le.$id.le_sd_mt_tertunjuk" => 'nullable|numeric',
            "le.$id.le_sd_mt_terukur" => 'nullable|numeric',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "le_no_persetujuan" => 'required',
            "le_tgl_persetujuan" => 'required|date',
            "le_sd_m3_tereka" => 'nullable|numeric',
            "le_sd_m3_tertunjuk" => 'nullable|numeric',
            "le_sd_m3_terukur" => 'nullable|numeric',
            "le_sd_mt_tereka" => 'nullable|numeric',
            "le_sd_mt_tertunjuk" => 'nullable|numeric',
            "le_sd_mt_terukur" => 'nullable|numeric',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsLe::create([
            'profile_id' => session('id_perusahaan'),
            'le_no_persetujuan' => $this->le_no_persetujuan,
            'le_tgl_persetujuan' => $this->le_tgl_persetujuan,
            'le_sd_m3_tereka' => $this->le_sd_m3_tereka,
            'le_sd_m3_tertunjuk' => $this->le_sd_m3_tertunjuk,
            'le_sd_m3_terukur' => $this->le_sd_m3_terukur,
            'le_sd_mt_tereka' => $this->le_sd_mt_tereka,
            'le_sd_mt_tertunjuk' => $this->le_sd_mt_tertunjuk,
            'le_sd_mt_terukur' => $this->le_sd_mt_terukur,
        ]);

        $this->le = ModelsLe::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->le;

        $this->reset([
            'le_no_persetujuan',
            'le_tgl_persetujuan',
            'le_sd_m3_tereka',
            'le_sd_m3_tertunjuk',
            'le_sd_m3_terukur',
            'le_sd_mt_tereka',
            'le_sd_mt_tertunjuk',
            'le_sd_mt_terukur',
        ]);

        $this->dispatch('store-success', message: 'Data LE baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->le[$id];
        ModelsLe::find($id)->update($data);

        $this->original = ModelsLe::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data LE berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->le[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsLe::whereId($id)->delete();

        unset($this->le[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data LE berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'le';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Laporan Eksplorasi',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
