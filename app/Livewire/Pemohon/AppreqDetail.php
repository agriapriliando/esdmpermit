<?php

namespace App\Livewire\Pemohon;

use App\Models\Appreq;
use App\Models\Correspondence;
use App\Models\Doc;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AppreqDetail extends Component
{
    use WithFileUploads;

    #[Validate(
        [
            'desc' => 'required',
            'file_upload.*' => 'extensions:pdf,doc,docx,xls,xlsx,jpeg,jpg,png|max:10000'
        ],
        message: [
            'desc.required' => 'Isi Korespondensi Tidak Boleh Kosong',
            'file_upload.*.extensions' => 'Silahkan Memilih Berkas dengan Format : pdf,doc,docx,xls,xlsx,jpeg,jpg,png',
            'file_upload.*.max' => 'Ukuran 1 Berkas Tidak Boleh Melebihi 10MB',
        ]
    )]
    public Appreq $appreq;

    public $appreqid;
    public $appreqdata;
    public $search_docs;

    public $desc;

    public $file_upload = [];

    public function mount($id)
    {
        $this->appreqid = $id;
        $this->appreqdata = Appreq::find($id)->with('user', 'permitwork', 'company')->first();
    }

    public function resetSearchDocs()
    {
        $this->reset('search_docs');
    }

    public function uploadFile($file_uploads)
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

    public function save()
    {
        // dd($this->file_upload);
        $data = [
            'user_id' => 2,
            'topic_id' => 1,
            'appreq_id' => $this->appreqid,
            'desc' => $this->desc
        ];
        Correspondence::create($data);
        if ($this->file_upload != null) {
            $this->uploadFile($this->file_upload);
        }
    }

    public function render()
    {
        return view('livewire.pemohon.appreq-detail', [
            'docs' => Doc::where('appreq_id', $this->appreqdata['id'])
                ->when($this->search_docs, function ($query) {
                    $query->where('name_doc', 'like', "%" . $this->search_docs . "%");
                })
                ->orderBy('created_at', 'DESC')->get(),
            'correspondences' => Correspondence::where('appreq_id', $this->appreqid)->orderBy('created_at', 'DESC')->get()
        ]);
    }
}
