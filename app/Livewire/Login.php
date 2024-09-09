<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.applogin')]
class Login extends Component
{
    public function render()
    {
        return view('livewire.login');
    }
}
