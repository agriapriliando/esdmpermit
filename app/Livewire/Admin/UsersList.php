<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use App\Models\Region;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    public $search = '';
    public $pagelength = 10;
    public $jenis_role;

    public function resetSearch()
    {
        $this->reset('search');
    }

    public function getUserDelete($id)
    {
        $user = User::find($id);
        $dataCompany = Company::where('user_id', $user->id)->first();
        $dataCompany->delete();
        $user->delete();
        $this->reset();

        $this->dispatch('user-deleted', message: 'Akun ' . $user->name . ' Berhasil Dihapus');
    }


    public function render()
    {
        $datacities = Region::where('parent_region', '62')->get();
        // dd($data);
        return view('livewire.admin.users-list', [
            'users' => User::with('company')
                ->search($this->search)
                ->when($this->jenis_role, function ($query) {
                    $query->where('role', $this->jenis_role);
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->pagelength),
            'cities' => $datacities
        ]);
    }
}
