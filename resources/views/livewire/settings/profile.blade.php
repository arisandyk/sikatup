<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    <div class="bg-white rounded-md shadow-lg overflow-hidden mb-[30px] w-full">
        <div class="h-[200px] bg-gradient-to-r from-[#F7E43E] to-[#FFFDC3]"></div>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-5 relative -mt-[50px]">
            <div class="mt-0 flex items-center">
                <div class="flex flex-col md:flex-row">
                    <img src="{{ 'storage/' . Auth::user()->image }}" alt="User Image"
                        class="w-[140px] h-[140px] rounded-md border-[4px] mr-5 shadow-lg bg-white -mt-[20px]">
                    <div class="flex flex-col">
                        <h1 class="text-[20px] text-secondary font-bold mt-[40px]">{{ Auth::user()->name }}</h1>
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="text-sm text-[#555] my-2 mx-0 leading-[1.5] flex items-center gap-[10px]">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase-2">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 9a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9z" />
                                        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                </span>
                                {{ ucfirst(Auth::user()->role) }}
                            </div>
                            <div class="text-sm text-[#555] my-2 mx-0 leading-[1.5] flex items-center gap-[10px]">
                                <span>
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                            <path
                                                d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                                        </svg>
                                    </i>
                                </span>
                                @php
                                    $workplace = Auth::user()->current_workplace;
                                    $city = explode(',', $workplace)[1];
                                    $city = str_replace('App', '', $city);
                                @endphp
                                {{ $city }}
                            </div>
                            <div class="text-sm text-[#555] my-2 mx-0 leading-[1.5] flex items-center gap-[10px]">
                                <span>
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </i>
                                </span>
                                @php
                                    $formattedDate = \Carbon\Carbon::parse(Auth::user()->created_at)->format('d F Y');
                                @endphp

                                Joined {{ $formattedDate }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="bg-secondary text-white font-sm py-2 px-3 rounded border-none transition ease-out mt-[40px]">
                <a href="{{ route('edit-profile') }}" style="color: inherit; text-decoration: none;">Edit</a>
            </button>
        </div>
    </div>

    <div class="grid grid-row-2 mt-5">
        <ul class="border-b-none">
            <li class="mr-[10px]">
                <a class="text-[14px] font-bold text-secondary border-none py-[8px] px-[15px] rounded transition ease-out @if ($activeTab === 'profile') bg-secondary text-white @endif"
                    wire:click="$set('activeTab', 'profile')">Profile</a>
            </li>
        </ul>
        <div class="mt-5">
            @if ($activeTab === 'profile')
                <livewire:components.profile />
            @elseif($activeTab === 'user-request')
                <livewire:components.user-request />
            @endif
        </div>
    </div>
</div>
