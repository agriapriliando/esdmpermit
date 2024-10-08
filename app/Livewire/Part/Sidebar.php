<?php

namespace App\Livewire\Part;

use App\Models\Stat;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.part.sidebar', [
            'stats' => Stat::all()
        ]);
    }
}
