<?php

namespace App\Traits;

use App\Models\Dokumen;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

trait WithDokumen
{
    protected $paginationTheme = 'bootstrap';
    #[Validate('required|max:150000')]
    public $file;
    public $jenis_dokumen = '';
    public $searchdok;

    public function saveDokumen($model = 'profil')
    {
        if ($model == 'pelaporan') {
            $this->validate([
                'file'          => 'required|file|max:150000',
                'jenis_dokumen' => 'required|string|max:150',
            ]);
        } else {
            $this->validate([
                'file'          => 'required|file|max:10240',
                'jenis_dokumen' => 'required|string|max:150',
            ]);
        }

        $path = $this->file->store('dokumens/' . session('id_perusahaan'));

        Dokumen::create([
            'profile_id'    => session('id_perusahaan'),
            'model_dokumen' => $model,
            'jenis_dokumen' => $this->jenis_dokumen,
            'judul_dokumen' => pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME),
            'ket_dokumen'   => null,
            // 'link_dokumen'  => 'storage/' . $path, untuk folder public
            'link_dokumen'  => $path,
            'size_dokumen'  => $this->file->getSize(),
            'ext_dokumen'   => $this->file->getClientOriginalExtension(),
        ]);

        $this->reset(['file', 'jenis_dokumen']);

        session()->flash('success', 'Dokumen berhasil diunggah!');
    }

    public function downloadDokumen($id)
    {
        // $dokumen = Dokumen::find($id);

        // if (!$dokumen) {
        //     session()->flash('error', 'Dokumen tidak ditemukan.');
        //     return;
        // }
        // untuk langsung download
        // return Storage::download($dokumen->link_dokumen);

        $dokumen = Dokumen::findOrFail($id);
        $filePath = storage_path('app/private/' . $dokumen->link_dokumen);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
        ]);
    }

    public function deleteDokumen($id)
    {
        $dokumen = Dokumen::find($id);

        if (!$dokumen) {
            session()->flash('error', 'Dokumen tidak ditemukan.');
            return;
        }

        if ($dokumen->link_dokumen && Storage::disk('local')->exists(str_replace('storage/', '', $dokumen->link_dokumen))) {
            Storage::disk('local')->delete(str_replace('storage/', '', $dokumen->link_dokumen));
        }

        $dokumen->delete();

        session()->flash('success', 'Dokumen berhasil dihapus.');
    }

    public function updatedSearchdok()
    {
        $this->resetPage();
    }
}
