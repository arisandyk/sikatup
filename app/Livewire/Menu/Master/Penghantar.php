<?php

namespace App\Livewire\Menu\Master;

use App\Models\App;
use App\Models\Penghantar as ModelsPenghantar;
use App\Models\UnitInduk;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Penghantar extends Component
{
    public $title = 'Penghantar';
    public $unitInduks = [];
    public $apps = [];

    public $newNamaPenghantar = '';
    public $selectedUnitInduk = '';
    public $newApp = '';

    public $isAddModalOpen = false;
    public $isEditModalOpen = false;
    public $isDeleteModalOpen = false;
    public $idBeingEdited = null;
    public $idBeingDeleted = null;

    protected $rules = [
        'newNamaPenghantar' => 'required|string|max:255',
        'selectedUnitInduk' => 'required|exists:unit_induks,id',
        'newApp' => 'required|exists:apps,id',
    ];

    public function render()
    {
        return view('livewire.menu.master.penghantar', [
            'penghantars' => ModelsPenghantar::paginate(10),
        ])->layout('components.layouts.app', ['title' => $this->title]);
    }

    public function mount(): void
    {
        $this->loadInitialData();
    }

    private function loadInitialData()
    {
        $this->unitInduks = UnitInduk::with('apps.basecamps.gardu_induks.bays')->get();
        $this->apps = App::with('basecamps.gardu_induks.bays')->get();
    }

    public function showAddModal()
    {
        $this->isAddModalOpen = true;
    }

    public function hideAddModal()
    {
        $this->isAddModalOpen = false;
        $this->resetForm();
    }

    public function updatedSelectedUnitInduk()
    {
        $this->reset(['newApp', 'apps']);
        if ($this->selectedUnitInduk) {
            $this->apps = App::where('unit_id', $this->selectedUnitInduk)->get();
        }
    }

    public function addNewItem()
    {
        $this->validate();

        ModelsPenghantar::create([
            'unit_id' => $this->selectedUnitInduk,
            'app_id' => $this->newApp,
            'name' => $this->newNamaPenghantar,
            'created_by' => Auth::user()->name,
        ]);

        $this->hideAddModal();
        session()->flash('success', 'Penghantar baru berhasil ditambahkan!');

        return redirect()->to('/master/penghantar');
    }

    private function resetForm()
    {
        $this->reset([
            'newNamaPenghantar',
            'selectedUnitInduk',
            'newApp',
            'idBeingEdited',
        ]);
    }

    public function showEditModal($id)
    {
        $this->idBeingEdited = $id;
        $this->loadBayData();
        $this->isEditModalOpen = true;
    }

    private function loadBayData()
    {
        $penghantar = ModelsPenghantar::find($this->idBeingEdited);

        if ($penghantar) {
            $this->newNamaPenghantar = $penghantar->name;
            $this->selectedUnitInduk = $penghantar->unit_id ?? null;
            $this->updatedSelectedUnitInduk();
            $this->newApp = $penghantar->app_id ?? null;
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

        $penghantar = ModelsPenghantar::find($this->idBeingEdited);

        if ($penghantar) {
            $penghantar->update([
                'name' => $this->newNamaPenghantar,
                'unit_id' => $this->selectedUnitInduk,
                'app_id' => $this->newApp,
                'updated_by' => Auth::user()->name,
            ]);

            $this->hideEditModal();
            session()->flash('success', 'Penghantar baru berhasil diperbarui!');
        }
        return redirect()->to('/master/penghantar');
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
        $penghantar = ModelsPenghantar::find($this->idBeingDeleted);

        if ($penghantar) {
            $penghantar->delete();
            session()->flash('success', 'Pengantar berhasil dihapus!');
        }

        $this->hideDeleteModal();
        return redirect()->to('/master/penghantar');
    }
}
