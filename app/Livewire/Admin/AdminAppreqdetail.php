<?php

namespace App\Livewire\Admin;

use App\Models\Appreq;
use App\Models\Correspondence;
use App\Models\Doc;
use App\Models\Stat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAppreqdetail extends Component
{
    use WithFileUploads;

    #[Validate(
        [
            'file_upload.*' => 'extensions:pdf,doc,docx,xls,xlsx,jpeg,jpg,zip,rar|max:15000'
        ],
        message: [
            'max' => 'Ukuran 1 Berkas Tidak Boleh Melebihi 6MB',
            'extensions' => 'Silahkan Memilih Berkas dengan Format : pdf,doc,docx,xls,xlsx,jpeg,jpg',
        ]
    )]
    public Appreq $appreq;

    public $appreqid;
    public $search_docs;

    public $desc;

    public $file_upload = [];

    public $stat_id;

    public $openpdf = false;

    public function mount(Appreq $appreq)
    {
        $this->appreqid = $appreq->id;
        $this->stat_id = $appreq->stat_id;
        // update otomatis setelah detail pengajuan dibuka
        // merubah status pengajuan menjadi telah dilihat
        // jika dibuka oleh akun operator dan status masih diajukan
        if (Auth::user()->role == 'operator' && $appreq->stat_id == 1) {
            // ubah status ke id 2
            $appreq->update([
                'stat_id' => 2,
                'date_disposisi' => Carbon::now(),
                'user_disposisi' => Auth::id(),
                'viewed_operator' => 1,
                'viewed_evaluator' => 0
            ]);
        }
        if ($appreq->stat_id == 2 && Auth::user()->role == 'evaluator') {
            // ubah status ke id 3 diproses
            $appreq->update([
                'stat_id' => 3,
                'date_processed' => Carbon::now(),
                'user_processed' => Auth::id(),
                'viewed_evaluator' => 1,
            ]);
        }
        if (($appreq->stat_id == 2 || $appreq->stat_id == 3 || $appreq->stat_id == 4) && Auth::user()->role == 'evaluator' && $appreq->viewed_evaluator == 0) {
            // jika belum dibuka oleh operator
            $appreq->update([
                'viewed_evaluator' => 1,
            ]);
        }
        if (Auth::user()->role != 'adminutama') {
            // cek pesan, otomatis viewed saat detail pengajuan dibuka
            Correspondence::where('appreq_id', $this->appreqid)
                ->where('viewed', 0)
                ->where('user_id', '!=', Auth::id())
                ->where('sender', 1)
                ->update([
                    'viewed' => 1
                ]);
            Doc::where('appreq_id', $this->appreqid)
                ->where('viewed', 0)
                ->where('sender', 1)
                ->update([
                    'viewed' => 1
                ]);
        }
    }

    public function deleteAppreq()
    {
        Correspondence::where('appreq_id', $this->appreqid)->delete();
        Doc::where('appreq_id', $this->appreqid)->delete();
        $this->appreq->delete();
        session()->flash('delete', "Detail Pengajuan Berhasil Dihapus");
        return redirect('/admin/dibatalkan');
    }

    public function resetFileupload()
    {
        $this->file_upload = '';
    }

    public function resetSearchDocs()
    {
        $this->reset('search_docs');
    }

    public function updatedFileUpload()
    {
        $this->validate();
    }

    public function savestat()
    {
        // dd($this->appreq->stat_id);
        $this->appreq->update([
            'stat_id' => $this->stat_id
        ]);
        if ($this->stat_id == 2) { //disposisi
            $this->appreq->update([
                'date_disposisi' => Carbon::now(),
                'user_disposisi' => Auth::id()
            ]);
        }
        if ($this->stat_id == 4) { //perbaikan
            $this->appreq->update([
                'date_revision' => Carbon::now(),
                'user_revision' => Auth::id()
            ]);
        }
        if ($this->stat_id == 5) { //batal
            $this->appreq->update([
                'date_rejected' => Carbon::now(),
                'user_rejected' => Auth::id()
            ]);
        }
        if ($this->stat_id == 6) { //finished
            $this->appreq->update([
                'date_finished' => Carbon::now(),
                'user_finished' => Auth::id()
            ]);
        }
        session()->flash('savestat', "Status Pengajuan Berhasil Diubah");
    }

    public function uploadFile()
    {
        foreach ($this->file_upload as $file) {
            // generate nama file
            // get extensi file
            $ext = "." . $file->extension();
            $oriName = strtolower(str_replace(" ", "_", $file->getClientOriginalName()));
            // format bulan/tahun/tgl random 3angka id_user
            $fileName = Carbon::now()->format('mYjHi') . rand(111, 999) . "1";
            // gabung nama file dan extensi
            $fileNames = $fileName . $ext;
            // simpan file
            $file->storeAs('file_doc', $fileNames, 'public');
            // masukan semua nama file ke array
            Doc::create([
                'user_id' => Auth::id(),
                'appreq_id' => $this->appreqid,
                'name_doc' => $oriName,
                'type_doc' => 'File',
                'file_name' => $fileName . $ext,
                'sender' => 0,
                'viewed' => 0
            ]);
        }
        $this->appreq->update([
            'viewed_pemohon' => 0
        ]);
    }

    public function deletePesan($cor_id)
    {
        $cor = Correspondence::find($cor_id);
        $cor->delete();
        session()->flash('deletec', "Pesan Dihapus");
    }

    public function deleteDoc($doc_id)
    {
        $doc = Doc::find($doc_id);
        Storage::delete('public/file_doc/' . $doc->file_name);
        $doc->delete();
        session()->flash('delete', $doc->name_doc . " Berhasil Dihapus");
    }

    public function save()
    {
        // dd($this->file_upload);
        $this->validate();
        $data = [
            'user_id' => Auth::id(),
            'appreq_id' => $this->appreqid,
            'desc' => $this->desc,
            'sender' => 0
        ];
        if ($this->desc != null) {
            Correspondence::create($data);
        }
        if ($this->file_upload != null) {
            $this->uploadFile();
        }
        $this->reset('file_upload', 'desc');
    }

    public function render()
    {
        // cek pesan, otomatis viewed saat detail pengajuan dibuka
        Correspondence::where('appreq_id', $this->appreqid)
            ->where('viewed', 0)
            ->where('user_id', '!=', Auth::id())
            ->where('sender', 1)
            ->update([
                'viewed' => 1
            ]);
        Doc::where('appreq_id', $this->appreqid)
            ->where('viewed', 0)
            ->where('sender', 1)
            ->update([
                'viewed' => 1
            ]);
        //jika yang membuka operator, status disposisi, belum dibuka operator
        if (Auth::user()->role == 'operator' && $this->appreq->stat_id == 2 && $this->appreq->viewed_operator == 0) {
            // ubah status ke id 2
            $this->appreq->update([
                'stat_id' => 2,
                'date_disposisi' => Carbon::now(),
                'user_disposisi' => Auth::id(),
                'viewed_operator' => 1
            ]);
        }
        // dd($this->appreq);
        //list status
        // jika user operator
        if (Auth::user()->role == 'operator') {
            //dapatkan status disposisi
            $stat = Stat::where('id', 2)->get();
        } elseif (Auth::user()->role == 'evaluator') {
            $stat = Stat::all();
        } else {
            // dapatkan status selain disposisi dan diajukan
            $stat = Stat::where('id', '!=', 1)->where('id', '!=', 2)->get();
        }
        // kode jika belum ada histori nama pengguna yang merubah status permohonan
        if ($this->appreq->user_disposisi != null) {
            $user_disposisi = User::findOrFail($this->appreq->user_disposisi);
        } else {
            $user_disposisi = [
                'name' => null
            ];
        }
        if ($this->appreq->user_processed != null) {
            $user_processed = User::findOrFail($this->appreq->user_processed);
        } else {
            $user_processed = [
                'name' => null
            ];
        }
        if ($this->appreq->user_revision != null) {
            $user_revision = User::findOrFail($this->appreq->user_revision);
        } else {
            $user_revision = [
                'name' => null
            ];
        }
        if ($this->appreq->user_finished != null) {
            $user_finished = User::findOrFail($this->appreq->user_finished);
        } else {
            $user_finished = [
                'name' => null
            ];
        }
        if ($this->appreq->user_rejected != null) {
            $user_rejected = User::findOrFail($this->appreq->user_rejected);
        } else {
            $user_rejected = [
                'name' => null
            ];
        }
        return view('livewire.admin.admin-appreqdetail', [
            'docs' => Doc::where('appreq_id', $this->appreqid)
                ->when($this->search_docs, function ($query) {
                    $query->where('name_doc', 'like', "%" . $this->search_docs . "%");
                })
                ->orderBy('created_at', 'DESC')->get(),
            'correspondences' => Correspondence::where('appreq_id', $this->appreqid)->orderBy('created_at', 'DESC')->get(),
            'appreq' => Appreq::where('id', $this->appreqid)->with('user', 'permitwork', 'company')->first(),
            'stats' => $stat,
            'user_disposisi' => $user_disposisi,
            'user_processed' => $user_processed,
            'user_revision' => $user_revision,
            'user_finished' => $user_finished,
            'user_rejected' => $user_rejected
        ]);
    }
}
