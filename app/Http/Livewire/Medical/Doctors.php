<?php

namespace App\Http\Livewire\Medical;

use Livewire\Component;
use App\Models\Doctor;
use Livewire\WithPagination;

class Doctors extends Component
{
    use WithPagination;

    protected $listeners = ['refresh' => '$refresh'];
    public $sortBy = 'practice_number';
    public $searchTerm='';
    public $sortAsc = true;
    public $pageSize = 10;

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
    public function updatedPageSize()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = $this->query()
            ->when($this->searchTerm, function($q){
                $q->where('practice_number', 'like', '%'.$this->searchTerm.'%')
                    ->orWhere('practice_name', 'like', '%'.$this->searchTerm.'%')
                    ->orWhere('fax', 'like', '%'.$this->searchTerm.'%')
                    ->orWhere('contact_number', 'like', '%'.$this->searchTerm.'%');
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->pageSize);

        return view('livewire.medical.doctors', ['data'=>$data]);
    }

    public function sortBy($field)
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

    public function query()
    {
        return Doctor::query();
    }

}
