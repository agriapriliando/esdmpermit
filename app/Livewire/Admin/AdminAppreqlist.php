<?php

namespace App\Livewire\Admin;

use App\Models\Appreq;
use App\Models\Company;
use App\Models\Stat;
use Livewire\Component;

class AdminAppreqlist extends Component
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
        return view('livewire.admin.admin-appreqlist', [
            'appreqs' => Appreq::with('user', 'company', 'stat', 'permitwork', 'docs')->search($this->search)
                ->when($this->stat_id, function ($query) {
                    $query->where('stat_id', $this->stat_id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->pagelength),
            'stats' => Stat::all(),
            'companies' => Company::all(),
        ]);
    }
}
