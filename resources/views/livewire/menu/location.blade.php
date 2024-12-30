<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    @if (session()->has('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

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
                    'h2' => $locationCount,
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
    <div class="w-full relative my-5 overflow-x-auto lg:overflow-hidden">
        <div class="flex justify-between items-center mb-5 flex-wrap gap-3">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search..."
                class="flex-grow p-3 rounded-lg border text-sm min-w-52">
            <select wire:model="perPage" class="p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white rounded-3xl shadow-lg mb-5 min-w-[800px]">
                <thead>
                    <tr class="title-row">
                        <th class="text-lg p-5 text-center bg-[#fffdc3] rounded-tl-2xl">GI/GITET</th>
                        <th class="text-lg p-5 text-center bg-[#fffdc3]">Address</th>
                        <th class="text-lg p-5 text-center bg-[#fffdc3]">Latitude</th>
                        <th class="text-lg p-5 text-center bg-[#fffdc3] rounded-tr-2xl">Longitude</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                        <tr>
                            <td class="td-class text-center">{{ $location->gardu_induks->name }}</td>
                            <td class="td-class">{{ $location->address }}</td>
                            <td class="td-class text-center">{{ $location->latitude }}</td>
                            <td class="td-class text-center">{{ $location->longitude }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $locations->links() }}
    </div>

</div>
</div>
