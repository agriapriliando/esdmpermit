<?php

namespace App\Livewire\Part;

use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $this->dispatch('sidebar');
        return view('livewire.part.sidebar');
    }
}
