<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
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
                <h3 class="text-lg m-0 text-[#7A7A7A]">Devices</h3>
                <h2 class="text-2xl m-0 text-secondary">{{ $devices }} <span
                        class="text-green-500 text-sm ml-1">({{ $devicesPercentage }})</span></h2>
                <p class="text-sm m-0 text-[#7A7A7A]">Total Devices</p>
            </div>
            <div class="w-14 h-14 rounded-lg flex justify-center items-center shrink-0 bg-[#ffdede]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-7 stroke-secondary">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 19.5h3m-6.75 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-15a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 4.5v15a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
            </div>
        </div>
        <div
            class="bg-white rounded-lg p-5 shadow-md w-full flex flex-row items-center justify-between gap-4 ease-out duration-100 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex flex-col items-start gap-3">
                <h3 class="text-lg m-0 text-[#7A7A7A]">Locations</h3>
                <h2 class="text-2xl m-0 text-secondary">{{ $locations }} <span
                        class="text-green-500 text-sm ml-1">({{ $locationsPercentage }})</span></h2>
                <p class="text-sm m-0 text-[#7A7A7A]">Total Places</p>
            </div>
            <div class="w-14 h-14 rounded-lg flex justify-center items-center shrink-0 bg-[#cef5de]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 stroke-secondary">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                  </svg>
                  
            </div>
        </div>
        <div
            class="bg-white rounded-lg p-5 shadow-md w-full flex flex-row items-center justify-between gap-4 ease-out duration-100 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex flex-col items-start gap-3">
                <h3 class="text-lg m-0 text-[#7A7A7A]">Alarm Log</h3>
                <h2 class="text-2xl m-0 text-secondary">{{ $alarms }} <span
                        class="text-green-500 text-sm ml-1">({{ $alarmsPercentage }})</span></h2>
                <p class="text-sm m-0 text-[#7A7A7A]">A day ago</p>
            </div>
            <div class="w-14 h-14 rounded-lg flex justify-center items-center shrink-0 bg-[#ffefcc]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 stroke-secondary">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                  </svg>
                  
            </div>
        </div>
    </div>

    <div class="my-5">
        <img src="{{ asset('images/schematic.png') }}" alt="Schematic Diagram" class="w-full h-auto rounded-lg">
    </div>
    <div class="text-left space-y-2">
        <h2 class="text-lg font-medium text-secondary">Location</h2>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509375!2d144.95373631531744!3d-37.81627997975183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf5773c1c3b00b0f!2sDocklands%2C%20VIC%203008%2C%20Australia!5e0!3m2!1sen!2sus!4v1633016171237!5m2!1sen!2sus"
            allowfullscreen
            class="w-full h-[400px] rounded-lg border shadow-lg"
        ></iframe>
    </div>
    {{-- <!-- Right Column (md-3) -->
        <div class="col-md-3">
            <div class="user-alerts">
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
            </div>
        </div> --}}
</div>
</div>
