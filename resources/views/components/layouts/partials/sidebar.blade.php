<div id="sidebar" class="w-full bg-secondary text-white absolute lg:w-auto lg:m-5 lg:top-0 top-36 md:top-20 z-40 p-5 shadow-lg border-0 rounded-none lg:rounded-lg ease-out duration-150">
    <div class="text-left flex">
        <div class="flex items-end gap-3 text-wrap text-2xl font-bold">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            <span>MONITORING</span>
        </div>
    </div>
    <div class="mt-10 text-left flex items-end gap-3 mb-5 text-white">
        <img src="{{ 'storage/'. Auth::user()->image }}" alt="User Image" class="w-10 h-10 rounded-xl">
        <span class="text-lg m-0 ml-3">Hello 👋 {{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
    </div>
    <ul class="list-none p-0 m-0">
        <h4 class="text-lg">Menu</h4>
        <li class="my-5 flex items-center border-b lg:border-none pb-4">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-yellow-300' : 'text-white' }} no-underline flex items-center text-base rounded-lg hover:text-yellow-500">
                <i class="flex mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                    </svg>
                </i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role == 'admin')
            <li class="my-5 flex items-center border-b lg:border-none pb-4">
                <a href="{{ route('users') }}" class="{{ request()->routeIs('users') ? 'text-yellow-300' : 'text-white' }} no-underline flex items-center text-base rounded-lg hover:text-yellow-500">
                    <i class="flex mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                    </i>
                    <span>Users</span>
                </a>
            </li>
            <li class="my-5 flex items-center border-b lg:border-none pb-4">
                <a href="{{ route('devices') }}" class="{{ request()->routeIs('devices') ? 'text-yellow-300' : 'text-white'}} no-underline flex items-center text-base rounded-lg hover:text-yellow-500">
                    <i class="flex mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-devices">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M13 9a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1v-10z" />
                        <path d="M18 8v-3a1 1 0 0 0 -1 -1h-13a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h9" />
                        <path d="M16 9h2" />
                    </svg>
                </i>
                    <span>Devices</span>
                </a>
            </li>
        @endif
        <li class="my-5 flex items-center border-b lg:border-none pb-4">
            <a href="{{ route('control') }}" class="{{ request()->routeIs('control') ? 'text-yellow-300' : 'text-white' }} no-underline flex items-center text-base rounded-lg hover:text-yellow-500">
                <i class="flex mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-table">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                        <path d="M3 10h18" />
                        <path d="M10 3v18" />
                    </svg>
                </i>
                <span>Control</span>
            </a>
        </li>
        <li class="my-5 flex items-center border-b lg:border-none pb-4">
            <a href="{{ route('location') }}" class="{{ request()->routeIs('location') ? 'text-yellow-300' : 'no-underline flex items-center text-base rounded-lg hover:text-yellow-500' }}">
                <i class="flex mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                    </svg>
                </i>
                <span>Location</span>
            </a>
        </li>
        <li class="my-5 flex items-center border-b lg:border-none pb-4">
            <a href="{{ route('alarm') }}" class="{{ request()->routeIs('alarm') ? 'text-yellow-300' : 'text-white' }} no-underline flex items-center text-base rounded-lg hover:text-yellow-500">
                <i class="flex mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-urgent">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                        <path d="M6 16m0 1a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                    </svg>
                </i>
                <span>Alert</span>
            </a>
        </li>
        <h4 class="text-lg">Settings</h4>
        <li class="my-5 flex items-center border-b lg:border-none pb-4">
            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'text-yellow-300' : 'text-white' }} no-underline flex items-center text-base rounded-lg hover:text-yellow-500">
                <i class="flex mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </i>
                <span>Profile</span>
            </a>
        </li>
        <li class="my-5 flex items-center border-b lg:border-none pb-4">
            <a href="#" id="logoutLink" class="no-underline flex items-center text-base rounded-lg hover:text-yellow-500">
                <i class="flex mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 12h14l-3 -3m0 6l3 -3" />
                    </svg>
                </i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>

@livewire('settings.logout')
