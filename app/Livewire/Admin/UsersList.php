<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    public $search = '';
    public $pagelength = 10;
    public $user = '';

    public $name;
    public $username;
    public $nohp;
    public $email;
    public $password;

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
