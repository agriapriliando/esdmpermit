<?php

namespace App\Livewire\Pemohon;

use App\Models\Appreq;
use App\Models\Correspondence;
use App\Models\Doc;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AppreqDetail extends Component
{
    use WithFileUploads;

    #[Validate(
        [
            'file_upload.*' => 'extensions:pdf,doc,docx,xls,xlsx,jpeg,jpg,png,zip,rar|max:60000'
        ],
        message: [
            'file_upload.*.extensions' => 'Silahkan Memilih Berkas dengan Format : pdf,doc,docx,xls,xlsx,jpeg,jpg,png',
            'file_upload.*.max' => 'Ukuran 1 Berkas Tidak Boleh Melebihi 10MB',
        ]
    )]
    public $appreq;

    public $appreqid;
    public $appreqdata;
    public $search_docs;

    public $desc;

    public $file_upload = [];

    public function mount($ver_code)
    {
        $this->appreq = Appreq::where('ver_code', $ver_code)->first();
        $this->appreqid = $this->appreq->id;
        // cek pesan, otomatis viewed saat detail pengajuan dibuka
        Correspondence::where('appreq_id', $this->appreqid)
            ->where('viewed', 0)
            ->where('user_id', '!=', Auth::id())
            ->where('sender', 0)
            ->update([
                'viewed' => 1
            ]);
        Doc::where('appreq_id', $this->appreqid)
            ->where('viewed', 0)
            ->where('sender', 0)
            ->update([
                'viewed' => 1
            ]);
    }

    public function resetFileupload()
    {
        $this->file_upload = '';
    }

    public function resetSearchDocs()
    {
        $this->reset('search_docs');
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
                'type_doc' => 'Revisi',
                'file_name' => $fileName . $ext,
                'sender' => 1
            ]);
        }
        Appreq::where('id', $this->appreqid)->update([
            'viewed_operator' => 0,
            'viewed_evaluator' => 0,
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
            'sender' => 1,
        ];
        if ($this->desc != null) {
            Correspondence::create($data);
            Appreq::where('id', $this->appreqid)->update([
                'viewed_operator' => 0,
                'viewed_evaluator' => 0,
            ]);
        }
        if ($this->file_upload != null) {
            $this->uploadFile($this->file_upload);
            Appreq::where('id', $this->appreqid)->update([
                'viewed_operator' => 0,
                'viewed_evaluator' => 0,
            ]);
        }
        $this->reset('file_upload', 'desc');
    }

    public function render()
    {
        Correspondence::where('appreq_id', $this->appreqid)->where('viewed', 0)
            ->where('user_id', '!=', Auth::id())
            ->update([
                'viewed' => 1
            ]);

        if ($this->appreq->user_disposisi != null) {
            $user_disposisi = User::find($this->appreq->user_disposisi);
            if ($user_disposisi == null) {
                $user_disposisi = [
                    'name' => "--"
                ];
            }
        } else {
            $user_disposisi = [
                'name' => null
            ];
        }
        if ($this->appreq->user_processed != null) {
            $user_processed = User::find($this->appreq->user_processed);
            if ($user_processed == null) {
                $user_processed = [
                    'name' => "--"
                ];
            }
        } else {
            $user_processed = [
                'name' => null
            ];
        }
        if ($this->appreq->user_revision != null) {
            $user_revision = User::find($this->appreq->user_revision);
            if ($user_revision == null) {
                $user_revision = [
                    'name' => "--"
                ];
            }
        } else {
            $user_revision = [
                'name' => null
            ];
        }
        if ($this->appreq->user_finished != null) {
            $user_finished = User::find($this->appreq->user_finished);
            if ($user_finished == null) {
                $user_finished = [
                    'name' => "--"
                ];
            }
        } else {
            $user_finished = [
                'name' => null
            ];
        }
        if ($this->appreq->user_rejected != null) {
            $user_rejected = User::find($this->appreq->user_rejected);
            if ($user_rejected == null) {
                $user_rejected = [
                    'name' => "--"
                ];
            }
        } else {
            $user_rejected = [
                'name' => null
            ];
        }

        return view('livewire.pemohon.appreq-detail', [
            'docs' => Doc::where('appreq_id', $this->appreqid)
                ->when($this->search_docs, function ($query) {
                    $query->where('name_doc', 'like', "%" . $this->search_docs . "%");
                })
                ->orderBy('created_at', 'DESC')->get(),
            'correspondences' => Correspondence::where('appreq_id', $this->appreqid)->orderBy('created_at', 'DESC')->get(),
            'appreq' => Appreq::where('ver_code', $this->appreq->ver_code)->with('user', 'permitwork', 'company')->first(),
            'user_disposisi' => $user_disposisi,
            'user_processed' => $user_processed,
            'user_revision' => $user_revision,
            'user_finished' => $user_finished,
            'user_rejected' => $user_rejected
        ]);
    }
}
