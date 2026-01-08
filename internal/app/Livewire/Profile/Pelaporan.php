<?php

namespace App\Livewire\Profile;

use App\Models\Dokumen;
use App\Traits\WithDokumen;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Pelaporan extends Component
{
    // untuk dokumen
    use WithFileUploads, WithPagination, WithDokumen;

    public function updatedSearchdok()
    {
        $this->resetPage();
    }
    public function render()
    {
        $input_model_dokumen = 'pelaporan';
        return view('livewire.profile.' . $input_model_dokumen, [
            'dokumens' => Dokumen::where('profile_id', session('id_perusahaan'))
                ->where('model_dokumen', $input_model_dokumen)
                ->where(function ($query) {
                    $query->where('judul_dokumen', 'like', '%' . $this->searchdok . '%')
                        ->orWhere('jenis_dokumen', 'like', '%' . $this->searchdok . '%');
                })
                ->latest()
                ->paginate(5),
            // ambil daftar unik jenis_dokumen
            'jenis_dokumens' => Dokumen::where('model_dokumen', $input_model_dokumen)
                ->select('jenis_dokumen')
                ->distinct()
                ->pluck('jenis_dokumen')
                ->toArray(),
            'judul_menu' => 'Pelaporan',
            'input_model_dokumen' => $input_model_dokumen,
        ]);
    }
}
