<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Models\Profile;
use App\Models\Rkabop as ModelsRkabop;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Rkabop extends Component
{
    public $rkabop = [];
    public $original = [];

    // field tambah data baru
    public $rkabop_no_persetujuan;
    public $rkabop_tgl_persetujuan;

    // Sumber Daya Tahun I
    public $rkabop_sd_thn_i_m3_tereka;
    public $rkabop_sd_thn_i_m3_tertunjuk;
    public $rkabop_sd_thn_i_m3_terukur;
    public $rkabop_sd_thn_i_mt_tereka;
    public $rkabop_sd_thn_i_mt_tertunjuk;
    public $rkabop_sd_thn_i_mt_terukur;

    // Sumber Daya Tahun II
    public $rkabop_sd_thn_ii_m3_tereka;
    public $rkabop_sd_thn_ii_m3_tertunjuk;
    public $rkabop_sd_thn_ii_m3_terukur;
    public $rkabop_sd_thn_ii_mt_tereka;
    public $rkabop_sd_thn_ii_mt_tertunjuk;
    public $rkabop_sd_thn_ii_mt_terukur;

    // Sumber Daya Tahun III
    public $rkabop_sd_thn_iii_m3_tereka;
    public $rkabop_sd_thn_iii_m3_tertunjuk;
    public $rkabop_sd_thn_iii_m3_terukur;
    public $rkabop_sd_thn_iii_mt_tereka;
    public $rkabop_sd_thn_iii_mt_tertunjuk;
    public $rkabop_sd_thn_iii_mt_terukur;

    // Tenaga Ahli SD
    public $rkabop_sd_tenaga_ahli;

    // Cadangan
    public $rkabop_cadangan_thn_i_terkira;
    public $rkabop_cadangan_thn_i_terbukti;
    public $rkabop_cadangan_thn_ii_terkira;
    public $rkabop_cadangan_thn_ii_terbukti;
    public $rkabop_cadangan_thn_iii_terkira;
    public $rkabop_cadangan_thn_iii_terbukti;

    // Tenaga Ahli Cadangan
    public $rkabop_cadangan_tenaga_ahli;

    // Produksi Tahun I
    public $rkabop_prod_thn_i_target_m3_utama;
    public $rkabop_prod_thn_i_target_m3_sampingan;
    public $rkabop_prod_thn_i_realisasi_m3_utama;
    public $rkabop_prod_thn_i_realisasi_m3_sampingan;
    public $rkabop_prod_thn_i_target_mt_utama;
    public $rkabop_prod_thn_i_target_my_sampingan;
    public $rkabop_prod_thn_i_realisasi_mt_utama;
    public $rkabop_prod_thn_i_realisasi_mt_sampingan;

    // Produksi Tahun II
    public $rkabop_prod_thn_ii_target_m3_utama;
    public $rkabop_prod_thn_ii_target_m3_sampingan;
    public $rkabop_prod_thn_ii_realisasi_m3_utama;
    public $rkabop_prod_thn_ii_realisasi_m3_sampingan;
    public $rkabop_prod_thn_ii_target_mt_utama;
    public $rkabop_prod_thn_ii_target_my_sampingan;
    public $rkabop_prod_thn_ii_realisasi_mt_utama;
    public $rkabop_prod_thn_ii_realisasi_mt_sampingan;

    // Produksi Tahun III
    public $rkabop_prod_thn_iii_target_m3_utama;
    public $rkabop_prod_thn_iii_target_m3_sampingan;
    public $rkabop_prod_thn_iii_realisasi_m3_utama;
    public $rkabop_prod_thn_iii_realisasi_m3_sampingan;
    public $rkabop_prod_thn_iii_target_mt_utama;
    public $rkabop_prod_thn_iii_target_my_sampingan;
    public $rkabop_prod_thn_iii_realisasi_mt_utama;
    public $rkabop_prod_thn_iii_realisasi_mt_sampingan;

    // Pajak
    public $rkabop_pajak_thn_i_daerah;
    public $rkabop_pajak_thn_i_opsen;
    public $rkabop_pajak_thn_ii_daerah;
    public $rkabop_pajak_thn_ii_opsen;
    public $rkabop_pajak_thn_iii_daerah;
    public $rkabop_pajak_thn_iii_opsen;

    // Tenaga Kerja Tahun I
    public $rkabop_tenaga_kerja_thn_i_lokal;
    public $rkabop_tenaga_kerja_thn_i_non_lokal;
    public $rkabop_tenaga_kerja_thn_i_tka;

    // Tenaga Kerja Tahun II
    public $rkabop_tenaga_kerja_thn_ii_lokal;
    public $rkabop_tenaga_kerja_thn_ii_non_lokal;
    public $rkabop_tenaga_kerja_thn_ii_tka;

    // Tenaga Kerja Tahun III
    public $rkabop_tenaga_kerja_thn_iii_lokal;
    public $rkabop_tenaga_kerja_thn_iii_non_lokal;
    public $rkabop_tenaga_kerja_thn_iii_tka;

    public $editingId = null;

    protected $messages = [
        'rkabop.*.rkabop_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'rkabop.*.rkabop_tgl_persetujuan.required' => 'Tanggal persetujuan wajib diisi.',
        'rkabop.*.rkabop_tgl_persetujuan.date'     => 'Tanggal persetujuan tidak valid.',

        'rkabop_no_persetujuan.required' => 'Nomor persetujuan wajib diisi.',
        'rkabop_tgl_persetujuan.required' => 'Tanggal persetujuan wajib diisi.',
        'rkabop_tgl_persetujuan.date'     => 'Tanggal persetujuan tidak valid.',
    ];

    public function mount()
    {
        $this->rkabop = ModelsRkabop::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rkabop;
    }

    protected function rulesForRow($id)
    {
        return [
            "rkabop.$id.rkabop_no_persetujuan" => 'required',
            "rkabop.$id.rkabop_tgl_persetujuan" => 'required|date',
        ];
    }

    protected function rulesForNew()
    {
        return [
            "rkabop_no_persetujuan" => 'required',
            "rkabop_tgl_persetujuan" => 'required|date',
        ];
    }

    public function store()
    {
        $this->validate($this->rulesForNew());

        ModelsRkabop::create([
            'profile_id' => session('id_perusahaan'),
            'rkabop_no_persetujuan' => $this->rkabop_no_persetujuan,
            'rkabop_tgl_persetujuan' => $this->rkabop_tgl_persetujuan,

            // Sumber Daya Tahun I
            'rkabop_sd_thn_i_m3_tereka' => $this->rkabop_sd_thn_i_m3_tereka,
            'rkabop_sd_thn_i_m3_tertunjuk' => $this->rkabop_sd_thn_i_m3_tertunjuk,
            'rkabop_sd_thn_i_m3_terukur' => $this->rkabop_sd_thn_i_m3_terukur,
            'rkabop_sd_thn_i_mt_tereka' => $this->rkabop_sd_thn_i_mt_tereka,
            'rkabop_sd_thn_i_mt_tertunjuk' => $this->rkabop_sd_thn_i_mt_tertunjuk,
            'rkabop_sd_thn_i_mt_terukur' => $this->rkabop_sd_thn_i_mt_terukur,

            // Sumber Daya Tahun II
            'rkabop_sd_thn_ii_m3_tereka' => $this->rkabop_sd_thn_ii_m3_tereka,
            'rkabop_sd_thn_ii_m3_tertunjuk' => $this->rkabop_sd_thn_ii_m3_tertunjuk,
            'rkabop_sd_thn_ii_m3_terukur' => $this->rkabop_sd_thn_ii_m3_terukur,
            'rkabop_sd_thn_ii_mt_tereka' => $this->rkabop_sd_thn_ii_mt_tereka,
            'rkabop_sd_thn_ii_mt_tertunjuk' => $this->rkabop_sd_thn_ii_mt_tertunjuk,
            'rkabop_sd_thn_ii_mt_terukur' => $this->rkabop_sd_thn_ii_mt_terukur,

            // Sumber Daya Tahun III
            'rkabop_sd_thn_iii_m3_tereka' => $this->rkabop_sd_thn_iii_m3_tereka,
            'rkabop_sd_thn_iii_m3_tertunjuk' => $this->rkabop_sd_thn_iii_m3_tertunjuk,
            'rkabop_sd_thn_iii_m3_terukur' => $this->rkabop_sd_thn_iii_m3_terukur,
            'rkabop_sd_thn_iii_mt_tereka' => $this->rkabop_sd_thn_iii_mt_tereka,
            'rkabop_sd_thn_iii_mt_tertunjuk' => $this->rkabop_sd_thn_iii_mt_tertunjuk,
            'rkabop_sd_thn_iii_mt_terukur' => $this->rkabop_sd_thn_iii_mt_terukur,

            // Tenaga Ahli SD
            'rkabop_sd_tenaga_ahli' => $this->rkabop_sd_tenaga_ahli,

            // Cadangan
            'rkabop_cadangan_thn_i_terkira' => $this->rkabop_cadangan_thn_i_terkira,
            'rkabop_cadangan_thn_i_terbukti' => $this->rkabop_cadangan_thn_i_terbukti,
            'rkabop_cadangan_thn_ii_terkira' => $this->rkabop_cadangan_thn_ii_terkira,
            'rkabop_cadangan_thn_ii_terbukti' => $this->rkabop_cadangan_thn_ii_terbukti,
            'rkabop_cadangan_thn_iii_terkira' => $this->rkabop_cadangan_thn_iii_terkira,
            'rkabop_cadangan_thn_iii_terbukti' => $this->rkabop_cadangan_thn_iii_terbukti,

            // Tenaga Ahli Cadangan
            'rkabop_cadangan_tenaga_ahli' => $this->rkabop_cadangan_tenaga_ahli,

            // Produksi Tahun I
            'rkabop_prod_thn_i_target_m3_utama' => $this->rkabop_prod_thn_i_target_m3_utama,
            'rkabop_prod_thn_i_target_m3_sampingan' => $this->rkabop_prod_thn_i_target_m3_sampingan,
            'rkabop_prod_thn_i_realisasi_m3_utama' => $this->rkabop_prod_thn_i_realisasi_m3_utama,
            'rkabop_prod_thn_i_realisasi_m3_sampingan' => $this->rkabop_prod_thn_i_realisasi_m3_sampingan,
            'rkabop_prod_thn_i_target_mt_utama' => $this->rkabop_prod_thn_i_target_mt_utama,
            'rkabop_prod_thn_i_target_my_sampingan' => $this->rkabop_prod_thn_i_target_my_sampingan,
            'rkabop_prod_thn_i_realisasi_mt_utama' => $this->rkabop_prod_thn_i_realisasi_mt_utama,
            'rkabop_prod_thn_i_realisasi_mt_sampingan' => $this->rkabop_prod_thn_i_realisasi_mt_sampingan,

            // Produksi Tahun II
            'rkabop_prod_thn_ii_target_m3_utama' => $this->rkabop_prod_thn_ii_target_m3_utama,
            'rkabop_prod_thn_ii_target_m3_sampingan' => $this->rkabop_prod_thn_ii_target_m3_sampingan,
            'rkabop_prod_thn_ii_realisasi_m3_utama' => $this->rkabop_prod_thn_ii_realisasi_m3_utama,
            'rkabop_prod_thn_ii_realisasi_m3_sampingan' => $this->rkabop_prod_thn_ii_realisasi_m3_sampingan,
            'rkabop_prod_thn_ii_target_mt_utama' => $this->rkabop_prod_thn_ii_target_mt_utama,
            'rkabop_prod_thn_ii_target_my_sampingan' => $this->rkabop_prod_thn_ii_target_my_sampingan,
            'rkabop_prod_thn_ii_realisasi_mt_utama' => $this->rkabop_prod_thn_ii_realisasi_mt_utama,
            'rkabop_prod_thn_ii_realisasi_mt_sampingan' => $this->rkabop_prod_thn_ii_realisasi_mt_sampingan,

            // Produksi Tahun III
            'rkabop_prod_thn_iii_target_m3_utama' => $this->rkabop_prod_thn_iii_target_m3_utama,
            'rkabop_prod_thn_iii_target_m3_sampingan' => $this->rkabop_prod_thn_iii_target_m3_sampingan,
            'rkabop_prod_thn_iii_realisasi_m3_utama' => $this->rkabop_prod_thn_iii_realisasi_m3_utama,
            'rkabop_prod_thn_iii_realisasi_m3_sampingan' => $this->rkabop_prod_thn_iii_realisasi_m3_sampingan,
            'rkabop_prod_thn_iii_target_mt_utama' => $this->rkabop_prod_thn_iii_target_mt_utama,
            'rkabop_prod_thn_iii_target_my_sampingan' => $this->rkabop_prod_thn_iii_target_my_sampingan,
            'rkabop_prod_thn_iii_realisasi_mt_utama' => $this->rkabop_prod_thn_iii_realisasi_mt_utama,
            'rkabop_prod_thn_iii_realisasi_mt_sampingan' => $this->rkabop_prod_thn_iii_realisasi_mt_sampingan,

            // Pajak
            'rkabop_pajak_thn_i_daerah' => $this->rkabop_pajak_thn_i_daerah,
            'rkabop_pajak_thn_i_opsen' => $this->rkabop_pajak_thn_i_opsen,
            'rkabop_pajak_thn_ii_daerah' => $this->rkabop_pajak_thn_ii_daerah,
            'rkabop_pajak_thn_ii_opsen' => $this->rkabop_pajak_thn_ii_opsen,
            'rkabop_pajak_thn_iii_daerah' => $this->rkabop_pajak_thn_iii_daerah,
            'rkabop_pajak_thn_iii_opsen' => $this->rkabop_pajak_thn_iii_opsen,

            // Tenaga Kerja Tahun I
            'rkabop_tenaga_kerja_thn_i_lokal' => $this->rkabop_tenaga_kerja_thn_i_lokal,
            'rkabop_tenaga_kerja_thn_i_non_lokal' => $this->rkabop_tenaga_kerja_thn_i_non_lokal,
            'rkabop_tenaga_kerja_thn_i_tka' => $this->rkabop_tenaga_kerja_thn_i_tka,

            // Tenaga Kerja Tahun II
            'rkabop_tenaga_kerja_thn_ii_lokal' => $this->rkabop_tenaga_kerja_thn_ii_lokal,
            'rkabop_tenaga_kerja_thn_ii_non_lokal' => $this->rkabop_tenaga_kerja_thn_ii_non_lokal,
            'rkabop_tenaga_kerja_thn_ii_tka' => $this->rkabop_tenaga_kerja_thn_ii_tka,

            // Tenaga Kerja Tahun III
            'rkabop_tenaga_kerja_thn_iii_lokal' => $this->rkabop_tenaga_kerja_thn_iii_lokal,
            'rkabop_tenaga_kerja_thn_iii_non_lokal' => $this->rkabop_tenaga_kerja_thn_iii_non_lokal,
            'rkabop_tenaga_kerja_thn_iii_tka' => $this->rkabop_tenaga_kerja_thn_iii_tka,
        ]);

        // refresh data
        $this->rkabop = ModelsRkabop::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->original = $this->rkabop;

        $this->reset(
            array_diff((new ModelsRkabop)->getFillable(), ['profile_id'])
        ); // reset semua property

        $this->dispatch('store-success', message: 'Data RKABOP baru berhasil ditambahkan!');
    }

    public function update($id)
    {
        $this->validate($this->rulesForRow($id));

        $data = $this->rkabop[$id];
        ModelsRkabop::find($id)->update($data);

        $this->original = ModelsRkabop::where('profile_id', session('id_perusahaan'))
            ->latest()
            ->get()
            ->keyBy('id')
            ->toArray();

        $this->dispatch('update-success', message: 'Data RKABOP berhasil diperbaharui!');
        $this->editingId = null;
    }

    public function batal($id)
    {
        if (isset($this->original[$id])) {
            $this->rkabop[$id] = $this->original[$id];
        }
        $this->editingId = null;
    }

    public function delete($id)
    {
        ModelsRkabop::whereId($id)->delete();

        unset($this->rkabop[$id]);
        unset($this->original[$id]);

        $this->dispatch('delete-success', message: 'Data RKABOP berhasil dihapus!');
    }

    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'rkabop';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Persetujuan', 'Non Persetujuan'],
            'judul_menu' => 'RKAB',
            'jenis_tahapan' => Profile::find(session('id_perusahaan'))->tahapan_iup,
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
