<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    <div class="grid grid-rows-2 gap-3 my-5 md:grid-rows-1 md:grid-cols-3 lg:grid-cols-4 items-center">
        <div class="flex flex-col md:flex-row gap-3 justify-between w-full md:col-span-2 lg:col-span-3">
            <select wire:model.live="filterUnitInduk"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select Unit Induk</option>
                @foreach ($availableUnitInduks as $key => $unitInduk)
                    <option value="{{ $key }}">{{ ucfirst($unitInduk) }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterApp" wire:click="loadApp"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select App</option>
                @foreach ($availableApp as $key => $app)
                    <option value="{{ $key }}">{{ ucfirst($app) }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterBasecamp" wire:click="loadBasecamp"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select Basecamp</option>
                @foreach ($availableBasecamps as $key => $basecamp)
                    <option value="{{ $key }}">{{ ucfirst($basecamp) }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterGarduInduk" wire:click="loadGarduInduk"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select Gardu Induk</option>
                @foreach ($availableGarduInduks as $key => $garduInduk)
                    <option value="{{ $key }}">{{ ucfirst($garduInduk) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="relative my-5">
        <div class="w-full bg-white rounded-lg flex justify-center shadow-lg border">
            <img src="{{ asset($imageCondition)}}" alt="Single Line Diagram" class="w-1/2 h-auto bg-cover">
        </div>
    </div>
</div>
