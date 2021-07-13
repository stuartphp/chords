<?php

namespace App\Http\Livewire\Medical;

use Livewire\Component;
use App\Models\Doctor;
use Livewire\WithPagination;

class Doctors extends Component
{
    use WithPagination;

    protected $listeners = ['refresh' => '$refresh'];
    public $sortBy = 'name';
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
            ->with('roles')
            ->when($this->searchTerm, function($q){
                $q->where('name', 'like', '%'.$this->searchTerm.'%')
                    ->orWhere('email', 'like', '%'.$this->searchTerm.'%');
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
