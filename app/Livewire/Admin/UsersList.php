<?php

namespace App\Livewire\Admin;

use App\Models\Company;
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
    public $title = 'Tambah Akun';

    #[Validate('required', message: 'Nama tidak boleh kosong')]
    public $name;
    #[Validate('required', message: 'Username tidak boleh kosong')]
    #[Validate('unique:users,username', message: 'Username Telah Terdaftar')]
    public $username;
    #[Validate('required', message: 'No HP tidak boleh kosong')]
    #[Validate('unique:users,nohp', message: 'No HP Telah Digunakan')]
    public $nohp;
    #[Validate('required', message: 'Email tidak boleh kosong')]
    #[Validate('unique:users,email', message: 'Email Telah digunakan')]
    #[Validate('email', message: 'Format Email Belum Benar, gunakan @')]
    public $email;
    public $password;
    public $role;
    public $id;

    public $jenis_role;

    public User $user;

    public $company_id;

    public $name_company;
    public $type_company;
    public $npwp_company;
    public $act_company;
    public $city_company;
    public $kecamatan_company;
    public $address_company;



    public function resetSearch()
    {
        $this->reset('search');
    }

    public function resetForm()
    {
        $this->title = 'Tambah Akun';
        $this->reset('name', 'username', 'nohp', 'email', 'password');
    }

    public function save($id = null)
    {
        if ($this->title == 'Tambah Akun') {
            $this->validate();
        } else {
            $dataUser = User::where('id', $id)->first();
            $this->validate([
                'name' => 'required',
                'username' => 'required|unique:users,username,' . $dataUser->id,
                'nohp' => 'required|numeric',
                'email' => 'required|email|unique:users,email,' . $dataUser->id,
            ]);
        }

        if ($this->password == null) {
            $data = $this->only('name', 'username', 'nohp', 'email');
            $data['password'] = bcrypt($this->username);
            $data['role'] = 'admin';
        } else {
            $data = $this->only('name', 'username', 'nohp', 'email');
            $data['password'] = bcrypt($this->password);
            $data['role'] = 'admin';
        }
        $data_company = [
            'name_company'
        ];

        if ($this->title == 'Tambah Akun') {
            try {
                $datauser = User::create($data);
                $this->reset();
                $this->dispatch('user-created', message: 'Akun ' . $data['name'] . ' Berhasil Ditambahkan');
            } catch (\Exception $e) {
                $this->dispatch('user-add-error', message: 'Created User Error ' . $e->getMessage() . ' ERROR');
            }
        } else {
            try {
                $dataUser->update($data);
                $this->reset();
                $this->dispatch('user-updated', message: 'Akun ' . $data['name'] . ' Berhasil Perbaharui');
            } catch (\Exception $e) {
                $this->dispatch('user-add-error', message: 'Updated User Error ' . $e->getMessage() . ' ERROR');
            }
        }
        // dd($data);
    }

    public function edit(User $user)
    {
        $this->title = 'Edit Akun';
        $this->id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->nohp = $user->nohp;
        $this->email = $user->email;
    }

    public function getUserDelete($id)
    {
        $user = User::find($id);
        $user->delete();

        $this->dispatch('user-deleted', message: 'Akun ' . $user->name . ' Berhasil Dihapus');
    }

    public function render()
    {
        // dd("AAAA");
        $data_region = Http::get('http://wilayah.test/wilayah.json');
        dd($data_region[0]);
        return view('livewire.admin.users-list', [
            'users' => User::search($this->search)
                ->when($this->jenis_role, function ($query) {
                    $query->where('role', $this->jenis_role);
                })
                ->orderBy('name')
                ->paginate($this->pagelength),
        ]);
    }
}
