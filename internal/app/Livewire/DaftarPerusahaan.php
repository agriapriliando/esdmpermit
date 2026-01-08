<?php

namespace App\Livewire;

use App\Models\Dokumen;
use App\Models\Profile;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarPerusahaan extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public $komoditasSearch = '';
    public $kabupaten_kotaSearch = '';
    public $jenis_izin;

    public $toogleDelete = false;
    public function mount()
    {
        session(['id_perusahaan' => null]);
        session(['nama_pemegang_perizinan' => null]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingKomoditasSearch()
    {
        $this->resetPage();
    }
    public function updatingKabupaten_kotaSearch()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->komoditasSearch = '';
        $this->kabupaten_kotaSearch = '';
        $this->jenis_izin = '';
        $this->perPage = 10;
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingJenis_izin()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $profile = Profile::find($id);
        Dokumen::where('profile_id', $id)->delete();
        $path = storage_path('app/public/dokumens/' . $id); // contoh path folder

        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
        $nama_pemegang_perizinan = $profile->nama_pemegang_perizinan;
        $profile->delete();
        $this->resetPage();
        $this->dispatch('delete-success', message: 'Data ' . $nama_pemegang_perizinan . ' berhasil dihapus!');
    }
    public function render()
    {
        return view('livewire.daftar-perusahaan', [
            'profiles' => Profile::search($this->search)
                ->komoditas($this->komoditasSearch)
                ->kabupaten_kota($this->kabupaten_kotaSearch)
                ->jenis_izin($this->jenis_izin)
                ->latest()
                ->paginate($this->perPage),
            'komoditas' => Profile::select('komoditas')->distinct()->pluck('komoditas', 'komoditas'),
            'kabupaten_kota' => Profile::select('kabupaten_kota')->distinct()->pluck('kabupaten_kota', 'kabupaten_kota'),
        ]);
    }
}
