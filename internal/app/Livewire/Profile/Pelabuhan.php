<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Pelabuhan as ModelsPelabuhan;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Pelabuhan extends Component
{
    public $pelabuhan = [];
    public $original = [];

    // field tambah data baru
    public $pelabuhan_no_persetujuan;
    public $pelabuhan_tgl_persetujuan;
    public $pelabuhan_status_tuks_terum;

    public $editingId = null;

    protected $messages = [
        'pelabuhan.*.pelabuhan_no_persetujuan.required'   => 'Nomor persetujuan wajib diisi.',
        'pelabuhan.*.pelabuhan_tgl_persetujuan.required'  => 'Tanggal persetujuan wajib diisi.',
        'pelabuhan.*.pelabuhan_tgl_persetujuan.date'      => 'Tanggal persetujuan tidak valid.',
        'pelabuhan.*.pelabuhan_status_tuks_terum.required' => 'Status TUKS Terum wajib diisi.',

        'pelabuhan_no_persetujuan.required'   => 'Nomor persetujuan wajib diisi.',
        'pelabuhan_tgl_persetujuan.required'  => 'Tanggal persetujuan wajib diisi.',
        'pelabuhan_tgl_persetujuan.date'      => 'Tanggal persetujuan tidak valid.',
        'pelabuhan_status_tuks_terum.required' => 'Status TUKS Terum wajib diisi.',
    ];

    public function mount()
    {
        $this->pelabuhan = ModelsPelabuhan::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->pelabuhan;
    }

    protected function rulesForRow($id)
    {
        return [
            "pelabuhan.$id.pelabuhan_no_persetujuan"   => 'required',
            "pelabuhan.$id.pelabuhan_tgl_persetujuan"  => 'required|date',
            "pelabuhan.$id.pelabuhan_status_tuks_terum" => 'required',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "pelabuhan_no_persetujuan"   => 'required',
            "pelabuhan_tgl_persetujuan"  => 'required|date',
            "pelabuhan_status_tuks_terum" => 'required',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsPelabuhan::create([
            'profile_id'                  => session('id_perusahaan'),
            'pelabuhan_no_persetujuan'    => $this->pelabuhan_no_persetujuan,
            'pelabuhan_tgl_persetujuan'   => $this->pelabuhan_tgl_persetujuan,
            'pelabuhan_status_tuks_terum' => $this->pelabuhan_status_tuks_terum,
        ]);

        // refresh data
        $this->pelabuhan = ModelsPelabuhan::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->pelabuhan;

        $this->reset(['pelabuhan_no_persetujuan', 'pelabuhan_tgl_persetujuan', 'pelabuhan_status_tuks_terum']);

        $this->dispatch('store-success', message: 'Data pelabuhan baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->pelabuhan[$id];
        ModelsPelabuhan::find($id)->update($data);

        $this->original = ModelsPelabuhan::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data pelabuhan berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->pelabuhan[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsPelabuhan::whereId($id)->delete();

        unset($this->pelabuhan[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data pelabuhan berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'pelabuhan';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Pelabuhan',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
