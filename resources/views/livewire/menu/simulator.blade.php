<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    <div class="grid grid-rows-1 gap-3 my-5 md:grid-cols-3 lg:grid-cols-4 items-center">
        <div class="flex flex-col md:flex-row gap-3 justify-between w-full md:col-span-2 lg:col-span-3">
            <select wire:model.live="filterUnitInduk" wire:click="loadApp"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select Unit Induk</option>
                @foreach ($availableUnitInduks as $key => $unitInduk)
                    <option value="{{ $key }}">{{ ucfirst($unitInduk) }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterApp" wire:click="loadBasecamp"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select App</option>
                @foreach ($availableApp as $key => $app)
                    <option value="{{ $key }}">{{ ucfirst($app) }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterBasecamp" wire:click="loadGarduInduk"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select Basecamp</option>
                @foreach ($availableBasecamps as $key => $basecamp)
                    <option value="{{ $key }}">{{ ucfirst($basecamp) }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterGarduInduk" wire:click="loadButton"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select Gardu Induk</option>
                @foreach ($availableGarduInduks as $key => $garduInduk)
                    <option value="{{ $key }}">{{ ucfirst($garduInduk) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="relative my-5 space-y-4">
        <div class="w-full bg-white rounded-lg flex justify-center shadow-lg border p-4">
            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="172mm" height="120mm" version="1.1"
                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                viewBox="0 0 17200 12000" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Layer_x0020_1">
                    <metadata id="CorelCorpID_0Corel-Layer" />
                    <g id="_2785720127792">
                        <line class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0" x1="2927.83" y1="663.54"
                            x2="2927.83" y2= "5383.71" />
                        <line class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0" x1="2922.99" y1="829.97"
                            x2="2597.1" y2= "829.97" />
                        <rect class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0" x="2120.71" y="684.51" width="476.39"
                            height="303.45" />
                        <line class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0" x1="2119.53" y1="683.77"
                            x2="2597.76" y2= "977.42" />
                        <line class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0" x1="2598.77" y1="684.58"
                            x2="2120.71" y2= "978.13" />
                        <polygon class="{{ $isActive[0] ? 'fil2' : 'fil1' }}"
                            points="1559.13,829.06 1726.7,750.66 1894.27,672.26 1894.27,829.06 1894.27,985.86 1726.7,907.45 " />
                        <line class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0" x1="2111.77" y1="829.06"
                            x2="1894.27" y2= "829.06" />
                        <polygon class="{{ $isActive[0] ? 'fil2' : 'fil1' }}"
                            points="2914.16,179.89 3022.31,419.39 3130.47,658.9 2913.46,658.9 2696.45,658.9 2805.31,419.39 " />
                        <line class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0" x1="2927.83" y1="1395.23"
                            x2="2636.52" y2= "1395.23" />
                        <polyline class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0"
                            points="2936.96,2037.89 3150.84,2037.89 3275.72,1897.39 " />
                        <circle class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0" cx="2918.07" cy="2789.03"
                            r="220.48" />
                        <rect class="{{ $isActive[0] ? 'fil2' : 'fil1' }}" x="2702.88" y="3155.84" width="464.35"
                            height="422.02" />
                        <polygon class="{{ $isActive[0] ? 'fil2' : 'fil1' }}"
                            points="3833.66,1996.95 3703.1,2088.23 3572.53,2179.51 3572.53,2043.25 3441.63,2043.25 3441.63,1944.03 3572.53,1944.03 3572.53,1814.38 3703.1,1905.67 " />
                        <polyline class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0"
                            points="2927.83,4030.29 3549.61,4030.29 3549.61,4376.9 " />
                        <polyline class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0"
                            points="3544.34,6573.08 3544.34,4890.32 3771.88,4408.78 " />
                        <path class="{{ $isActive[0] ? 'str1' : 'str0' }} fil0"
                            d="M2452.37 1209.33c101.56,0 183.89,81.73 183.89,182.56 0,100.83 -82.33,182.56 -183.89,182.56 -101.56,0 -183.89,-81.73 -183.89,-182.56 0,-100.83 82.33,-182.56 183.89,-182.56zm-197.12 0c101.56,0 183.89,81.73 183.89,182.56 0,100.83 -82.33,182.56 -183.89,182.56 -101.56,0 -183.89,-81.73 -183.89,-182.56 0,-100.83 82.33,-182.56 183.89,-182.56z" />
                        <g>
                            <polygon class="{{ $isActive[1] ? 'fil2' : 'fil1' }}"
                                points="6323.65,11820.12 6215.5,11580.62 6107.34,11341.11 6324.35,11341.11 6541.36,11341.11 6432.5,11580.62 " />
                            <line class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" x1="6324.35" y1="11341.11"
                                x2="6324.35" y2= "5431.65" />
                            <line class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" x1="6920.82" y1="6575.27"
                                x2="6920.82" y2= "7030.35" />
                            <polyline class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0"
                                points="6324.35,7972.27 6931.4,7972.27 6931.4,7607.14 7153.65,7125.6 " />
                            <rect class="{{ $isActive[1] ? 'fil2' : 'fil1' }}" x="6116.49" y="8064.86" width="425.98"
                                height="338.67" />
                            <circle class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" cx="6324.35" cy="8697.23"
                                r="207.54" />
                            <g>
                                <rect class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" x="5496.27" y="9025.5"
                                    width="619.66" height="354.42" />
                                <line class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" x1="5494.73"
                                    y1="9024.64" x2="6116.79" y2= "9367.61" />
                                <line class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" x1="6118.1"
                                    y1="9025.59" x2="5496.26" y2= "9368.43" />
                            </g>
                            <polygon class="{{ $isActive[1] ? 'fil2' : 'fil1' }}"
                                points="4765.81,9210.57 4976.83,9115.65 5187.85,9020.73 5187.85,9210.57 5187.85,9400.42 4976.83,9305.49 " />
                            <line class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" x1="5500.9" y1="9211.56"
                                x2="5189.12" y2= "9211.56" />
                            <circle class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" cx="6324.35" cy="9922.98"
                                r="191.82" />
                            <circle class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" cx="6435.47" cy="10105.54"
                                r="191.82" />
                            <circle class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" cx="6211.9" cy="10105.54"
                                r="191.82" />
                            <line class="{{ $isActive[1] ? 'str1' : 'str0' }} fil0" x1="6324.35" y1="9198.63"
                                x2="6115.93" y2= "9198.63" />
                        </g>
                        <line class="{{ $isActive[2] ? 'str1' : 'str0' }} fil0" x1="10889.84" y1="6572.6"
                            x2="10889.84" y2= "7133.52" />
                        <line class="{{ $isActive[2] ? 'str1' : 'str0' }} fil0" x1="13683.85" y1="6572.6"
                            x2="13683.85" y2= "7133.52" />
                        <rect class="{{ $isActive[2] ? 'fil2' : 'fil1' }}" x="12661.21" y="7810.85" width="329.41"
                            height="428.62" />
                        <line class="{{ $isActive[2] ? 'str1' : 'str0' }} fil0" x1="11170.26" y1="7195.7"
                            x2="10932.14" y2= "7695.76" />
                        <polyline class="{{ $isActive[2] ? 'str1' : 'str0' }} fil0"
                            points="10932.14,7695.76 10932.14,8023.85 13710.25,8023.85 13710.25,7671.98 13943.08,7169.27 " />
                        <circle class="{{ $isActive[2] ? 'fil2' : 'fil1' }}" cx="12033.41" cy="8027.81"
                            r="231.52" />
                        <line class="{{ $isActive[2] ? 'str1' : 'str0' }} fil0" x1="52.75" y1="5436.17"
                            x2="17147.25" y2= "5436.17" />
                        <line class="{{ $isActive[2] ? 'str1' : 'str0' }} fil0" x1="52.75" y1="6622.67"
                            x2="17147.25" y2= "6622.67" />
                    </g>
                </g>
            </svg>
        </div>

        @php
            $legends = [
                [
                    'acronym' => 'OBD',
                    'name' => 'Opened By Device',
                ],
                [
                    'acronym' => 'CBD',
                    'name' => 'Close By Device',
                ],
                [
                    'acronym' => 'OBP',
                    'name' => 'Opened By Protection',
                ],
                [
                    'acronym' => 'CBP',
                    'name' => 'Close By Protection',
                ],
                [
                    'acronym' => 'OBR',
                    'name' => 'Opened By Remote',
                ],
                [
                    'acronym' => 'CBR',
                    'name' => 'Close By Remote',
                ],
                [
                    'acronym' => 'OBL',
                    'name' => 'Opened By Local',
                ],
                [
                    'acronym' => 'CBL',
                    'name' => 'Close By Local',
                ],
                [
                    'acronym' => 'OBT',
                    'name' => 'Opened By Teleporter',
                ],
                [
                    'acronym' => 'UND',
                    'name' => 'Undefined',
                ],
            ];
        @endphp

        @foreach ($buttons as $item)            
            @if ($item->event != null)
                <div class="w-full bg-white rounded-lg shadow-lg border p-4 space-y-5">
                    <h1>{{ $item->name }}</h1>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3 bg-white md:bg-transparent rounded-2xl md:rounded-none p-4 md:p-0 drop-shadow-md md:drop-shadow-none">
                        @foreach ($legends as $eventType)
                            <button
                                class="flex items-center gap-x-3 md:bg-white md:p-2 md:rounded-full md:drop-shadow-lg"
                                wire:click="showDialog({{ $item->id }}, '{{ $eventType['acronym'] }}')">
                                <span
                                    class="text-sm text-white {{ $item->event[strtolower($eventType['acronym'])] == 1 ? 'bg-green-500' : 'bg-red-500' }} py-1 px-3 rounded-2xl flex items-center justify-center">
                                    {{ $eventType['acronym'] }}
                                </span>
                                <span class="text-sm text-secondary">{{ $eventType['name'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

    </div>
    <div
        class="w-full h-screen bg-black/50 overflow-hidden fixed top-0 left-0 z-[100] {{ $display }} justify-center items-center p-4">
        <div
            class="w-full md:w-1/3 relative bg-[#FCFBE8] px-6 pb-8 pt-10 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:rounded-lg sm:px-10 rounded-lg md:p-4 space-y-4">
            <div class="flex items-center flex-col gap-y-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-28 h-28 stroke-[#b1b0a2]">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                </svg>
                <h2 class="text-base">Apakah anda yakin ?</h2>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <button class="px-4 py-1 w-full text-sm rounded-lg bg-red-500 hover:bg-red-600 text-white"
                    wire:click="hideDialog()">Tidak</button>
                <button class="px-4 py-1 w-full text-sm rounded-lg bg-green-500 hover:bg-green-600 text-white"
                    wire:click="makeAlert()">Ya</button>
            </div>
        </div>
    </div>
</div>
