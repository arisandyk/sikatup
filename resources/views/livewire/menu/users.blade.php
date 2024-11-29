<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div
            class="bg-white rounded-lg p-5 shadow-md w-full flex flex-row items-center justify-between gap-4 ease-out duration-100 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex flex-col items-start gap-3">
                <h3 class="text-lg m-0 text-[#7A7A7A]">Users</h3>
                <h2 class="text-2xl m-0 text-secondary">{{ $totalUsers }} <span
                        class="text-green-500 text-sm ml-1">({{ $totalUsersPercentage }})</span></h2>
                <p class="text-sm m-0 text-[#7A7A7A]">Total Users</p>
            </div>
            <div class="w-14 h-14 rounded-lg flex justify-center items-center shrink-0 bg-[#e9e3ff]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-7 stroke-secondary">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
        </div>
        <div
            class="bg-white rounded-lg p-5 shadow-md w-full flex flex-row items-center justify-between gap-4 ease-out duration-100 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex flex-col items-start gap-3">
                <h3 class="text-lg m-0 text-[#7A7A7A]">Inactive Users</h3>
                <h2 class="text-2xl m-0 text-secondary">{{ $inactiveUsers }} <span
                        class="text-green-500 text-sm ml-1">({{ $inactiveUsersPercentage }})</span></h2>
                <p class="text-sm m-0 text-[#7A7A7A]">Last week analytics</p>
            </div>
            <div class="w-14 h-14 rounded-lg flex justify-center items-center shrink-0 bg-[#ffdede]">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-x">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                    <path d="M22 22l-5 -5" />
                    <path d="M17 22l5 -5" />
                </svg>
            </div>
        </div>
        <div
            class="bg-white rounded-lg p-5 shadow-md w-full flex flex-row items-center justify-between gap-4 ease-out duration-100 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex flex-col items-start gap-3">
                <h3 class="text-lg m-0 text-[#7A7A7A]">Active Users</h3>
                <h2 class="text-2xl m-0 text-secondary">{{ $activeUsers }} <span
                        class="text-green-500 text-sm ml-1">({{ $activeUsersPercentage }})</span></h2>
                <p class="text-sm m-0 text-[#7A7A7A]">Last week analytics</p>
            </div>
            <div class="w-14 h-14 rounded-lg flex justify-center items-center shrink-0 bg-[#cef5de]">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="size-7 stroke-secondary">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                    <path d="M15 19l2 2l4 -4" />
                </svg>
            </div>
        </div>
        <div
            class="bg-white rounded-lg p-5 shadow-md w-full flex flex-row items-center justify-between gap-4 ease-out duration-100 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex flex-col items-start gap-3">
                <h3 class="text-lg m-0 text-[#7A7A7A]">Pending Users</h3>
                <h2 class="text-2xl m-0 text-secondary">{{ $pendingUsers }} <span
                        class="text-green-500 text-sm ml-1">({{ $pendingUsersPercentage }})</span></h2>
                <p class="text-sm m-0 text-[#7A7A7A]">A day ago</p>
            </div>
            <div class="w-14 h-14 rounded-lg flex justify-center items-center shrink-0 bg-[#ffefcc]">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="size-7 stroke-secondary">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5" />
                    <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M20.2 20.2l1.8 1.8" />
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-rows-2 gap-3 my-4 md:grid-rows-1 md:grid-cols-3 lg:grid-cols-4 items-center">
        <!-- Filter Dropdowns -->
        <div class="flex flex-col md:flex-row gap-3 justify-between w-full md:col-span-2 lg:col-span-3">
            <select wire:model.live="filterRole"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select Role</option>
                @foreach ($availableRoles as $role)
                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterUnitInduk"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select Unit Induk</option>
                @foreach ($availableUnits as $unit)
                    <option value="{{ $unit }}">{{ $unit }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterStatus"
                class="w-full flex p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer ease-out duration-100">
                <option value="">Select Status</option>
                @foreach ($availableStatuses as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <!-- Export Button -->
        <div class="w-full">
            <button
                class="w-full bg-secondary text-white py-3 px-6 outline-none rounded-lg cursor-pointer text-base transition ease-in-out whitespace-nowrap"
                onclick="toggleExportDropdown()">Export</button>
            <div id="exportDropdown" class="hidden absolute bg-white shadow-lg rounded-lg z-[1] min-w-44 py-1 px-0 mt-4 mr-4">
                <button wire:click="exportToExcel"
                    class="py-3 px-20 text-secondary bg-transparent outline-none text-left w-full text-sm transition ease-out">Export
                    to Excel</button>
                <button wire:click="exportToPDF"
                    class="py-3 px-20 text-secondary bg-transparent outline-none text-left w-full text-sm transition ease-out">Export
                    to PDF</button>
            </div>
        </div>
    </div>
    <div class="relative mt-3">
        <!-- Search and Per Page Selection -->
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

        <div class="flex items-center sm:justify-center">
            <table class="w-full border-collapse bg-white rounded-3xl shadow-lg mb-5">
                <thead class="sr-only md:not-sr-only">
                    <tr class="title-row">
                        <th class="text-lg p-5 text-center bg-primary">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th class="text-lg p-5 text-center bg-primary">User</th>
                        <th class="text-lg p-5 text-center bg-primary">Role</th>
                        <th class="text-lg p-5 text-center bg-primary">Unit Induk</th>
                        <th class="text-lg p-5 text-center bg-primary">App</th>
                        <th class="text-lg p-5 text-center bg-primary">Status</th>
                        <th class="text-lg p-5 text-center bg-primary">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="tr-class">
                            <td class="td-class">
                                <input type="checkbox" class="user-checkbox">
                            </td>
                            <td class="td-class">
                                <div class="flex items-center text-secondary mt-3">
                                    <img src="{{ 'storage/' . $user->image }}" alt="{{ $user->name }}"
                                        class="user-avatar">
                                    <span>{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="td-class">
                                <span>{{ ucfirst($user->role) }}</span>
                            </td>
                            <td class="td-class">
                                <span>{{ $user->unit_name }}</span>
                            </td>
                            <td class="td-class">
                                <span>{{ $user->app_name }}</span>
                            </td>
                            @php
                                $statusClass = match ($user->account_status) {
                                    'active' => 'bg-[#bafdca] text-[#06be31]',
                                    'pending' => 'bg-[#ffe4b3] text-[#ff9800]',
                                    default => 'bg-[#ffc1c1] text-[#ff0000]',
                                };
                            @endphp
                            <td class="td-class">
                                <span
                                    class="font-semibold rounded-lg text-sm py-1 px-2 inline-block text-center leading-5 {{ $statusClass }}">
                                    {{ ucfirst($user->account_status) }}
                                </span>
                            </td>
                            <td class="td-class">
                                <div class="flex items-center justify-center">
                                    <!-- Tombol Delete -->
                                    <button wire:click="triggerDeleteModal({{ $user->id }})"
                                        class="bg-red-500 text-white border-0 rounded-lg w-10 h-10 flex justify-center items-center cursor-pointer shadow-lg transition ease-out hover:bg-red-600 hover:scale-[1.1] hover:shadow-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="w-6 h-6 fill-none stroke-white transition ease-out">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </div>
    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-5 flex justify-center">
            {{ $users->links() }}
        </div>
        <div class="mt-3 text-right text-sm text-[#7a7a7a]">
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} records
        </div>
    </div>
    <!-- User Table -->
    <livewire:components.delete-user-modal />
</div>
