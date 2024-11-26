<div class="w-full relative" x-data="{ showHistory: false }">
    <input type="text" wire:model="query" wire:keydown.enter="saveSearchToHistoryAndRedirect" class="w-full border-none box-border focus:outline-none"
        placeholder="Search Pages..." @focus="showHistory = true" @blur="setTimeout(() => showHistory = false, 200)" />

    @if (strlen($query) > 0 && !empty($results))
        <ul class="absolute top-full left-0 right-0 bg-white rounded-lg shadow-lg mt-1 list-none p-0 z-[1000] box-border overflow-hidden">
            @foreach ($results as $result)
                <li class="px-4 py-3 border-b border-[#f0f0f0] w-full box-border hover:bg-[#f9f9f9]">
                    <a href="#" wire:click.prevent="redirectTo('{{ $result['route'] }}')" class="no-underline text-secondary block w-full h-full box-border">
                        {{ $result['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @elseif (strlen($query) > 0 && empty($results))
        <p>No results found for "{{ $query }}".</p>
    @endif

    @if (empty($query) && !empty($history))
        <ul class="absolute top-full left-0 right-0 bg-white rounded-lg shadow-lg mt-1 list-none p-0 z-[1000] box-border overflow-hidden" x-show="showHistory">
            <li class="px-4 py-3 border-b border-white w-full box-border hover:bg-[#f9f9f9]">
                <strong class="text-sm text-[#333]">Search History</strong>
            </li>
            @foreach ($history as $historyItem)
                <li class="px-4 py-3 border-b border-white w-full box-border hover:bg-[#f9f9f9]">
                    <a href="#" wire:click.prevent="$set('query', '{{ $historyItem }}')" class="no-underline text-secondary block w-full h-full box-border">
                        {{ $historyItem }}
                    </a>
                </li>
            @endforeach
            <li class="px-4 py-3 border-b border-white w-full box-border hover:bg-[#f9f9f9]">
                <button wire:click="clearHistory" class="bg-none border-none text-red-500 cursor-pointer">Clear History</button>
            </li>
        </ul>
    @endif
</div>
