<?php

namespace App\Livewire\Admin;

use App\Models\Permitwork;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PermitworkList extends Component
{
    public $search = '';
    public $pagelength = 20;
    public $title = 'Tambah Layanan';
    public $id;

    #[Validate('required', message: 'Nama Layanan Tidak Boleh Kosong')]
    public $name_permit;
    #[Validate('required', message: 'Deskripsi Layanan Tidak Boleh Kosong')]
    public $desc_permit;

    public Permitwork $permitwork; //model binding

    public $tertaut_count;

    public function resetSearch()
    {
        $this->reset('search');
    }

    public function resetForm()
    {
        $this->title = 'Tambah Layanan';
        $this->reset('name_permit', 'desc_permit');
    }

    public function save($id = null)
    {
        $this->validate();
        $data = $this->only('name_permit', 'desc_permit');
        // dd($data);
        if ($this->title == 'Tambah Layanan') {
            try {
                Permitwork::create($data);
                $this->reset();
                $this->dispatch('permitwork-created', message: 'Layanan ' . $data['name_permit'] . ' Berhasil Ditambahkan');
            } catch (\Exception $e) {
                $this->dispatch('permitwork-error', message: 'Created Layanan ' . $e->getMessage() . ' ERROR');
            }
        } else {
            try {
                $dataUser = Permitwork::find($id);
                // dd($dataUser);
                $dataUser->update($data);
                $this->reset();
                $this->dispatch('permitwork-updated', message: 'Layanan ' . $data['name_permit'] . ' Berhasil Diperbaharui');
            } catch (\Exception $e) {
                $this->dispatch('permitwork-error', message: 'Created Layanan ' . $e->getMessage() . ' ERROR');
            }
        }
        // dd($data);
    }

    public function edit(Permitwork $permitwork)
    {
        $this->title = 'Edit Layanan';
        $this->id = $permitwork->id;
        $this->name_permit = $permitwork->name_permit;
        $this->desc_permit = $permitwork->desc_permit;
    }

    public function delete($id)
    {
        $permitwork = Permitwork::find($id);
        $permitwork->delete();
        $this->reset();
        $this->dispatch('permitwork-deleted', message: 'Jenis Layanan ' . $permitwork->name_permit . ' Berhasil Dihapus');
    }

    public function render()
    {
        return view('livewire.admin.permitwork-list', [
            'permitworks' => Permitwork::withCount('appreqs')->search($this->search)
                ->when($this->tertaut_count == 'A', function ($query) {
                    $query->having('appreqs_count', '>=', 1);
                })
                ->when($this->tertaut_count == 'B', function ($query) {
                    $query->has('appreqs', 0);
                })
                ->orderBy('name_permit')
                ->paginate($this->pagelength)
        ]);
    }
}
