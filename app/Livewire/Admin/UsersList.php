<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Stmt\TryCatch;

class UsersList extends Component
{
    use WithPagination;

    public $search = '';
    public $pagelength = 10;
    public $user = '';

    #[Validate('required', message: 'Nama tidak boleh kosong')]
    public $name;
    #[Validate('required', message: 'Username tidak boleh kosong')]
    #[Validate('unique:users,username', message: 'Username Telah Terdaftar')]
    public $username;
    #[Validate('required', message: 'No HP tidak boleh kosong')]
    #[Validate('unique:users,nohp', message: 'No HP Telah Digunakan')]
    public $nohp;
    #[Validate('required', message: 'Email tidak boleh kosong')]
    #[Validate('email', message: 'Format Email Belum Benar, gunakan @')]
    public $email;
    public $password;

    public function resetSearch()
    {
        $this->reset('search');
    }

    public function resetForm()
    {
        $this->reset('name', 'username', 'nohp', 'email', 'password');
    }

    public function save()
    {
        $this->validate();
        if ($this->password == null) {
            $data = $this->only('name', 'username', 'nohp', 'email');
            $data['password'] = bcrypt($this->username);
            $data['role'] = 'admin';
        } else {
            $data = $this->only('name', 'username', 'nohp', 'email');
            $data['password'] = bcrypt($this->password);
            $data['role'] = 'admin';
        }
        // dd($data);
        try {
            User::create($data);
            $this->reset();
            $this->dispatch('user-created', message: 'Akun ' . $data['name'] . ' Berhasil Ditambahkan');
        } catch (\Exception $e) {
            $this->dispatch('user-add-error', message: 'Created User Error ' . $e->getMessage() . ' ERROR');
        }
    }

    public function getUserDelete($id)
    {
        $user = User::find($id);
        $user->delete();

        $this->dispatch('user-deleted', message: 'Akun ' . $user->name . ' Berhasil Dihapus');
    }

    public function render()
    {
        return view('livewire.admin.users-list', [
            'users' => User::search($this->search)
                ->orderBy('name')
                ->paginate($this->pagelength)
        ]);
    }
}
