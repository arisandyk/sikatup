<?php

namespace App\Livewire\Settings;

use App\Models\UnitInduk;
use App\Models\App;
use App\Models\Basecamp;
use App\Models\GarduInduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditProfile extends Component
{
    public $title = 'Edit Profile';
    public $name, $nip, $email, $mobileNumber, $unitInduk, $app, $basecamp, $garduInduk;
    public $unitIndukName, $appName, $basecampName, $garduIndukName;
    public $apps = [], $basecamps = [], $garduInduks = [];
    public $confirmDelete = false;
    public $activeTab = 'account';

    public $editUnitInduk = false;
    public $editApp = false;
    public $editBasecamp = false;
    public $editGarduInduk = false;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->nip = $user->nip;
        $this->email = $user->email;
        $this->mobileNumber = $user->mobile_number;
    
        // Split the current workplace into respective fields
        $currentWorkplace = explode(', ', $user->current_workplace);
        $this->unitInduk = $currentWorkplace[0] ?? null;
        $this->app = $currentWorkplace[1] ?? null;
        $this->basecamp = $currentWorkplace[2] ?? null;
        $this->garduInduk = $currentWorkplace[3] ?? null;
    
        // Load related names for display
        $this->unitIndukName = $this->unitInduk ?? '';
        $this->appName = $this->app ?? '';
        $this->basecampName = $this->basecamp ?? '';
        $this->garduIndukName = $this->garduInduk ?? '';
    
        $this->loadDependentData();
    }
    
    public function loadDependentData()
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
        // Clear dependent dropdowns when unitInduk changes
        $this->apps = App::where('unit_id', $this->unitInduk)->get();
        $this->app = null;
        $this->basecamp = null;
        $this->garduInduk = null;
        $this->basecamps = [];
        $this->garduInduks = [];
    }

    public function updatedApp()
    {
        // Clear basecamp and garduInduk when app changes
        $this->basecamps = Basecamp::where('app_id', $this->app)->get();
        $this->basecamp = null;
        $this->garduInduk = null;
        $this->garduInduks = [];
    }

    public function updatedBasecamp()
    {
        // Clear garduInduk when basecamp changes
        $this->garduInduks = GarduInduk::where('basecamp_id', $this->basecamp)->get();
        $this->garduInduk = null;
    }

    public function saveProfile()
    {
        // Validate the input
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
            'mobileNumber' => ['required', 'string', 'max:15'],
            'unitInduk' => ['required'],
            'app' => ['nullable'],
            'basecamp' => ['nullable'],
            'garduInduk' => ['nullable'],
        ]);

        // Retrieve user
        $user = Auth::user();

        // Find names for the dependent fields
        $unitIndukName = UnitInduk::find($this->unitInduk)->name ?? '';
        $appName = App::find($this->app)->name ?? '';
        $basecampName = Basecamp::find($this->basecamp)->name ?? '';
        $garduIndukName = GarduInduk::find($this->garduInduk)->name ?? '';

        // Update the user's profile
        $user->update([
            'name' => $this->name,
            'nip' => $this->nip,
            'email' => $this->email,
            'mobile_number' => $this->mobileNumber,
            'current_workplace' => implode(', ', array_filter([$unitIndukName, $appName, $basecampName, $garduIndukName])),
        ]);

        // Provide feedback
        session()->flash('message', 'Profile updated successfully.');
    }

    public function deleteAccount()
    {
        // Ensure that the user has confirmed the account deletion
        if ($this->confirmDelete) {
            $user = Auth::user();
            $user->delete();
            return redirect('/');
        }
    }

    public function cancel()
    {
        // Implement your cancel logic here, e.g., resetting form fields
        return redirect()->route('profile'); // Redirect to a specific route
    }

    public function render()
    {
        // Pass necessary data to the view
        return view('livewire.settings.edit-profile', [
            'unitInduks' => UnitInduk::all(),
        ])->layout('components.layouts.app', ['title' => $this->title]);
    }
}
