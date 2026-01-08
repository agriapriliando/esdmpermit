<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Rr as ModelsRr;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Rr extends Component
{
    public $rr = [];
    public $original = [];

    // field tambah data baru
    public $rr_no_persetujuan;
    public $rr_tgl_persetujuan;
    public $rr_tahun;
    public $rr_nominal_yang_ditetapkan;
    public $rr_nominal_yang_ditempatkan;

    public $editingId = null;

    protected $messages = [
        'rr.*.rr_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'rr.*.rr_tgl_persetujuan.required' => 'Tanggal persetujuan wajib diisi.',
        'rr.*.rr_tgl_persetujuan.date' => 'Tanggal persetujuan tidak valid.',
        'rr.*.rr_tahun.required' => 'Tahun wajib diisi.',
        'rr.*.rr_tahun.integer' => 'Tahun harus berupa angka.',
        'rr.*.rr_nominal_yang_ditetapkan.required' => 'Nominal yang ditetapkan wajib diisi.',
        'rr.*.rr_nominal_yang_ditetapkan.numeric' => 'Nominal yang ditetapkan harus berupa angka.',
        'rr.*.rr_nominal_yang_ditempatkan.required' => 'Nominal yang ditempatkan wajib diisi.',
        'rr.*.rr_nominal_yang_ditempatkan.numeric' => 'Nominal yang ditempatkan harus berupa angka.',
    ];

    public function mount()
    {
        $this->rr = ModelsRr::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rr;
    }

    protected function rulesForRow($id)
    {
        return [
            "rr.$id.rr_no_persetujuan" => 'required',
            "rr.$id.rr_tgl_persetujuan" => 'required|date',
            "rr.$id.rr_tahun" => 'required|integer',
            "rr.$id.rr_nominal_yang_ditetapkan" => 'required|numeric',
            "rr.$id.rr_nominal_yang_ditempatkan" => 'required|numeric',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "rr_no_persetujuan" => 'required',
            "rr_tgl_persetujuan" => 'required|date',
            "rr_tahun" => 'required|integer',
            "rr_nominal_yang_ditetapkan" => 'required|numeric',
            "rr_nominal_yang_ditempatkan" => 'required|numeric',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsRr::create([
            'profile_id' => session('id_perusahaan'),
            'rr_no_persetujuan' => $this->rr_no_persetujuan,
            'rr_tgl_persetujuan' => $this->rr_tgl_persetujuan,
            'rr_tahun' => $this->rr_tahun,
            'rr_nominal_yang_ditetapkan' => $this->rr_nominal_yang_ditetapkan,
            'rr_nominal_yang_ditempatkan' => $this->rr_nominal_yang_ditempatkan,
        ]);

        $this->rr = ModelsRr::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rr;

        $this->reset([
            'rr_no_persetujuan',
            'rr_tgl_persetujuan',
            'rr_tahun',
            'rr_nominal_yang_ditetapkan',
            'rr_nominal_yang_ditempatkan',
        ]);

        $this->dispatch('store-success', message: 'Data RR baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->rr[$id];
        ModelsRr::find($id)->update($data);

        $this->original = ModelsRr::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data RR berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->rr[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsRr::whereId($id)->delete();

        unset($this->rr[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data RR berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'rr';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Rencana Reklamasi',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
