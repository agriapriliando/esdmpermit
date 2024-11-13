<?php

namespace App\Livewire\Pemohon;

use App\Models\Appreq;
use App\Models\Company;
use App\Models\Doc;
use App\Models\Permitwork;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AppreqCreate extends Component
{
    use WithFileUploads;

    #[Validate(
        [
            'permitwork_id' => 'required',
            'file_upload' => 'required',
            'file_upload.*' => 'extensions:pdf,doc,docx,xls,xlsx,jpeg,jpg,zip,rar|max:11000'
        ],
        message: [
            'permitwork_id.required' => 'Silahkan Memilih Layanan',
            'file_upload.required' => 'Silahkan Memilih Berkas',
            'file_upload.*.extensions' => 'Silahkan Memilih Berkas dengan Format : pdf,doc,docx,xls,xlsx,jpeg,jpg,zip,rar',
            'file_upload.*.max' => 'Ukuran 1 Berkas Tidak Boleh Melebihi 10MB',
        ]
    )]
    public $permitwork_id = '';
    public $permitwork_desc;

    public $search = '';
    public $pagelength = 10;
    public $tertaut_count;

    public Permitwork $permitwork;

    public $file_upload = [];
    public $notes;

    public function mount(Permitwork $permitwork)
    {
        $this->permitwork_id = $permitwork->id;
        $this->permitwork_desc = $permitwork->desc_permit;
    }

    public function updatedFileUpload()
    {
        $this->validate();
    }

    public function save()
    {
        // dd($this->notes);
        // validasi form
        $this->validate();
        // generate verifikasi code permohonan
        // format bln/tahun/tanggal + random 3 angka
        $ver_code = Carbon::now()->format('mYj') . rand(111, 999);
        foreach ($this->file_upload as $file) {
            // generate nama file
            // get extensi file
            $ext = "." . $file->extension();
            $oriName = strtolower(str_replace(" ", "_", $file->getClientOriginalName()));
            // format bulan/tahun/tgl random 3angka id_user
            $fileName = Carbon::now()->format('mYjhi') . rand(111, 999) . "1";
            // gabung nama file dan extensi
            $fileNames = $fileName . $ext;
            // simpan file
            $file->storeAs('file_doc', $fileNames, 'public');
            // masukan semua nama file ke array
            $fileNameArray[] = $fileName . $ext;
            $fileNameOriArray[] = $oriName;
        }
        // dd($fileNameOriArray);
        // proses penyimpanan ke database
        try {
            $dataAppreq = [
                'user_id' => Auth::id(),
                'company_id' => Company::where('user_id', Auth::id())->first()->id,
                'stat_id' => 1,
                'permitwork_id' => $this->permitwork_id,
                'ver_code' => $ver_code,
                'date_submitted' => Carbon::now(),
                'notes' => $this->notes,
            ];
            // dd($dataAppreq);
            DB::transaction(function () use ($dataAppreq, $fileNameArray, $fileNameOriArray) {
                $appreqinput = Appreq::create($dataAppreq);
                $i = 0;
                foreach ($fileNameArray as $name) {
                    Doc::create([
                        'user_id' => Auth::id(),
                        'appreq_id' => $appreqinput->id,
                        'name_doc' => $fileNameOriArray[$i],
                        'type_doc' => 'Ajuan',
                        'file_name' => $name,
                        'sender' => 1,
                    ]);
                    $i++;
                }
                $this->file_upload = null;
                $this->dispatch('appreq-created', message: 'Permohonan Layanan Berhasil Diajukan');
                session()->flash('message', 'Pengajuan Permohonan Layanan Berhasil');
            });
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        if (!empty($this->permitwork_id)) {
            $this->permitwork_desc = Permitwork::where('id', $this->permitwork_id)->get()->pluck('desc_permit');
        } else {
            $this->permitwork_desc = '';
        }
        return view('livewire.pemohon.appreq-create', [
            'permitworks' => Permitwork::all(),
            'company' => Company::where('user_id', Auth::id())->first(),
        ]);
    }
}
