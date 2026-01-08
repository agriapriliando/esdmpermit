<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Pl as ModelsPl;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Pl extends Component
{
    public $pl = [];
    public $original = [];

    // field tambah data baru
    public $persetujuan_lingkungan_nomor;
    public $persetujuan_lingkungan_tgl;
    public $persetujuan_lingkungan_target_produksi;
    public $persetujuan_lingkungan_wilayah_izin;
    public $persetujuan_lingkungan_area_penunjang;

    public $editingId = null;

    protected $messages = [
        'pl.*.persetujuan_lingkungan_nomor.required' => 'Nomor persetujuan wajib diisi.',
        'pl.*.persetujuan_lingkungan_tgl.required'   => 'Tanggal persetujuan wajib diisi.',
        'pl.*.persetujuan_lingkungan_tgl.date'       => 'Tanggal tidak valid.',
        'pl.*.persetujuan_lingkungan_target_produksi.required' => 'Target produksi wajib diisi.',
        'pl.*.persetujuan_lingkungan_wilayah_izin.required'    => 'Wilayah izin wajib diisi.',
        'pl.*.persetujuan_lingkungan_area_penunjang.required'  => 'Area penunjang wajib diisi.',
    ];

    public function mount()
    {
        $this->pl = ModelsPl::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->pl;
    }

    protected function rulesForRow($id)
    {
        return [
            "pl.$id.persetujuan_lingkungan_nomor"          => 'required',
            "pl.$id.persetujuan_lingkungan_tgl"            => 'required|date',
            "pl.$id.persetujuan_lingkungan_target_produksi" => 'required',
            "pl.$id.persetujuan_lingkungan_wilayah_izin"   => 'required',
            "pl.$id.persetujuan_lingkungan_area_penunjang" => 'required',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "persetujuan_lingkungan_nomor"           => 'required',
            "persetujuan_lingkungan_tgl"             => 'required|date',
            "persetujuan_lingkungan_target_produksi" => 'required',
            "persetujuan_lingkungan_wilayah_izin"    => 'required',
            "persetujuan_lingkungan_area_penunjang"  => 'required',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsPl::create([
            'profile_id'                          => session('id_perusahaan'),
            'persetujuan_lingkungan_nomor'        => $this->persetujuan_lingkungan_nomor,
            'persetujuan_lingkungan_tgl'          => $this->persetujuan_lingkungan_tgl,
            'persetujuan_lingkungan_target_produksi' => $this->persetujuan_lingkungan_target_produksi,
            'persetujuan_lingkungan_wilayah_izin'    => $this->persetujuan_lingkungan_wilayah_izin,
            'persetujuan_lingkungan_area_penunjang'  => $this->persetujuan_lingkungan_area_penunjang,
        ]);

        $this->pl = ModelsPl::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->pl;

        $this->reset([
            'persetujuan_lingkungan_nomor',
            'persetujuan_lingkungan_tgl',
            'persetujuan_lingkungan_target_produksi',
            'persetujuan_lingkungan_wilayah_izin',
            'persetujuan_lingkungan_area_penunjang'
        ]);

        $this->dispatch('store-success', message: 'Data persetujuan lingkungan baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->pl[$id];
        ModelsPl::find($id)->update($data);

        $this->original = ModelsPl::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data persetujuan lingkungan berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->pl[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsPl::whereId($id)->delete();

        unset($this->pl[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data persetujuan lingkungan berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'pl';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Persetujuan Lingkungan PKPLH/SKKL',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
