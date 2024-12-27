<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="grid grid-cols-1 gap-4 @if (Auth::user()->role != 'admin') md:grid-cols-1 @else md:grid-cols-3 @endif">
        <div class="space-y-5 col-span-2">
            <div class="grid grid-cols-1 @if (Auth::user()->role != 'admin') md:grid-cols-4 @else md:grid-cols-2 @endif gap-4">
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-7 stroke-secondary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>

            <img src="{{ asset('images/schematic.png') }}" alt="Schematic Diagram" class="w-full h-auto rounded-lg">
            <div class="text-left space-y-2">
                <h2 class="text-lg font-medium text-secondary">Location</h2>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509375!2d144.95373631531744!3d-37.81627997975183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf5773c1c3b00b0f!2sDocklands%2C%20VIC%203008%2C%20Australia!5e0!3m2!1sen!2sus!4v1633016171237!5m2!1sen!2sus"
                    allowfullscreen class="w-full h-[400px] rounded-lg border shadow-lg"></iframe>
            </div>
        </div>

        <!-- Right Column (md-3) -->
        <div>
            <div class="flex flex-col gap-4">
                @if (Auth::user()->role == 'admin')
                    <!-- Requests Section -->
                    <div class="flex justify-between items-center">
                        <h3 class="text-[18px] text-secondary m-0">Request</h3>
                        <!-- Updated <a> tag with wire:click to show the modal -->
                        <a href="#" class="text-[14px] text-red-500 no-underline" wire:click="triggerModal">View all</a>
                    </div>
                    <div class="p-4 rounded-lg bg-white space-y-5 text-pretty">
                        @if ($recentPendingUsers->isEmpty())
                            <p class="text-center">No pending requests.</p>
                        @else
                            @foreach ($recentPendingUsers as $user)
                                <div class="flex items-center">
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $user->name }}"
                                        class="w-14 h-14 rounded-full object-cover mr-4">
                                    <div class="overflow-hidden">
                                        <h4 class="text-[16px] m-0 text-secondary truncate">{{ $user->name }}</h4>
                                        <p class="text-[14px] mt-1 text-[#7A7A7A] truncate">{{ $user->email }}</p>
                                        <!-- Buttons to accept or reject user -->
                                        <div class="mt-2 space-x-2 md:space-x-0 md:space-y-2">
                                            <button class="p-2 bg-green-500 text-white rounded-lg w-fit md:w-full"
                                                wire:click="acceptUser({{ $user->id }})">Accept</button>
                                            <button class="p-2 bg-red-500 text-white rounded-lg w-fit md:w-full"
                                                wire:click="rejectUser({{ $user->id }})">Reject</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                @endif
            </div>

            <!-- Modal -->
            <div class="fixed z-[1050] left-0 top-0 w-full h-full overflow-hidden outline-0 bg-black/30 @if ($showModal) flex justify-center items-center @else hidden @endif" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="m-auto max-w-[500px]" role="document">
                    <div class="bg-white rounded-lg p-5">
                        <div class="border-b border-[#e5e5e5] flex justify-between items-center">
                            <h5 class="m-auto text-[18px] font-bold">Pending User Requests</h5>
                            <button type="button" class="bg-none border-none text-[24px] leading-3 text-black" wire:click="closeModal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="py-5 space-y-4">
                            @foreach ($recentPendingUsers as $user)
                                <div class="flex items-center">
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $user->name }}"
                                        class="w-14 h-14 rounded-full object-cover mr-4">
                                    <div class="overflow-hidden">
                                        <h4 class="text-[16px] m-0 text-secondary truncate">{{ $user->name }}</h4>
                                        <p class="text-[14px] mt-1 text-[#7A7A7A] truncate">{{ $user->email }}</p>
                                        <!-- Buttons to accept or reject user -->
                                        <div class="mt-2 space-x-2 md:space-x-0 md:space-y-2">
                                            <button class="p-2 bg-green-500 text-white rounded-lg w-fit md:w-full"
                                                wire:click="acceptUser({{ $user->id }})">Accept</button>
                                            <button class="p-2 bg-red-500 text-white rounded-lg w-fit md:w-full"
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
            </div>
        </div>
    </div>
</div>
