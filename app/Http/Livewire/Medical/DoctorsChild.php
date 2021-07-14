<?php

namespace App\Http\Livewire\Medical;

use Livewire\Component;
use App\Models\Doctor;

class DoctorsChild extends Component
{
    protected $listeners = [
        'showDeleteForm',
        'showCreateForm',
        'showEditForm',
    ];
    public $confirmingItemDeletion = false;
    public $primaryKey;
    public $confirmingItemCreation = false;
    public $confirmingItemEdition = false;
    public $item;
    public $message ='';
    public $parent = 'medical.doctors';

    protected $rules = [
        'item.practice_number' => '',
        'item.practice_name' => '',
        'item.physical_address1' => '',
        'item.physical_address2' => '',
        'item.physical_suburb' => '',
        'item.physical_town' => '',
        'item.physical_postal_code' => '',
        'item.physical_province' => '',
        'item.postal_address1' => '',
        'item.postal_address2' => '',
        'item.postal_suburb' => '',
        'item.postal_town' => '',
        'item.postal_postal_code' => '',
        'item.fax' => '',
        'item.contact_number' => '',
    ];


    public function showDeleteForm($id)
    {
        $this->confirmingItemDeletion = true;
        $this->primaryKey = $id;
    }

    public function deleteItem()
    {
        Doctor::destroy($this->primaryKey);
        $this->confirmingItemDeletion = false;
        $this->primaryKey = '';
        $this->reset(['item']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted']);
        $this->emitTo($this->parent, 'refresh');
    }

    public function showCreateForm()
    {
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
    }

    public function createItem()
    {
        $this->validate();
        Doctor::create([
            'title' => $this->item['title']
        ]);
        $this->confirmingItemCreation = false;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Created']);
        $this->emitTo($this->parent, 'refresh');
    }

    public function showEditForm(Doctor $item)
    {
        $this->resetErrorBag();
        $this->item = $item;
        $this->confirmingItemEdition = true;
    }

    public function editItem()
    {
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdition = false;
        $this->primaryKey = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Updated']);
        $this->emitTo($this->parent, 'refresh');
    }
    public function render()
    {
        return view('livewire.medical.doctors-child');
    }
}
