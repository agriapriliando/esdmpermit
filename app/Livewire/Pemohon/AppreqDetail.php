<?php

namespace App\Livewire\Pemohon;

use App\Models\Appreq;
use App\Models\Correspondence;
use App\Models\Doc;
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
            'file_upload.*' => 'extensions:pdf,doc,docx,xls,xlsx,jpeg,jpg,png|max:6000'
        ],
        message: [
            'file_upload.*.extensions' => 'Silahkan Memilih Berkas dengan Format : pdf,doc,docx,xls,xlsx,jpeg,jpg,png',
            'file_upload.*.max' => 'Ukuran 1 Berkas Tidak Boleh Melebihi 6MB',
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
        Correspondence::where('appreq_id', $this->appreqid)->where('viewed', 0)
            ->where('user_id', '!=', Auth::id())
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
                'user_id' => 2,
                'appreq_id' => $this->appreqid,
                'name_doc' => $oriName,
                'type_doc' => 'Revisi',
                'file_name' => $fileName . $ext,
            ]);
        }
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
            'desc' => $this->desc
        ];
        if ($this->desc != null) {
            Correspondence::create($data);
        }
        if ($this->file_upload != null) {
            $this->uploadFile($this->file_upload);
        }
        $this->reset('file_upload', 'desc');
    }

    public function render()
    {
        // dd(Appreq::where('id', $this->appreqid)->with('user', 'permitwork', 'company')->first());
        return view('livewire.pemohon.appreq-detail', [
            'docs' => Doc::where('appreq_id', $this->appreqid)
                ->when($this->search_docs, function ($query) {
                    $query->where('name_doc', 'like', "%" . $this->search_docs . "%");
                })
                ->orderBy('created_at', 'DESC')->get(),
            'correspondences' => Correspondence::where('appreq_id', $this->appreqid)->orderBy('created_at', 'DESC')->get(),
            'appreq' => Appreq::where('ver_code', $this->appreq->ver_code)->with('user', 'permitwork', 'company')->first()
        ]);
    }
}
