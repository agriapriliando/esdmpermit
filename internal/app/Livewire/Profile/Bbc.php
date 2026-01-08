<?php

namespace App\Livewire\Profile;

use App\Models\Bbc as ModelsBbc;
use App\Models\Dokumen;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Bbc extends Component
{
    public $bbc = [];
    public $original = [];

    // field tambah data baru
    public $bbc_tangki_no_persetujuan;
    public $bbc_tgl;
    public $bbc_kapasitas_tangki;
    public $bbc_tgl_mulai;
    public $bbc_tgl_selesai;

    public $editingId = null;

    protected $messages = [
        'bbc.*.bbc_tangki_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'bbc.*.bbc_tgl.required' => 'Tanggal wajib diisi.',
        'bbc.*.bbc_tgl.date' => 'Tanggal tidak valid.',
        'bbc.*.bbc_kapasitas_tangki.required' => 'Kapasitas tangki wajib diisi.',
        'bbc.*.bbc_kapasitas_tangki.numeric' => 'Kapasitas tangki harus berupa angka.',
        'bbc.*.bbc_tgl_mulai.required' => 'Tanggal mulai wajib diisi.',
        'bbc.*.bbc_tgl_mulai.date' => 'Tanggal mulai tidak valid.',
        'bbc.*.bbc_tgl_selesai.required' => 'Tanggal selesai wajib diisi.',
        'bbc.*.bbc_tgl_selesai.date' => 'Tanggal selesai tidak valid.',
    ];

    public function mount()
    {
        $this->bbc = ModelsBbc::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->bbc;
    }

    protected function rulesForRow($id)
    {
        return [
            "bbc.$id.bbc_tangki_no_persetujuan" => 'required',
            "bbc.$id.bbc_tgl" => 'required|date',
            "bbc.$id.bbc_kapasitas_tangki" => 'required|numeric',
            "bbc.$id.bbc_tgl_mulai" => 'required|date',
            "bbc.$id.bbc_tgl_selesai" => 'required|date',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "bbc_tangki_no_persetujuan" => 'required',
            "bbc_tgl" => 'required|date',
            "bbc_kapasitas_tangki" => 'required|numeric',
            "bbc_tgl_mulai" => 'required|date',
            "bbc_tgl_selesai" => 'required|date',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsBbc::create([
            'profile_id' => session('id_perusahaan'),
            'bbc_tangki_no_persetujuan' => $this->bbc_tangki_no_persetujuan,
            'bbc_tgl' => $this->bbc_tgl,
            'bbc_kapasitas_tangki' => $this->bbc_kapasitas_tangki,
            'bbc_tgl_mulai' => $this->bbc_tgl_mulai,
            'bbc_tgl_selesai' => $this->bbc_tgl_selesai,
        ]);

        $this->bbc = ModelsBbc::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->bbc;

        $this->reset([
            'bbc_tangki_no_persetujuan',
            'bbc_tgl',
            'bbc_kapasitas_tangki',
            'bbc_tgl_mulai',
            'bbc_tgl_selesai',
        ]);

        $this->dispatch('store-success', message: 'Data BBC baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->bbc[$id];
        ModelsBbc::find($id)->update($data);

        $this->original = ModelsBbc::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data BBC berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->bbc[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsBbc::whereId($id)->delete();

        unset($this->bbc[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data BBC berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'bbc';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Tangki BBC',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
