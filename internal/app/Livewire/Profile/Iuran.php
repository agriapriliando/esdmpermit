<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Iuran as ModelsIuran;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Iuran extends Component
{
    use WithFileUploads, WithPagination, WithDokumen;

    public $iuran = [];
    public $original = [];

    // field tambah data baru
    public $iuran_tetap_per_tahun_nominal;
    public $iuran_tetap_per_tahun_tgl_bayar;

    public $editingId = null;

    protected $messages = [
        'iuran.*.iuran_tetap_per_tahun_nominal.required' => 'Nominal iuran wajib diisi.',
        'iuran.*.iuran_tetap_per_tahun_nominal.numeric'  => 'Nominal harus berupa angka.',
        'iuran.*.iuran_tetap_per_tahun_nominal.min'      => 'Nominal tidak boleh kurang dari 0.',

        'iuran.*.iuran_tetap_per_tahun_tgl_bayar.required' => 'Tanggal bayar wajib diisi.',
        'iuran.*.iuran_tetap_per_tahun_tgl_bayar.date'     => 'Tanggal tidak valid.',
    ];

    public function mount()
    {
        $this->iuran = ModelsIuran::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')     // kunci array pakai ID
            ->toArray();

        $this->original = $this->iuran;
    }

    protected function rulesForRow($id)
    {
        return [
            "iuran.$id.iuran_tetap_per_tahun_nominal" => 'required|numeric|min:0',
            "iuran.$id.iuran_tetap_per_tahun_tgl_bayar" => 'required|date',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "iuran_tetap_per_tahun_nominal" => 'required|numeric|min:0',
            "iuran_tetap_per_tahun_tgl_bayar" => 'required|date',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsIuran::create([
            'profile_id' => session('id_perusahaan'),
            'iuran_tetap_per_tahun_nominal' => $this->iuran_tetap_per_tahun_nominal,
            'iuran_tetap_per_tahun_tgl_bayar' => $this->iuran_tetap_per_tahun_tgl_bayar,
        ]);

        // refresh data dengan key id
        $this->iuran = ModelsIuran::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->iuran;

        $this->reset(['iuran_tetap_per_tahun_nominal', 'iuran_tetap_per_tahun_tgl_bayar']);

        $this->dispatch('store-success', message: 'Data iuran baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->iuran[$id];
        ModelsIuran::find($id)->update($data);

        $this->original = ModelsIuran::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data iuran berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->iuran[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsIuran::whereId($id)->delete();

        unset($this->iuran[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data iuran berhasil dihapus!');
    }

    public function render()
    {
        $input_model_dokumen = 'iuran';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => ucfirst($input_model_dokumen),
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
