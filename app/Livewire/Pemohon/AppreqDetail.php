<?php

namespace App\Livewire\Pemohon;

use App\Models\Appreq;
use App\Models\Permitwork;
use Livewire\Component;

class AppreqDetail extends Component
{
    public Appreq $appreq;

    public $appreqdata;

    public function mount($id)
    {
        $this->appreqdata = Appreq::find($id)->with('user', 'permitwork', 'company')->first();
    }

    public function render()
    {
        return view('livewire.pemohon.appreq-detail');
    }
}
