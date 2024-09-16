<?php

namespace App\Livewire\Pemohon;

use App\Models\Appreq;
use App\Models\Correspondence;
use App\Models\Doc;
use App\Models\Permitwork;
use Livewire\Component;

class AppreqDetail extends Component
{
    public Appreq $appreq;

    public $appreqdata;
    public $correspondences;
    public $docs;

    public function mount($id)
    {
        $this->appreqdata = Appreq::find($id)->with('user', 'permitwork', 'company')->first();
        $this->correspondences = Correspondence::where('appreq_id', $this->appreqdata->id)->orderBy('created_at', 'DESC')->get();
        $this->docs = Doc::where('appreq_id', $this->appreqdata->id)->orderBy('created_at', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.pemohon.appreq-detail');
    }
}
