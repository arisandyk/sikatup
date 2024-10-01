<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

class UserRequest extends Component
{
    public $title;
    public $activeTab = 'user-request';
    public function mount()
    {
        $this->title = 'User Request';
    }
    public function render()
    {
        $requests = Request::where('user_id', Auth::id())->get();

        return view('livewire.components.user-request', [ 'requests' => $requests ]);
    }
}
