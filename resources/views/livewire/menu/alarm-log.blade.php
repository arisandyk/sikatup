<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    @if (session()->has('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="alert-danger">
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
                    'h2' => $locations,
                    'p' => 'Total Places',
                    'span' => $locationsPercentage,
                    'bg' => 'bg-[#cef5de]',
                ],
                [
                    'h3' => 'Alarm Log',
                    'h2' => $alarmsCount,
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

    <div class="grid gap-3 my-5 md:grid-rows-1 md:grid-cols-3 lg:grid-cols-4 items-center">
        <!-- Filter Dropdowns -->
        <div class="flex flex-col md:flex-row gap-3 justify-between w-full md:col-span-2 lg:col-span-3">
            <select wire:model.live="selectedLocation"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Filter by Location</option>
                @foreach ($locationsList as $location)
                    <option value="{{ $location->id }}">{{ $location->address }}</option>
                @endforeach
            </select>
            <select wire:model.live="selectedDevice" wire:change="loadAlarms"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Filter by Bay</option>
                @foreach ($devicesList as $device)
                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                @endforeach
            </select>
            <select wire:model.live="selectedEvent" wire:change="loadAlarms"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Filter by Event</option>
                <option value="Opened By Device">Opened By Device</option>
                <option value="Opened By Protection">Opened By Protection</option>
                <option value="Opened By Remote">Opened By Remote</option>
                <option value="Opened By Local">Opened By Local</option>
                <option value="Opened By Teleporter">Opened By Teleporter</option>
                <option value="Close By Device">Close By Device</option>
                <option value="Close By Protection">Close By Protection</option>
                <option value="Close By Remote">Close By Remote</option>
                <option value="Close By Local">Close By Local</option>
                <option value="Undefined">Undefined</option>
            </select>
        </div>

        <!-- Export Button -->
        <div class="w-full">
            <button
                class="w-full bg-secondary text-white py-3 px-6 outline-none rounded-lg cursor-pointer text-base transition ease-in-out whitespace-nowrap"
                onclick="toggleExportDropdown()">Export</button>
            <div id="exportDropdown"
                class="hidden absolute bg-white shadow-lg rounded-lg z-[1] min-w-44 py-1 px-0 mt-4 mr-4">
                <button wire:click="exportToExcel"
                    class="py-3 px-20 text-secondary bg-transparent outline-none text-left w-full text-sm transition ease-out">Export
                    to Excel</button>
                <button wire:click="exportToPDF"
                    class="py-3 px-20 text-secondary bg-transparent outline-none text-left w-full text-sm transition ease-out">Export
                    to PDF</button>
            </div>
        </div>
    </div>
    
    <!-- Search and Per Page Selection -->
    <div class="flex justify-between items-center mb-5 flex-wrap gap-3">
        <input type="text" wire:model.debounce.300ms="search" wire:change="loadAlarms" placeholder="Search..."
            class="flex-grow p-3 rounded-lg border text-sm min-w-52">
        <select wire:model="perPage" wire:change="loadAlarms"
            class="p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
    
    <div class="w-full relative my-5 overflow-x-scroll">

        <!-- Table -->
        <table class="w-full border-collapse bg-white rounded-3xl shadow-lg mb-5">
            <thead>
                <tr class="title-row">
                    <th class="text-lg p-5 text-center bg-[#fffdc3]">Date Log</th>
                    <th class="text-lg p-5 text-center bg-[#fffdc3]">Location</th>
                    <th class="text-lg p-5 text-center bg-[#fffdc3]">Gardu Induk</th>
                    <th class="text-lg p-5 text-center bg-[#fffdc3]">Bay</th>
                    <th class="text-lg p-5 text-center bg-[#fffdc3]">Event</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alarms as $alarm)
                    <tr>
                        <td class="td-class text-center">
                            {{ \Carbon\Carbon::parse($alarm->date_log)->format('d-m-Y H:i') }}
                        </td>
                        <td class="td-class text-center">{{ $alarm->locations->address ?? 'Unknown Location' }}</td>
                        <td class="td-class text-center">
                            {{ $alarm->locations->gardu_induks->name ?? 'Unknown Gardu Induk' }}</td>
                        <td class="td-class text-center">{{ $alarm->event->bays->name ?? 'Unknown Device' }}</td>
                        <td class="td-class text-center">{{ $alarm->event_type ?? 'Unknown Event' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $alarms->links() }}
    </div>

    <!-- Right Column (md-3) -->
    <div class="col-md-3">
        {{-- <div class="user-alerts">
            @if (Auth::user()->role == 'admin')
                <!-- Requests Section -->
                <div class="section-header">
                    <h3>Request</h3>
                    <!-- Updated <a> tag with wire:click to show the modal -->
                    <a href="#" class="view-all" wire:click.prevent="showModal">View all</a>
                </div>
                <div class="request-list card">
                    @if ($recentPendingUsers->isEmpty())
                        <p class="text-center">No pending requests.</p>
                    @else
                        @foreach ($recentPendingUsers as $user)
                            <div class="request-item d-flex align-items-center">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $user->name }}"
                                    class="avatar-img">
                                <div class="request-info">
                                    <h4>{{ $user->name }}</h4>
                                    <p>{{ $user->email }}</p>
                                    <!-- Buttons to accept or reject user -->
                                    <div class="action-buttons mt-2">
                                        <button class="btn btn-success btn-sm"
                                            wire:click="acceptUser({{ $user->id }})">Accept</button>
                                        <button class="btn btn-danger btn-sm"
                                            wire:click="rejectUser({{ $user->id }})">Reject</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
            @endif
        </div>

        <!-- Modal -->
        <div class="modal fade @if ($showModal) show @endif" tabindex="-1" role="dialog"
            style="display: @if ($showModal) block @else none @endif;"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pending User Requests</h5>
                        <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach ($pendingUsers as $user)
                            <div class="request-item d-flex align-items-center mb-2">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $user->name }}"
                                    class="avatar-img">
                                <div class="request-info">
                                    <h4>{{ $user->name }}</h4>
                                    <p>{{ $user->email }}</p>
                                    <div class="action-buttons mt-2">
                                        <button class="btn btn-success btn-sm"
                                            wire:click="acceptUser({{ $user->id }})">Accept</button>
                                        <button class="btn btn-danger btn-sm"
                                            wire:click="rejectUser({{ $user->id }})">Reject</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if ($pendingUsers->isEmpty())
                            <p class="text-center">No pending requests.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
