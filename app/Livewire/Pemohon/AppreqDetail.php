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
    public $search_docs;

    public function mount($id)
    {
        $this->appreqdata = Appreq::find($id)->with('user', 'permitwork', 'company')->first();
        $this->correspondences = Correspondence::where('appreq_id', $this->appreqdata->id)->orderBy('created_at', 'DESC')->get();
    }

    public function resetSearchDocs()
    {
        $this->reset('search_docs');
    }

    public function render()
    {
        return view('livewire.pemohon.appreq-detail', [
            'docs' => Doc::where('appreq_id', $this->appreqdata['id'])
                ->when($this->search_docs, function ($query) {
                    $query->where('name_doc', 'like', "%" . $this->search_docs . "%");
                })
                ->orderBy('created_at', 'DESC')->get(),
        ]);
    }
}
