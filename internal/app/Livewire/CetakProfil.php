<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CetakProfil extends Component
{
    #[Layout('components.layouts.cetak')]
    public function render()
    {
        return view('livewire.cetak-profil');
    }
}
