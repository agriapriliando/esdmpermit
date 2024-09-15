<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public function mount()
    {
        $this->dispatch('sidebar');
    }
    public function render()
    {
        return view('livewire.sidebar');
    }
}
