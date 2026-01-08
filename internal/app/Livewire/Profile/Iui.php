<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Iui as ModelsIui;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Iui extends Component
{
    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;

    public $iui = [];
    public $original = [];

    // field tambah data baru
    public $iui_no_izin;
    public $iui_tgl_izin;
    public $iui_status_permodalan_pmdn_pma;
    public $iui_kontrak_kerja_sama;

    public $editingId = null;

    protected $messages = [
        'iui.*.iui_no_izin.required' => 'Nomor izin wajib diisi.',
        'iui.*.iui_no_izin.string'   => 'Nomor izin harus berupa teks.',
        'iui.*.iui_no_izin.max'      => 'Nomor izin maksimal 255 karakter.',

        'iui.*.iui_tgl_izin.required' => 'Tanggal izin wajib diisi.',
        'iui.*.iui_tgl_izin.date'     => 'Tanggal izin tidak valid.',

        'iui.*.iui_status_permodalan_pmdn_pma.required' => 'Status permodalan wajib dipilih.',
        'iui.*.iui_status_permodalan_pmdn_pma.in'       => 'Status permodalan harus PMDN atau PMA.',

        'iui.*.iui_kontrak_kerja_sama.required' => 'Kontrak kerja sama wajib diisi.',
        'iui.*.iui_kontrak_kerja_sama.string'   => 'Kontrak kerja sama harus berupa teks.',
    ];

    public function mount()
    {
        $this->iui = ModelsIui::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->iui;
    }

    protected function rulesForRow($id)
    {
        return [
            "iui.$id.iui_no_izin" => 'required|string|max:255',
            "iui.$id.iui_tgl_izin" => 'required|date',
            "iui.$id.iui_status_permodalan_pmdn_pma" => 'required|in:PMDN,PMA',
            "iui.$id.iui_kontrak_kerja_sama" => 'required|string',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "iui_no_izin" => 'required|string|max:255',
            "iui_tgl_izin" => 'required|date',
            "iui_status_permodalan_pmdn_pma" => 'required|in:PMDN,PMA',
            "iui_kontrak_kerja_sama" => 'required|string',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsIui::create([
            'profile_id' => session('id_perusahaan'),
            'iui_no_izin' => $this->iui_no_izin,
            'iui_tgl_izin' => $this->iui_tgl_izin,
            'iui_status_permodalan_pmdn_pma' => $this->iui_status_permodalan_pmdn_pma,
            'iui_kontrak_kerja_sama' => $this->iui_kontrak_kerja_sama,
        ]);

        // refresh data
        $this->iui = ModelsIui::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->iui;

        $this->reset(['iui_no_izin', 'iui_tgl_izin', 'iui_status_permodalan_pmdn_pma', 'iui_kontrak_kerja_sama']);

        $this->dispatch('store-success', message: 'Data IUI baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->iui[$id];
        ModelsIui::find($id)->update($data);

        $this->original = ModelsIui::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data IUI berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->iui[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsIui::whereId($id)->delete();

        unset($this->iui[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data IUI berhasil dihapus!');
    }

    public function render()
    {
        $input_model_dokumen = 'iui';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'Izin Usaha Industri',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
