<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Rpt as ModelsRpt;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Rpt extends Component
{
    public $rpt = [];
    public $original = [];

    // field tambah data baru
    public $rpt_no_persetujuan;
    public $rpt_tgl_persetujuan;
    public $rpt_nominal_yang_ditetapkan;
    public $rpt_nominal_yang_ditempatkan;
    public $rpt_tahun_pembayaran;

    public $editingId = null;

    protected $messages = [
        'rpt.*.rpt_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'rpt.*.rpt_tgl_persetujuan.required' => 'Tanggal persetujuan wajib diisi.',
        'rpt.*.rpt_tgl_persetujuan.date'     => 'Tanggal persetujuan tidak valid.',
        'rpt.*.rpt_nominal_yang_ditetapkan.required' => 'Nominal yang ditetapkan wajib diisi.',
        'rpt.*.rpt_nominal_yang_ditetapkan.numeric'  => 'Nominal yang ditetapkan harus berupa angka.',
        'rpt.*.rpt_nominal_yang_ditempatkan.required' => 'Nominal yang ditempatkan wajib diisi.',
        'rpt.*.rpt_nominal_yang_ditempatkan.numeric'  => 'Nominal yang ditempatkan harus berupa angka.',
        'rpt.*.rpt_tahun_pembayaran.required' => 'Tahun pembayaran wajib diisi.',
        'rpt.*.rpt_tahun_pembayaran.integer'  => 'Tahun pembayaran harus berupa angka.',
    ];

    public function mount()
    {
        $this->rpt = ModelsRpt::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rpt;
    }

    protected function rulesForRow($id)
    {
        return [
            "rpt.$id.rpt_no_persetujuan"          => 'required',
            "rpt.$id.rpt_tgl_persetujuan"         => 'required|date',
            "rpt.$id.rpt_nominal_yang_ditetapkan" => 'required|numeric|min:0',
            "rpt.$id.rpt_nominal_yang_ditempatkan" => 'required|numeric|min:0',
            "rpt.$id.rpt_tahun_pembayaran"        => 'required|integer|min:1900|max:2100',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "rpt_no_persetujuan"          => 'required',
            "rpt_tgl_persetujuan"         => 'required|date',
            "rpt_nominal_yang_ditetapkan" => 'required|numeric|min:0',
            "rpt_nominal_yang_ditempatkan" => 'required|numeric|min:0',
            "rpt_tahun_pembayaran"        => 'required|integer|min:1900|max:2100',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsRpt::create([
            'profile_id' => session('id_perusahaan'),
            'rpt_no_persetujuan'          => $this->rpt_no_persetujuan,
            'rpt_tgl_persetujuan'         => $this->rpt_tgl_persetujuan,
            'rpt_nominal_yang_ditetapkan' => $this->rpt_nominal_yang_ditetapkan,
            'rpt_nominal_yang_ditempatkan' => $this->rpt_nominal_yang_ditempatkan,
            'rpt_tahun_pembayaran'        => $this->rpt_tahun_pembayaran,
        ]);

        $this->rpt = ModelsRpt::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rpt;

        $this->reset([
            'rpt_no_persetujuan',
            'rpt_tgl_persetujuan',
            'rpt_nominal_yang_ditetapkan',
            'rpt_nominal_yang_ditempatkan',
            'rpt_tahun_pembayaran',
        ]);

        $this->dispatch('store-success', message: 'Data RPT baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->rpt[$id];
        ModelsRpt::find($id)->update($data);

        $this->original = ModelsRpt::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data RPT berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->rpt[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsRpt::whereId($id)->delete();

        unset($this->rpt[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data RPT berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'rpt';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Rencana Pasca Tambang RPT',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
