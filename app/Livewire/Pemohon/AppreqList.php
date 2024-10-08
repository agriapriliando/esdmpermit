<?php

namespace App\Livewire\Pemohon;

use App\Models\Appreq;
use App\Models\Stat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppreqList extends Component
{
    public $search = '';
    public $pagelength = 10;
    public $stat_id;

    public function resetSearch()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pemohon.appreq-list', [
            'appreqs' => Appreq::with('user', 'company', 'stat', 'permitwork', 'docs')->search($this->search)
                ->when($this->stat_id, function ($query) {
                    $query->where('stat_id', $this->stat_id);
                })
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate($this->pagelength),
            'stats' => Stat::all()
        ]);
    }
}
