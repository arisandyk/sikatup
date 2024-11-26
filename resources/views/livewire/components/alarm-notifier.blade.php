<div id="alert-component">
    @if ($alarm)
        <div
            class="relative bg-[#FCFBE8] px-6 pb-8 pt-10 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:rounded-lg sm:px-10">
            <!-- Logo or Title -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo" />

            <!-- Divider between sections -->
            <div class="mt-4 grid space-x-4 divide-x divide-gray-300/50 lg:grid-cols-2 sm:grid-cols-1">
                <!-- Event Information -->
                <div class="rounded-xl p-4 flex flex-col justify-between items-start h-full">
                    <div class="space-y-6 text-base leading-7 text-gray-600">
                        <h2 class="text-xl font-semibold">Event Detail</h2>
                        <p><strong>Event ID:</strong> {{ $alarm['event_id'] }}</p>
                        <p><strong>Event Type:</strong> {{ $alarm['event_type'] }}</p>
    
                        <h3 class="mt-4 text-lg font-medium">Bays Detail</h3>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4"><strong>Bays Name:</strong> {{ $alarm['event']['bays']['name'] }}</p>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4"><strong>Trafo Name:</strong>
                                    {{ $alarm['event']['bays']['trafos']['name_plate'] }}</p>
                            </li>
                        </ul>
                    </div>

                    <div class="w-full">
                        <button id="shut-button" class="w-full bg-[#101040] rounded-lg text-white py-[12px] px-[25px] text-[16px] relative bottom-0 mb-2 over:bg-violet-600 active:bg-black focus:outline-none focus:ring focus:ring-gray-300 transition-all">Shut Alarm</button>
                        {{-- <span>Click and hold button for 3 seconds</span> --}}
                    </div>
                </div>

                <!-- Location Information -->
                <div
                    class="rounded-xl p-4 pt-8 text-base leading-7 shadow bg-white">
                    <div class="overflow-x-auto">
                        <h3 class="text-xl font-semibold mb-4">Location Detail</h3>
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                            <tbody>
                                <tr class="border-t">
                                    <td class="py-2 px-4 font-medium text-gray-600">Location Address</td>
                                    <td class="py-2 px-4">{{ $alarm['locations']['address'] }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="py-2 px-4 font-medium text-gray-600">Latitude</td>
                                    <td class="py-2 px-4">{{ $alarm['locations']['latitude'] }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="py-2 px-4 font-medium text-gray-600">Longitude</td>
                                    <td class="py-2 px-4">{{ $alarm['locations']['longitude'] }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="mt-6">
                            <h4 class="text-lg font-semibold mb-4">Gardu Induk</h4>
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                                <tbody>
                                    <tr class="border-t">
                                        <td class="py-2 px-4 font-medium text-gray-600">Name</td>
                                        <td class="py-2 px-4">{{ $alarm['locations']['gardu_induks']['name'] }}</td>
                                    </tr>
                                    <tr class="border-t">
                                        <td class="py-2 px-4 font-medium text-gray-600">Basecamp</td>
                                        <td class="py-2 px-4">
                                            {{ $alarm['locations']['gardu_induks']['basecamps']['name'] }}</td>
                                    </tr>
                                    <tr class="border-t">
                                        <td class="py-2 px-4 font-medium text-gray-600">App</td>
                                        <td class="py-2 px-4">
                                            {{ $alarm['locations']['gardu_induks']['basecamps']['apps']['name'] }}</td>
                                    </tr>
                                    <tr class="border-t">
                                        <td class="py-2 px-4 font-medium text-gray-600">Unit Induk</td>
                                        <td class="py-2 px-4">
                                            {{ $alarm['locations']['gardu_induks']['basecamps']['apps']['unit_induk']['name'] }}
                                        </td>
                                    </tr>
                                    <tr class="border-t">
                                        <td class="py-2 px-4 font-medium text-gray-600">Direktorat</td>
                                        <td class="py-2 px-4">
                                            {{ $alarm['locations']['gardu_induks']['basecamps']['apps']['unit_induk']['direktorat']['name'] }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
