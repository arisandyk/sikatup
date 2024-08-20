<?php

namespace App\Livewire\Settings;

use App\Models\UnitInduk;
use App\Models\App;
use App\Models\Basecamp;
use App\Models\GarduInduk;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProfile extends Component
{
    public $title = 'Edit Profile';
    public $name, $nip, $email, $mobileNumber, $unitInduk, $app, $basecamp, $garduInduk;
    public $apps = [], $basecamps = [], $garduInduks = [];
    public $confirmDelete = false;
    public $activeTab = 'account';

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->nip = $user->nip;
        $this->email = $user->email;
        $this->mobileNumber = $user->mobile_number;

        $currentWorkplace = explode(', ', $user->current_workplace);
        $this->unitInduk = $currentWorkplace[0] ?? null;
        $this->app = $currentWorkplace[1] ?? null;
        $this->basecamp = $currentWorkplace[2] ?? null;
        $this->garduInduk = $currentWorkplace[3] ?? null;

        $this->loadDependentData();
    }

    private function loadDependentData()
    {
        if ($this->unitInduk) {
            $this->apps = App::where('unit_id', $this->unitInduk)->get();
        }
        if ($this->app) {
            $this->basecamps = Basecamp::where('app_id', $this->app)->get();
        }
        if ($this->basecamp) {
            $this->garduInduks = GarduInduk::where('basecamp_id', $this->basecamp)->get();
        }
    }

    public function updatedUnitInduk()
    {
        $this->apps = App::where('unit_id', $this->unitInduk)->get();
        $this->app = null;
        $this->basecamp = null;
        $this->garduInduk = null;
        $this->basecamps = [];
        $this->garduInduks = [];
    }

    public function updatedApp()
    {
        $this->basecamps = Basecamp::where('app_id', $this->app)->get();
        $this->basecamp = null;
        $this->garduInduk = null;
        $this->garduInduks = [];
    }

    public function updatedBasecamp()
    {
        $this->garduInduks = GarduInduk::where('basecamp_id', $this->basecamp)->get();
        $this->garduInduk = null;
    }

    public function saveProfile()
{
    $user = Auth::user();

    $unitIndukName = UnitInduk::find($this->unitInduk)->name ?? '';
    $appName = App::find($this->app)->name ?? '';
    $basecampName = Basecamp::find($this->basecamp)->name ?? '';
    $garduIndukName = GarduInduk::find($this->garduInduk)->name ?? '';

    $user->update([
        'name' => $this->name,
        'nip' => $this->nip,
        'current_workplace' => implode(', ', [$unitIndukName, $appName, $basecampName, $garduIndukName]),
    ]);

    session()->flash('message', 'Profile updated successfully.');
}


    public function deleteAccount()
    {
        if ($this->confirmDelete) {
            $user = Auth::user();
            $user->delete();
            return redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.settings.edit-profile', [
            'unitInduks' => UnitInduk::all(),
        ])->layout('components.layouts.app',['title' => $this->title]);
    }
}
