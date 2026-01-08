<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Kim as ModelsKim;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Kim extends Component
{
    public $kim = [];
    public $original = [];

    // field tambah data baru
    public $kim_no_persetujuan;
    public $kim_tgl_persetujuan;
    public $kim_nama_juru_ledak;
    public $kim_tgl_mulai;
    public $kim_tgl_selesai;

    public $editingId = null;

    protected $messages = [
        'kim.*.kim_no_persetujuan.required'     => 'Nomor persetujuan wajib diisi.',
        'kim.*.kim_tgl_persetujuan.required'    => 'Tanggal persetujuan wajib diisi.',
        'kim.*.kim_tgl_persetujuan.date'        => 'Tanggal persetujuan tidak valid.',
        'kim.*.kim_nama_juru_ledak.required'    => 'Nama juru ledak wajib diisi.',
        'kim.*.kim_tgl_mulai.required'          => 'Tanggal mulai wajib diisi.',
        'kim.*.kim_tgl_mulai.date'              => 'Tanggal mulai tidak valid.',
        'kim.*.kim_tgl_selesai.required'        => 'Tanggal selesai wajib diisi.',
        'kim.*.kim_tgl_selesai.date'            => 'Tanggal selesai tidak valid.',
    ];

    public function mount()
    {
        $this->kim = ModelsKim::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->kim;
    }

    protected function rulesForRow($id)
    {
        return [
            "kim.$id.kim_no_persetujuan"     => 'required',
            "kim.$id.kim_tgl_persetujuan"    => 'required|date',
            "kim.$id.kim_nama_juru_ledak"    => 'required',
            "kim.$id.kim_tgl_mulai"          => 'required|date',
            "kim.$id.kim_tgl_selesai"        => 'required|date',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "kim_no_persetujuan"     => 'required',
            "kim_tgl_persetujuan"    => 'required|date',
            "kim_nama_juru_ledak"    => 'required',
            "kim_tgl_mulai"          => 'required|date',
            "kim_tgl_selesai"        => 'required|date',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsKim::create([
            'profile_id'            => session('id_perusahaan'),
            'kim_no_persetujuan'    => $this->kim_no_persetujuan,
            'kim_tgl_persetujuan'   => $this->kim_tgl_persetujuan,
            'kim_nama_juru_ledak'   => $this->kim_nama_juru_ledak,
            'kim_tgl_mulai'         => $this->kim_tgl_mulai,
            'kim_tgl_selesai'       => $this->kim_tgl_selesai,
        ]);

        // refresh data
        $this->kim = ModelsKim::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->kim;

        $this->reset([
            'kim_no_persetujuan',
            'kim_tgl_persetujuan',
            'kim_nama_juru_ledak',
            'kim_tgl_mulai',
            'kim_tgl_selesai'
        ]);

        $this->dispatch('store-success', message: 'Data KIM baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->kim[$id];
        ModelsKim::find($id)->update($data);

        $this->original = ModelsKim::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data KIM berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->kim[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsKim::whereId($id)->delete();

        unset($this->kim[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data KIM berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'kim';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Kartu Izin Meledakan',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
