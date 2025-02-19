<?php

namespace App\Livewire\Part;

use App\Models\Appreq;
use App\Models\Stat;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $operator_status_diajukan = Appreq::where('viewed_operator', 0)->where('stat_id', 1)->count();
        $operator_status_disposisi = Appreq::where('viewed_operator', 0)->where('stat_id', 2)->count();
        $evaluator_status_disposisi = Appreq::where('viewed_evaluator', 0)->where('stat_id', 2)->count();
        $evaluator_status_diproses = Appreq::where('viewed_evaluator', 0)->where('stat_id', 3)->count();
        $evaluator_status_perbaikan = Appreq::where('viewed_evaluator', 0)->where('stat_id', 4)->count();
        $evaluator_status_dibatalkan = Appreq::where('viewed_evaluator', 0)->where('stat_id', 5)->count();
        $evaluator_status_selesai = Appreq::where('viewed_evaluator', 0)->where('stat_id', 6)->count();
        return view('livewire.part.sidebar', [
            'stats' => Stat::all(),
            'operator_status_diajukan' => $operator_status_diajukan,
            'operator_status_disposisi' => $operator_status_disposisi,
            'evaluator_status_disposisi' => $evaluator_status_disposisi,
            'evaluator_status_diproses' => $evaluator_status_diproses,
            'evaluator_status_perbaikan' => $evaluator_status_perbaikan,
            'evaluator_status_dibatalkan' => $evaluator_status_dibatalkan,
            'evaluator_status_selesai' => $evaluator_status_selesai
        ]);
    }
}
