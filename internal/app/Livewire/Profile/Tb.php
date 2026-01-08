<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Tb as ModelsTb;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Tb extends Component
{
    public $tb = [];
    public $original = [];

    // field tambah data baru
    public $no_sk_tanda_batas;
    public $tgl_sk_tanda_batas;
    public $tanda_batas_laporan_pemeliharaan;

    public $editingId = null;

    protected $messages = [
        'tb.*.no_sk_tanda_batas.required' => 'Nomor SK tanda batas wajib diisi.',
        'tb.*.tgl_sk_tanda_batas.required' => 'Tanggal SK tanda batas wajib diisi.',
        'tb.*.tgl_sk_tanda_batas.date'     => 'Tanggal SK tidak valid.',
        'tb.*.tanda_batas_laporan_pemeliharaan.required' => 'Laporan pemeliharaan wajib diisi.',

        'no_sk_tanda_batas.required' => 'Nomor SK tanda batas wajib diisi.',
        'tgl_sk_tanda_batas.required' => 'Tanggal SK tanda batas wajib diisi.',
        'tgl_sk_tanda_batas.date'     => 'Tanggal SK tidak valid.',
        'tanda_batas_laporan_pemeliharaan.required' => 'Laporan pemeliharaan wajib diisi.',
    ];

    public function mount()
    {
        $this->tb = ModelsTb::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')     // kunci array pakai ID
            ->toArray();

        $this->original = $this->tb;
    }

    protected function rulesForRow($id)
    {
        return [
            "tb.$id.no_sk_tanda_batas" => 'required',
            "tb.$id.tgl_sk_tanda_batas" => 'required|date',
            "tb.$id.tanda_batas_laporan_pemeliharaan" => 'required',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "no_sk_tanda_batas" => 'required',
            "tgl_sk_tanda_batas" => 'required|date',
            "tanda_batas_laporan_pemeliharaan" => 'required',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsTb::create([
            'profile_id' => session('id_perusahaan'),
            'no_sk_tanda_batas' => $this->no_sk_tanda_batas,
            'tgl_sk_tanda_batas' => $this->tgl_sk_tanda_batas,
            'tanda_batas_laporan_pemeliharaan' => $this->tanda_batas_laporan_pemeliharaan,
        ]);

        // refresh data dengan key id
        $this->tb = ModelsTb::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->tb;

        $this->reset(['no_sk_tanda_batas', 'tgl_sk_tanda_batas', 'tanda_batas_laporan_pemeliharaan']);

        $this->dispatch('store-success', message: 'Data tanda batas baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->tb[$id];
        ModelsTb::find($id)->update($data);

        $this->original = ModelsTb::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data tanda batas berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->tb[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsTb::whereId($id)->delete();

        unset($this->tb[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data tanda batas berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'tb';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Tanda Batas',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
