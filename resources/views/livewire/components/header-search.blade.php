<div class="search-bar-wrapper" x-data="{ showHistory: false }">
    <input 
        type="text" 
        wire:model="query" 
        wire:keydown.enter="saveSearchToHistoryAndRedirect"
        placeholder="Search Pages..." 
        @focus="showHistory = true" 
        @blur="setTimeout(() => showHistory = false, 200)" />

    @if (strlen($query) > 0 && !empty($results))
        <ul class="search-results">
            @foreach ($results as $result)
                <li>
                    <a href="#" wire:click.prevent="redirectTo('{{ $result['route'] }}')">
                        {{ $result['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @elseif (strlen($query) > 0 && empty($results))
        <p>No results found for "{{ $query }}".</p>
    @endif

    @if (empty($query) && !empty($history))
        <ul class="search-history" x-show="showHistory">
            <li><strong>Search History</strong></li>
            @foreach ($history as $historyItem)
                <li>
                    <a href="#" wire:click.prevent="$set('query', '{{ $historyItem }}')">
                        {{ $historyItem }}
                    </a>
                </li>
            @endforeach
            <li><button wire:click="clearHistory">Clear History</button></li>
        </ul>
    @endif
</div>
