<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Pa as ModelsPa;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Pa extends Component
{
    public $pa = [];
    public $original = [];

    // field tambah data baru
    public $project_area_nomor;
    public $project_area_tgl;
    public $project_area_penggunaan;
    public $project_area_luas;
    public $project_area_keterangan;

    public $editingId = null;

    protected $messages = [
        'pa.*.project_area_nomor.required' => 'Nomor area wajib diisi.',
        'pa.*.project_area_tgl.required' => 'Tanggal wajib diisi.',
        'pa.*.project_area_tgl.date'     => 'Tanggal tidak valid.',
        'pa.*.project_area_penggunaan.required' => 'Penggunaan wajib diisi.',
        'pa.*.project_area_luas.required' => 'Luas wajib diisi.',
        'pa.*.project_area_luas.numeric'  => 'Luas harus berupa angka.',
        'pa.*.project_area_keterangan.required' => 'Keterangan wajib diisi.',
    ];

    public function mount()
    {
        $this->pa = ModelsPa::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->pa;
    }

    protected function rulesForRow($id)
    {
        return [
            "pa.$id.project_area_nomor" => 'required',
            "pa.$id.project_area_tgl" => 'required|date',
            "pa.$id.project_area_penggunaan" => 'required',
            "pa.$id.project_area_luas" => 'required|numeric|min:0',
            "pa.$id.project_area_keterangan" => 'required',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "project_area_nomor" => 'required',
            "project_area_tgl" => 'required|date',
            "project_area_penggunaan" => 'required',
            "project_area_luas" => 'required|numeric|min:0',
            "project_area_keterangan" => 'required',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsPa::create([
            'profile_id' => session('id_perusahaan'),
            'project_area_nomor' => $this->project_area_nomor,
            'project_area_tgl' => $this->project_area_tgl,
            'project_area_penggunaan' => $this->project_area_penggunaan,
            'project_area_luas' => $this->project_area_luas,
            'project_area_keterangan' => $this->project_area_keterangan,
        ]);

        $this->pa = ModelsPa::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->pa;

        $this->reset([
            'project_area_nomor',
            'project_area_tgl',
            'project_area_penggunaan',
            'project_area_luas',
            'project_area_keterangan',
        ]);

        $this->dispatch('store-success', message: 'Data project area baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->pa[$id];
        ModelsPa::find($id)->update($data);

        $this->original = ModelsPa::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data project area berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->pa[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsPa::whereId($id)->delete();

        unset($this->pa[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data project area berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'pa';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Project Area',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
