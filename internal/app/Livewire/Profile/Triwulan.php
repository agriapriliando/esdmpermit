<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Triwulan as ModelsTriwulan;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Triwulan extends Component
{
    public $triwulan = [];
    public $original = [];

    // field tambah data baru
    public $triwulan_tahun;
    public $laporan_triwulan_i;
    public $laporan_triwulan_ii;
    public $laporan_triwulan_iii;
    public $laporan_triwulan_iv;

    public $editingId = null;

    protected $messages = [
        'triwulan.*.triwulan_tahun.required'       => 'Tahun laporan wajib diisi.',
        'triwulan.*.triwulan_tahun.numeric'        => 'Tahun harus berupa angka.',
    ];

    public function mount()
    {
        $this->triwulan = ModelsTriwulan::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->triwulan;
    }

    protected function rulesForRow($id)
    {
        return [
            "triwulan.$id.triwulan_tahun"       => 'required|numeric',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "triwulan_tahun"       => 'required|numeric',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsTriwulan::create([
            'profile_id'          => session('id_perusahaan'),
            'triwulan_tahun'      => $this->triwulan_tahun,
            'laporan_triwulan_i'  => $this->laporan_triwulan_i,
            'laporan_triwulan_ii' => $this->laporan_triwulan_ii,
            'laporan_triwulan_iii' => $this->laporan_triwulan_iii,
            'laporan_triwulan_iv' => $this->laporan_triwulan_iv,
        ]);

        // refresh data
        $this->triwulan = ModelsTriwulan::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->triwulan;

        $this->reset([
            'triwulan_tahun',
            'laporan_triwulan_i',
            'laporan_triwulan_ii',
            'laporan_triwulan_iii',
            'laporan_triwulan_iv',
        ]);

        $this->dispatch('store-success', message: 'Data laporan triwulan baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->triwulan[$id];
        ModelsTriwulan::find($id)->update($data);

        $this->original = ModelsTriwulan::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data laporan triwulan berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->triwulan[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsTriwulan::whereId($id)->delete();

        unset($this->triwulan[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data laporan triwulan berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;

    public function render()
    {
        $input_model_dokumen = 'triwulan';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Triwulan'],
            'judul_menu' => 'Laporan Triwulan',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
