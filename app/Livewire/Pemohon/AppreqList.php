<?php

namespace App\Livewire\Pemohon;

use App\Models\Appreq;
use App\Models\Doc;
use App\Models\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use PhpParser\Node\Stmt\TryCatch;

class AppreqList extends Component
{
    public $search = '';
    public $pagelength = 10;
    public $stat_id;

    public function resetSearch()
    {
        $this->reset();
    }

    public function delete($ver_code)
    {
        try {
            // cari appreq by ver_code
            $appreq = Appreq::where('ver_code', $ver_code)->first();
            $docs = Doc::where('appreq_id', $appreq->id)->get();
            foreach ($docs as $doc) {
                Storage::delete('public/file_doc/' . $doc->file_name);
            }
            Doc::where('appreq_id', $appreq->id)->delete();
            $appreq->delete();
            session()->flash('delete', "Pengajuan Berhasil Dibatalkan");
        } catch (\Exception $e) {
            session()->flash('delete', $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.pemohon.appreq-list', [
            'appreqs' => Appreq::with('user', 'company', 'stat', 'permitwork', 'docs')->search($this->search)
                ->when($this->stat_id, function ($query) {
                    $query->where('stat_id', $this->stat_id);
                })
                ->where('stat_id', '!=', 4)
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate($this->pagelength),
            'stats' => Stat::all()
        ]);
    }
}
