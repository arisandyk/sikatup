<?php

namespace App\Livewire\Settings;

use App\Models\UnitInduk;
use App\Models\App;
use App\Models\Basecamp;
use App\Models\GarduInduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;
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
    public $profilePicture = null;


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

    public function saveProfile()
    {
        try {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'nip' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
                'mobileNumber' => ['required', 'string', 'max:15'],
                'profilePicture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:800'], // Validasi gambar
                'unitInduk' => ['nullable', 'exists:unit_induks,id'],
                'app' => ['nullable', 'exists:apps,id'],
                'basecamp' => ['nullable', 'exists:basecamps,id'],
                'garduInduk' => ['nullable', 'exists:gardu_induks,id'],
            ]);
    
            $user = Auth::user();
    
            // Tangani upload avatar jika ada
            if (!is_null($this->profilePicture)) {
                $user->image = $this->handleAvatarUpload($this->profilePicture, $user);
            }
    
            // Susun current_workplace
            $currentWorkplace = implode(', ', array_filter([
                $this->unitInduk,
                $this->app,
                $this->basecamp,
                $this->garduInduk,
            ]));
    
            // Update profil pengguna
            $user->update([
                'name' => $this->name,
                'nip' => $this->nip,
                'email' => $this->email,
                'mobile_number' => $this->mobileNumber,
                'image' => $user->image,
                'current_workplace' => $currentWorkplace, // Simpan current_workplace
            ]);

            session()->flash('success', 'Profile updated successfully.');
            return redirect()->route('profile');
        } catch (\Exception $e) {
            // Tangani kesalahan jika ada
            session()->flash('message', 'Failed to update profile: ' . $e->getMessage());
            return;
        }
    }


    private function handleAvatarUpload($file, $user)
    {
        $avatarPath = 'assets/img/avatars/';
        $defaultAvatar = $avatarPath . 'user.png'; // Gambar default

        // Pastikan direktori avatar ada
        if (!Storage::exists($avatarPath)) {
            Storage::makeDirectory($avatarPath);
        }

        // Hapus avatar lama jika bukan avatar default
        if (($user->image !== $defaultAvatar) && Storage::exists($user->image)) {
            Storage::delete($user->image);
        }

        // Generate nama unik untuk avatar baru
        $fileName = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Simpan file langsung ke folder tujuan
        $file->storeAs($avatarPath, $fileName, 'public');

        // Return path baru untuk disimpan di database
        return $avatarPath . $fileName;
    }
}
