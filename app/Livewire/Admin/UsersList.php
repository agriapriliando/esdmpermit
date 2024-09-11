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

    public function getUserDelete($id)
    {
        $this->user = User::find($id);
        // dd($this->user);
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
