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
    public $company_id;
    public $name_stat;
    public $stat;

    public function mount($name_stat)
    {
        $this->name_stat = $name_stat;
        $this->stat = Stat::where('name_stat', $name_stat)->first();
    }

    public function resetSearch()
    {
        $this->reset('search');
    }

    public function render()
    {
        return view('livewire.admin.admin-appreqlist', [
            'appreqs' => Appreq::with('user', 'company', 'stat', 'permitwork', 'docs')->search($this->search)
                ->when($this->company_id, function ($query) {
                    $query->where('company_id', $this->company_id);
                })
                ->where('stat_id', $this->stat->id)
                ->orderBy('created_at', 'desc')
                ->paginate($this->pagelength),
            'stats' => Stat::all(),
            'companies' => Company::all(),
        ]);
    }
}
