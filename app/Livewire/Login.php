<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.applogin')]
class Login extends Component
{
    #[Validate('required', message: 'Username wajib diisi')]
    public $username;
    #[Validate('required', message: 'Password wajib diisi')]
    public $password;
    public $remember = false;
    public function login()
    {
        $this->validate();
        session()->invalidate();
        if (Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            $list_role = ['superadmin', 'admin'];
            if (in_array(Auth::user()->role, $list_role)) {
                return redirect()->route('admin.appreq', 'disposisi');
            } elseif (Auth::user()->role == 'disposisi') {
                return redirect()->route('admin.appreq', 'diajukan');
            } else {
                return redirect()->route('appreq.create');
            }
        } else {
            session()->flash('error', 'Username atau Password salah');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
