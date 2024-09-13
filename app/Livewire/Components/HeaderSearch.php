<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderSearch extends Component
{
    public $query = '';
    public $pages = [];
    public $results = [];
    public $history = [];

    public function mount()
    {
        $this->pages = [
            ['name' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'home'],
            ['name' => 'Control', 'route' => 'control', 'icon' => 'table'],
            ['name' => 'Location', 'route' => 'location', 'icon' => 'map-pin'],
            ['name' => 'Alarm', 'route' => 'alarm', 'icon' => 'urgent'],
            ['name' => 'Profile', 'route' => 'profile', 'icon' => 'user'],
        ];

        if (Auth::user()->role == 'admin') {
            $this->pages[] = ['name' => 'Users', 'route' => 'users', 'icon' => 'users'];
        }

        $this->history = session()->get('search_history', []);
    }

    public function updatedQuery()
    {
        $this->search();
    }

    public function search()
    {
        if (strlen($this->query) > 0) {
            $this->results = collect($this->pages)
                ->filter(function ($page) {
                    return stripos($page['name'], $this->query) !== false;
                })
                ->values()
                ->all();
        } else {
            $this->results = [];
        }
    }

    public function saveSearchToHistoryAndRedirect()
    {
        if (!empty($this->results)) {
            // Save the search query to history if it's not already there
            if (!in_array($this->query, $this->history)) {
                array_unshift($this->history, $this->query);
                session()->put('search_history', $this->history);
            }

            // Redirect to the first search result
            $this->redirectTo($this->results[0]['route']);
        }
    }

    public function clearHistory()
    {
        $this->history = [];
        session()->forget('search_history');
    }

    public function redirectTo($route)
    {
        return redirect()->to($route);
    }

    public function render()
    {
        return view('livewire.components.header-search', [
            'results' => $this->results,
            'history' => $this->history,
        ]);
    }
}
