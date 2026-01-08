<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Rippm as ModelsRippm;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Rippm extends Component
{
    public $rippm = [];
    public $original = [];

    // field tambah data baru
    public $rippm_no_persetujuan;
    public $rippm_tgl_persetujuan;
    public $rippm_keterangan;

    public $editingId = null;

    protected $messages = [
        'rippm.*.rippm_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'rippm.*.rippm_tgl_persetujuan.required' => 'Tanggal persetujuan wajib diisi.',
        'rippm.*.rippm_tgl_persetujuan.date'     => 'Tanggal persetujuan tidak valid.',
        'rippm.*.rippm_keterangan.required'      => 'Keterangan wajib diisi.',

        'rippm_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'rippm_tgl_persetujuan.required' => 'Tanggal persetujuan wajib diisi.',
        'rippm_tgl_persetujuan.date'     => 'Tanggal persetujuan tidak valid.',
        'rippm_keterangan.required'      => 'Keterangan wajib diisi.',
    ];

    public function mount()
    {
        $this->rippm = ModelsRippm::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rippm;
    }

    protected function rulesForRow($id)
    {
        return [
            "rippm.$id.rippm_no_persetujuan" => 'required',
            "rippm.$id.rippm_tgl_persetujuan" => 'required|date',
            "rippm.$id.rippm_keterangan" => 'required',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "rippm_no_persetujuan" => 'required',
            "rippm_tgl_persetujuan" => 'required|date',
            "rippm_keterangan" => 'required',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsRippm::create([
            'profile_id' => session('id_perusahaan'),
            'rippm_no_persetujuan' => $this->rippm_no_persetujuan,
            'rippm_tgl_persetujuan' => $this->rippm_tgl_persetujuan,
            'rippm_keterangan' => $this->rippm_keterangan,
        ]);

        // refresh data
        $this->rippm = ModelsRippm::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rippm;

        $this->reset(['rippm_no_persetujuan', 'rippm_tgl_persetujuan', 'rippm_keterangan']);

        $this->dispatch('store-success', message: 'Data Rippm baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->rippm[$id];
        ModelsRippm::find($id)->update($data);

        $this->original = ModelsRippm::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data Rippm berhasil diperbaharui!');
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
        ModelsRippm::whereId($id)->delete();

        unset($this->rippm[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data Rippm berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'rippm';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'RIPPM',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
