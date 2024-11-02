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
    public $search_admin = '';
    public $pagelength = 5;
    public $jenis_role;

    public $users_edit;
    // form user
    #[Validate('required', message: 'Nama tidak boleh kosong')]
    public $name;
    #[Validate('required', message: 'Username tidak boleh kosong')]
    #[Validate('alpha_dash', message: 'Username Tidak Boleh Memakai Spasi')]
    #[Validate('unique:users,username', message: 'Username Telah Digunakan')]
    public $username;
    #[Validate('required', message: 'No HP tidak boleh kosong')]
    public $nohp;
    #[Validate('required', message: 'Email tidak boleh kosong')]
    #[Validate('email', message: 'Format Email Belum Benar, gunakan @')]
    #[Validate('unique:users,email', message: 'Email Telah Digunakan')]
    public $email;
    public $password;
    public $role;

    public function resetSearch()
    {
        $this->reset('search');
    }
    public function resetSearchAdmin()
    {
        $this->reset('search_admin');
    }

    public function getUserDelete($id)
    {
        $user = User::find($id);
        $dataCompany = Company::where('user_id', $user->id)->first();
        if ($dataCompany != null) {
            $dataCompany->delete();
        }
        $user->delete();
        $this->reset();

        $this->dispatch('user-deleted', message: 'Akun ' . $user->name . ' Berhasil Dihapus');
    }

    public function userCreate()
    {
        $this->validate([
            'password' => 'required'
        ], [
            'password.required' => 'Password tidak boleh kosong',
        ]);
        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'nohp' => $this->nohp,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ];
        User::insert($data);
        session()->flash('successadmin', 'Akun ' . $this->name . ' Berhasil Ditambahkan');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.users-list', [
            'users' => User::with('company')->withCount('appreqs')
                ->search($this->search)
                ->orderBy('created_at', 'desc')
                ->whereRole('pemohon')
                ->orWhere('role', 'newuser')
                ->paginate($perPage = $this->pagelength, $columns = ['*'], $pageName = 'users'),
            'count_pemohon' => User::whereRole('pemohon')->count(),
            'count_admin' => User::where('role', '!=', 'pemohon')->count(),
            'admins' => User::where('role', '!=', 'pemohon')
                ->search($this->search_admin)
                ->paginate($perPage = 20, $columns = ['*'], $pageName = 'admins'),
        ]);
    }
}
