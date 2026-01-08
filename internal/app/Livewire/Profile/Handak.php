<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Handak as ModelsHandak;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Handak extends Component
{
    public $handak = [];
    public $original = [];

    // field tambah data baru
    public $handak_no_persetujuan;
    public $handak_tgl;
    public $handak_jenis_bahan;
    public $handak_kapasitas_gudang;
    public $handak_tgl_mulai;
    public $handak_tgl_selesai;

    public $editingId = null;

    protected $messages = [
        'handak.*.handak_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'handak.*.handak_tgl.required'            => 'Tanggal wajib diisi.',
        'handak.*.handak_tgl.date'                => 'Tanggal tidak valid.',
        'handak.*.handak_jenis_bahan.required'    => 'Jenis bahan wajib diisi.',
        'handak.*.handak_kapasitas_gudang.required' => 'Kapasitas gudang wajib diisi.',
        'handak.*.handak_kapasitas_gudang.numeric'  => 'Kapasitas gudang harus berupa angka.',
        'handak.*.handak_tgl_mulai.required'      => 'Tanggal mulai wajib diisi.',
        'handak.*.handak_tgl_mulai.date'          => 'Tanggal mulai tidak valid.',
        'handak.*.handak_tgl_selesai.required'    => 'Tanggal selesai wajib diisi.',
        'handak.*.handak_tgl_selesai.date'        => 'Tanggal selesai tidak valid.',
    ];

    public function mount()
    {
        $this->handak = ModelsHandak::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->handak;
    }

    protected function rulesForRow($id)
    {
        return [
            "handak.$id.handak_no_persetujuan" => 'required',
            "handak.$id.handak_tgl"            => 'required|date',
            "handak.$id.handak_jenis_bahan"    => 'required',
            "handak.$id.handak_kapasitas_gudang" => 'required|numeric',
            "handak.$id.handak_tgl_mulai"      => 'required|date',
            "handak.$id.handak_tgl_selesai"    => 'required|date',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "handak_no_persetujuan"   => 'required',
            "handak_tgl"              => 'required|date',
            "handak_jenis_bahan"      => 'required',
            "handak_kapasitas_gudang" => 'required|numeric',
            "handak_tgl_mulai"        => 'required|date',
            "handak_tgl_selesai"      => 'required|date',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsHandak::create([
            'profile_id'             => session('id_perusahaan'),
            'handak_no_persetujuan'  => $this->handak_no_persetujuan,
            'handak_tgl'             => $this->handak_tgl,
            'handak_jenis_bahan'     => $this->handak_jenis_bahan,
            'handak_kapasitas_gudang' => $this->handak_kapasitas_gudang,
            'handak_tgl_mulai'       => $this->handak_tgl_mulai,
            'handak_tgl_selesai'     => $this->handak_tgl_selesai,
        ]);

        $this->handak = ModelsHandak::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->handak;

        $this->reset([
            'handak_no_persetujuan',
            'handak_tgl',
            'handak_jenis_bahan',
            'handak_kapasitas_gudang',
            'handak_tgl_mulai',
            'handak_tgl_selesai',
        ]);

        $this->dispatch('store-success', message: 'Data handak baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->handak[$id];
        ModelsHandak::find($id)->update($data);

        $this->original = ModelsHandak::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data handak berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->handak[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsHandak::whereId($id)->delete();

        unset($this->handak[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data handak berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'handak';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Gudang Bahan Peledak',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
