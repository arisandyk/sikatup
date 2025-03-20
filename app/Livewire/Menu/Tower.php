<?php

namespace App\Livewire\Menu;

use App\Models\Penghantar;
use App\Models\Tower as ModelsTower;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tower extends Component
{
    public $title = "Tower";
    public $penghantars = [];

    public $selectedPenghantar = '';
    public $newNamaTower = '';
    public $newNoTower = '';
    public $newAlamatTower = '';
    public $newLatitudeTower = '';
    public $newLongitudeTower = '';

    public $isAddModalOpen = false;
    public $isEditModalOpen = false;
    public $isDeleteModalOpen = false;
    public $idBeingEdited = null;
    public $idBeingDeleted = null;

    protected $rules = [
        'selectedPenghantar' => 'required|exists:penghantars,id',
        'newNamaTower' => 'required|string|max:255',
        'newNoTower' => 'required|numeric|max:255',
        'newAlamatTower' => 'required|string|max:255',
        'newLatitudeTower' => 'required|numeric|max:255',
        'newLongitudeTower' => 'required|numeric|max:255',
    ];

    public function render()
    {
        return view('livewire.menu.tower', [
            'towers' => ModelsTower::paginate(10),
        ])->layout('components.layouts.app', [
            'title' => $this->title
        ]);
    }

    public function mount(): void
    {
        $this->loadInitialData();
    }

    private function loadInitialData()
    {
        $this->penghantars = Penghantar::get();
    }

    public function showAddModal()
    {
        $this->isAddModalOpen = true;
        $this->dispatch('modalOpened');
    }

    public function hideAddModal()
    {
        $this->isAddModalOpen = false;
        $this->resetForm();
    }

    public function addNewItem()
    {
        $this->validate();

        ModelsTower::create([
            'penghantar_id' => $this->selectedPenghantar,
            'name' => $this->newNamaTower,
            'no' => $this->newNoTower,
            'alamat' => $this->newAlamatTower,
            'latitude' => $this->newLatitudeTower,
            'longitude' => $this->newLongitudeTower,
        ]);

        $this->hideAddModal();
        session()->flash('success', 'Tower baru berhasil ditambahkan!');

        return redirect()->to('/tower');
    }

    private function resetForm()
    {
        $this->reset([
            'selectedPenghantar',
            'newNamaTower',
            'newNoTower',
            'newAlamatTower',
            'newLatitudeTower',
            'newLongitudeTower',
            'idBeingEdited',
        ]);
    }

    public function showEditModal($id)
    {
        $this->idBeingEdited = $id;
        $this->loadBayData();
        $this->isEditModalOpen = true;
        $this->dispatch('editModalOpened');
    }

    protected $listeners = ['placeChanged'];

    public function placeChanged($address, $latitude, $longitude)
    {
        $this->newAlamatTower = $address;
        $this->newLatitudeTower = $latitude;
        $this->newLongitudeTower = $longitude;
    }

    private function loadBayData()
    {
        $tower = ModelsTower::find($this->idBeingEdited);

        if ($tower) {
            $this->selectedPenghantar = $tower->penghantar_id;
            $this->newNamaTower = $tower->name;
            $this->newNoTower = $tower->no;
            $this->newAlamatTower = $tower->alamat;
            $this->newLatitudeTower = $tower->latitude;
            $this->newLongitudeTower = $tower->longitude;
        }
    }

    public function hideEditModal()
    {
        $this->isEditModalOpen = false;
        $this->resetForm();
    }

    public function updateItem()
    {
        $this->validate();

        $penghantar = ModelsTower::find($this->idBeingEdited);

        if ($penghantar) {
            $penghantar->update([
                'penghantar_id' => $this->selectedPenghantar,
                'name' => $this->newNamaTower,
                'no' => $this->newNoTower,
                'alamat' => $this->newAlamatTower,
                'latitude' => $this->newLatitudeTower,
                'longitude' => $this->newLongitudeTower,
            ]);

            $this->hideEditModal();
            session()->flash('success', 'Tower baru berhasil diperbarui!');
        }
        return redirect()->to('/tower');
    }

    public function confirmDelete($id)
    {
        $this->idBeingDeleted = $id;
        $this->isDeleteModalOpen = true;
    }

    public function hideDeleteModal()
    {
        $this->isDeleteModalOpen = false;
        $this->idBeingDeleted = null;
    }

    public function deleteItem()
    {
        $penghantar = ModelsTower::find($this->idBeingDeleted);

        if ($penghantar) {
            $penghantar->delete();
            session()->flash('success', 'Tower berhasil dihapus!');
        }

        $this->hideDeleteModal();
        return redirect()->to('/tower');
    }
}
