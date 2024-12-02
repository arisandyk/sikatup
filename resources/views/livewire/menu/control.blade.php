<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @php
            $labels = [
                [
                    'h3' => 'Users',
                    'h2' => $totalUsers,
                    'p' => 'Total Users',
                    'span' => $totalUsersPercentage,
                    'bg' => 'bg-[#e9e3ff]',
                ],
                [
                    'h3' => 'Devices',
                    'h2' => $devices,
                    'p' => 'Total Devices',
                    'span' => $devicesPercentage,
                    'bg' => 'bg-[#ffdede]',
                ],
                [
                    'h3' => 'Locations',
                    'h2' => $locations,
                    'p' => 'Total Places',
                    'span' => $locationsPercentage,
                    'bg' => 'bg-[#cef5de]',
                ],
                [
                    'h3' => 'Alarm Log',
                    'h2' => $alarms,
                    'p' => 'A day ago',
                    'span' => $alarmsPercentage,
                    'bg' => 'bg-[#ffefcc]',
                ],
            ];
        @endphp
        @foreach ($labels as $item)
            <div
                class="bg-white rounded-lg p-5 shadow-md w-full flex flex-row items-center justify-between gap-4 ease-out duration-100 hover:-translate-y-1 hover:shadow-lg">
                <div class="flex flex-col items-start gap-3">
                    <h3 class="text-lg m-0 text-[#7A7A7A]">{{ $item['h3'] }}</h3>
                    <h2 class="text-2xl m-0 text-secondary">{{ $item['h2'] }} <span
                            class="text-green-500 text-sm ml-1">({{ $item['span'] }})</span></h2>
                    <p class="text-sm m-0 text-[#7A7A7A]">{{ $item['p'] }}</p>
                </div>
                <div class="w-14 h-14 rounded-lg flex justify-center items-center shrink-0 {{ $item['bg'] }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-7 stroke-secondary">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
            </div>
        @endforeach
    </div>

    <div class="w-full relative my-5 overflow-x-scroll lg:overflow-auto">
        <table class="border-collapse bg-white rounded-3xl shadow-lg mb-5">
            <thead>
                <tr class="title-row">
                    <th colspan="16" id="title" class="text-lg p-[15px] text-center bg-[#fffdc3] rounded-t-3xl">
                        <div class="flex justify-between items-center mt-3 relative">
                            <div>
                                <h3>
                                    Trans JBT
                                    @foreach ($breadcrumb as $key => $item)
                                        @if ($key === 0)
                                            <!-- Unit Induk -->
                                            <a href="javascript:void(0);" wire:click="breadcrumbSelect('unitInduk')">->
                                                {{ $item }}</a>
                                        @elseif ($key === 1)
                                            <!-- App -->
                                            <a href="javascript:void(0);" wire:click="breadcrumbSelect('app')">->
                                                {{ $item }}</a>
                                        @elseif ($key === 2)
                                            <!-- Basecamp -->
                                            <a href="javascript:void(0);" wire:click="breadcrumbSelect('basecamp')">->
                                                {{ $item }}</a>
                                        @elseif ($key === 3)
                                            <!-- Gardu Induk -->
                                            <a href="javascript:void(0);" wire:click="breadcrumbSelect('garduInduk')">->
                                                {{ $item }}</a>
                                        @endif
                                    @endforeach
                                </h3>
                            </div>
                            <div class="absolute right-0 -top-[10px]">
                                <div class="filter-pill">
                                    <button class="pill-button">Unit Induk:</button>
                                    <select class="pill-dropdown" wire:model="selectedUnitInduk" wire:change='$refresh'>
                                        <option value="">Pilih Unit Induk</option>
                                        @foreach ($unitInduks as $unitInduk)
                                            <option value="{{ $unitInduk->id }}">{{ $unitInduk->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr class="tr-c">
                    <th rowspan="2" class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">
                        @if ($selectedGarduInduk)
                            Bay Name
                        @elseif($selectedBasecamp)
                            Gardu Induk Name
                        @elseif($selectedApp)
                            Basecamp Name
                        @else
                            App Name
                        @endif
                    </th>
                    <th colspan="10" class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">
                        Kejadian Buka-Tutup (Kali)</th>
                    <th rowspan="2" class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">Jumlah
                    </th>
                    <th rowspan="2" class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">
                        Kejadian Terakhir</th>
                    <th rowspan="2" class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">Reset
                    </th> <!-- New column for reset button -->
                    <th rowspan="2" class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">Reset
                        By</th> <!-- New column for reset_by -->
                </tr>
                <tr>
                    <th class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">OBD</th>
                    <th class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">CBD</th>
                    <th class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">OBP</th>
                    <th class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">CBP</th>
                    <th class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">OBR</th>
                    <th class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">CBR</th>
                    <th class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">OBL</th>
                    <th class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">CBL</th>
                    <th class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">OBT</th>
                    <th class="text-lg p-[15px] text-center bg-white border border-[#E0E0E0]">UND</th>
                </tr>
            </thead>
            <tbody>
                @if ($currentView === 'apps')
                    @foreach ($apps as $app)
                        <tr>
                            <td class="td-class text-left font-bold">
                                <a href="javascript:void(0);" wire:click="selectApp({{ $app->id }})">APP
                                    {{ $app->name }}</a>
                            </td>
                            @php
                                $appTotals = collect($app->basecamps)->flatMap(function ($basecamp) {
                                    return collect($basecamp->gardu_induks)->flatMap(function ($garduInduk) {
                                        return collect($garduInduk->bays)->flatMap(function ($bay) {
                                            return collect($bay->controls);
                                        });
                                    });
                                });
                                $lastControl = $appTotals->last();
                            @endphp
                            @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'] as $eventType)
                                <td class="td-class text-red-500 text-center">{{ $appTotals->sum($eventType) }}</td>
                            @endforeach
                            <td class="td-class text-center">
                                {{ $appTotals->sum(fn($control) => collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'])->sum(fn($type) => $control->$type ?? 0)) }}
                            </td>
                            <td class="td-class text-center">
                                {{ $lastControl ? $lastControl->updated_at->format('Y-m-d H:i:s') : '-' }}</td>
                        </tr>
                    @endforeach
                @elseif($currentView === 'basecamps')
                    @foreach ($basecamps as $basecamp)
                        <tr>
                            <td class="td-class text-left font-bold">
                                <a href="javascript:void(0);" wire:click="selectBasecamp({{ $basecamp->id }})">Basecamp
                                    {{ $basecamp->name }}</a>
                            </td>
                            @php
                                $basecampTotals = collect($basecamp->gardu_induks)->flatMap(function ($garduInduk) {
                                    return collect($garduInduk->bays)->flatMap(function ($bay) {
                                        return collect($bay->controls);
                                    });
                                });
                                $lastControl = $basecampTotals->last();
                            @endphp
                            @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'] as $eventType)
                                <td class="td-class text-red-500 text-center">
                                    {{ $basecampTotals->sum($eventType) }}</td>
                            @endforeach
                            <td class="td-class text-center">
                                {{ $basecampTotals->sum(fn($control) => collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'])->sum(fn($type) => $control->$type ?? 0)) }}
                            </td>
                            <td class="td-class text-center">
                                {{ $lastControl ? $lastControl->updated_at->format('Y-m-d H:i:s') : '-' }}</td>
                        </tr>
                    @endforeach
                @elseif($currentView === 'gardu_induks')
                    @foreach ($garduInduks as $garduInduk)
                        <tr>
                            <td class="td-class text-left font-bold">
                                <a href="javascript:void(0);"
                                    wire:click="selectGarduInduk({{ $garduInduk->id }})">Gardu
                                    Induk {{ $garduInduk->name }}</a>
                            </td>
                            @php
                                $garduIndukTotals = collect($garduInduk->bays)->flatMap(function ($bay) {
                                    return collect($bay->controls);
                                });
                                $lastControl = $garduIndukTotals->last();
                            @endphp
                            @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'] as $eventType)
                                <td class="td-class text-red-500 text-center">
                                    {{ $garduIndukTotals->sum($eventType) }}</td>
                            @endforeach
                            <td class="td-class text-center">
                                {{ $garduIndukTotals->sum(fn($control) => collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'])->sum(fn($type) => $control->$type ?? 0)) }}
                            </td>
                            <td class="td-class text-center">
                                {{ $lastControl ? $lastControl->updated_at->format('Y-m-d H:i:s') : '-' }}</td>
                        </tr>
                    @endforeach
                @elseif($currentView === 'bays')
                    @foreach ($bays as $bay)
                        @php
                            $latestControl = $bay->controls->last();
                        @endphp
                        <tr>
                            <td class="td-class text-left font-bold">{{ $bay->name }}</td>
                            @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'] as $eventType)
                                <td
                                    class="{{ $latestControl && $latestControl->$eventType ? 'td-class text-red-500 text-center' : '' }}">
                                    {{ $latestControl->$eventType ?? 0 }}
                                </td>
                            @endforeach
                            <td class="td-class text-center">
                                {{ collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'])->sum(fn($eventType) => $latestControl->$eventType ?? 0) }}
                            </td>
                            <td class="td-class text-center">
                                {{ $latestControl ? $latestControl->updated_at->format('Y-m-d H:i:s') : '-' }}</td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td class="td-class text-center font-bold rounded-bl-[20px]">Total</td>
                    @php
                        $totals = [
                            'obd' => 0,
                            'cbd' => 0,
                            'obp' => 0,
                            'cbp' => 0,
                            'obr' => 0,
                            'cbr' => 0,
                            'obl' => 0,
                            'cbl' => 0,
                            'obt' => 0,
                            'und' => 0,
                        ];
                        $controlsCollection = collect();

                        if ($currentView === 'apps') {
                            $controlsCollection = collect($apps)->flatMap(
                                fn($app) => $app->basecamps->flatMap(
                                    fn($basecamp) => $basecamp->gardu_induks->flatMap(
                                        fn($gi) => $gi->bays->flatMap(fn($bay) => $bay->controls),
                                    ),
                                ),
                            );
                        } elseif ($currentView === 'basecamps') {
                            $controlsCollection = collect($basecamps)->flatMap(
                                fn($basecamp) => $basecamp->gardu_induks->flatMap(
                                    fn($gi) => $gi->bays->flatMap(fn($bay) => $bay->controls),
                                ),
                            );
                        } elseif ($currentView === 'gardu_induks') {
                            $controlsCollection = collect($garduInduks)->flatMap(
                                fn($gi) => $gi->bays->flatMap(fn($bay) => $bay->controls),
                            );
                        } elseif ($currentView === 'bays') {
                            $controlsCollection = collect($bays)->flatMap(fn($bay) => $bay->controls);
                        }

                        foreach ($controlsCollection as $control) {
                            foreach (array_keys($totals) as $key) {
                                $totals[$key] += $control->$key ?? 0;
                            }
                        }
                    @endphp

                    @foreach ($totals as $total)
                        <td class="td-class text-center">{{ $total }}</td>
                    @endforeach
                    <td class="td-class text-center">{{ array_sum($totals) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3 bg-white md:bg-transparent rounded-2xl md:rounded-none p-4 md:p-0 drop-shadow-md md:drop-shadow-none">
        @php
            $legends = [
                [
                    'acronym' => 'OBD',
                    'name' => 'Opened By Device',
                ],
                [
                    'acronym' => 'OBP',
                    'name' => 'Opened By Protection',
                ],
                [
                    'acronym' => 'OBR',
                    'name' => 'Opened By Remote',
                ],
                [
                    'acronym' => 'OBL',
                    'name' => 'Opened By Local',
                ],
                [
                    'acronym' => 'OBT',
                    'name' => 'Opened By Teleporter',
                ],
                [
                    'acronym' => 'CBD',
                    'name' => 'Close By Device',
                ],
                [
                    'acronym' => 'CBP',
                    'name' => 'Close By Protection',
                ],
                [
                    'acronym' => 'CBR',
                    'name' => 'Close By Remote',
                ],
                [
                    'acronym' => 'CBL',
                    'name' => 'Close By Local',
                ],
                [
                    'acronym' => 'UND',
                    'name' => 'Undefined',
                ],
            ];
        @endphp
        @foreach ($legends as $item)
            <div class="flex items-center gap-x-3 md:bg-white md:p-2 md:rounded-full md:drop-shadow-lg">
                <span
                    class="text-sm text-white bg-red-500 py-1 px-3 rounded-2xl flex items-center justify-center">{{ $item['acronym'] }}</span>
                <span class="text-sm text-secondary">{{ $item['name'] }}</span>
            </div>
        @endforeach
    </div>
</div>
