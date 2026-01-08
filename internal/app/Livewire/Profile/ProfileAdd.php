<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use Livewire\Component;

class ProfileAdd extends Component
{
    public $nama_pemegang_perizinan;
    public $kabupaten_kota;
    public $kecamatan;
    public $desa_kelurahan;
    public $luas_ha;
    public $tahapan_iup;
    public $komoditas;
    public $nomor_induk_berusaha_nib;
    public $nomor_npwp;
    public $status_npwp;
    public $jenis_izin;
    public $nomor_sk_izin;
    public $tgl_terbit_izin;
    public $tgl_berakhir_izin;
    public $alamat_perusahaan_berdasarkan_sk_izin;
    public $nama_direktur_sesuai_sk_izin;
    public $dewan_direksi_bod;
    public $modal_kerja;
    public $nama_pic;
    public $no_hp_pic;
    public $email_resmi_perusahaan;
    public $nib_email_oss;
    public $nib_nomor_hp_oss;
    public $keterangan;
    public $kontrak_kerja_sama;
    public $jenis_bidang_sub_bidang_usaha_jasa;

    protected $rules = [
        'nama_pemegang_perizinan' => 'required|string|max:255',
        'kabupaten_kota' => 'nullable|string|max:255',
        'kecamatan' => 'nullable|string|max:255',
        'desa_kelurahan' => 'nullable|string|max:255',
        'luas_ha' => 'nullable|max:11',
        'tahapan_iup' => 'nullable|string|max:255',
        'komoditas' => 'nullable|string|max:255',
        'nomor_induk_berusaha_nib' => 'nullable|string|max:255',
        'nomor_npwp' => 'nullable|string|max:255',
        'status_npwp' => 'nullable|string|max:255',
        'jenis_izin' => 'nullable|string|max:255',
        'nomor_sk_izin' => 'nullable|string|max:255',
        'tgl_terbit_izin' => 'nullable|date',
        'tgl_berakhir_izin' => 'nullable|date',
        'alamat_perusahaan_berdasarkan_sk_izin' => 'nullable|string',
        'nama_direktur_sesuai_sk_izin' => 'nullable|string|max:255',
        'dewan_direksi_bod' => 'nullable|string',
        'modal_kerja' => 'nullable',
        'nama_pic' => 'nullable|string|max:255',
        'no_hp_pic' => 'nullable|string|max:50',
        'email_resmi_perusahaan' => 'nullable|email|max:255',
        'nib_email_oss' => 'nullable|email|max:255',
        'nib_nomor_hp_oss' => 'nullable|string|max:50',
        'keterangan' => 'nullable|string',
        'kontrak_kerja_sama' => 'nullable|string',
        'jenis_bidang_sub_bidang_usaha_jasa' => 'nullable|string',
    ];

    public function store()
    {
        $validated = $this->validate();

        Profile::create($validated);

        $this->dispatch('store-success', message: 'Profil Perusahaan berhasil ditambahkan!');

        // reset input
        $this->reset();
    }

    public function render()
    {
        return view('livewire.profile.profile-add');
    }
}
