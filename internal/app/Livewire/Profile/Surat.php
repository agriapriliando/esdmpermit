<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Surat extends Component
{
    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;
    public function render()
    {
        $input_model_dokumen = 'surat';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                ->latest()
                ->paginate(5),
            'jenis_dokumens' => ['Surat Masuk', 'Surat Keluar'],
            'judul_menu' => 'Surat Menyurat',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
