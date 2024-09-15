<?php

namespace App\Livewire\Admin;

use App\Models\Topic;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TopicList extends Component
{
    public $search = '';
    public $pagelength = 10;
    public $title = 'Tambah Topik Korespondensi';
    public $id;

    #[Validate('required', message: 'Nama Topik Tidak Boleh Kosong')]
    public $name_topic;
    #[Validate('required', message: 'Deskripsi Topik Tidak Boleh Kosong')]
    public $desc_topic;

    public Topic $topic; //model binding

    public $tertaut_count;

    public function resetSearch()
    {
        $this->reset('search');
    }

    public function resetForm()
    {
        $this->title = 'Tambah Topik Korespondensi';
        $this->reset('name_topic', 'desc_topic');
    }

    public function save($id = null)
    {
        $data = $this->only('name_topic', 'desc_topic');
        // dd($data);
        $this->validate();
        if ($this->title == 'Tambah Topik Korespondensi') {
            try {
                Topic::create($data);
                $this->reset();
                $this->dispatch('topic-created', message: 'Topik ' . $data['name_topic'] . ' Berhasil Ditambahkan');
            } catch (\Exception $e) {
                $this->dispatch('topic-error', message: 'Created Topik ' . $e->getMessage() . ' ERROR');
            }
        } else {
            try {
                $dataTopic = Topic::find($id);
                // dd($dataUser);
                $dataTopic->update($data);
                $this->reset();
                $this->dispatch('topic-created', message: 'Topik ' . $data['name_topic'] . ' Berhasil Diperbaharui');
            } catch (\Exception $e) {
                $this->dispatch('topic-error', message: 'Created Topik ' . $e->getMessage() . ' ERROR');
            }
        }
        // dd($data);
    }

    public function edit(Topic $topic)
    {
        $this->title = 'Edit Topik';
        $this->id = $topic->id;
        $this->name_topic = $topic->name_topic;
        $this->desc_topic = $topic->desc_topic;
    }

    public function delete($id)
    {
        $topic = Topic::find($id);
        $topic->delete();
        $this->reset();
        $this->dispatch('topic-deleted', message: 'Topik Korespondensi ' . $topic->name_topic . ' Berhasil Dihapus');
    }

    public function render()
    {
        return view('livewire.admin.topic-list', [
            'topics' => Topic::withCount('correspondences')->search($this->search)
                ->when($this->tertaut_count == 'A', function ($query) {
                    $query->having('correspondences_count', '>=', 1);
                })
                ->when($this->tertaut_count == 'B', function ($query) {
                    $query->has('correspondences', 0);
                })
                ->orderBy('name_topic')
                ->paginate($this->pagelength)
        ]);
    }
}
