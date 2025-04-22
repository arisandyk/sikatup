<div id="alert-component">
    @if ($alarm)
        <div
            class="relative h-fit md:h-[600px] lg:h-fit overflow-y-scroll bg-[#FCFBE8] px-6 pb-8 pt-10 shadow-xl ring-1 ring-gray-900/5 mx-auto rounded-lg">
            <!-- Logo or Title -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo" />

            <!-- Divider between sections -->
            <div
                class="mt-4 flex flex-col gap-y-4 divide-y md:space-x-4 md:grid md:grid-cols-2 space-x-0 divide-x divide-gray-300/50">
                <!-- Event Information -->
                <div class="rounded-xl flex flex-col justify-between items-start">
                    <div class="space-y-6 text-base leading-7 text-gray-600">
                        <h2 class="text-xl font-semibold truncate">Detil Alarm</h2>
                        <p class="truncate"><strong>Tower:</strong> {{ $alarm['tower']['name'] }}</p>
                        <p class="truncate"><strong>No:</strong> {{ $alarm['tower']['no'] }}</p>

                        <h3 class="mt-4 text-lg font-medium">Detil Penghantar</h3>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4"><strong>Nama Penghantar:</strong>
                                    {{ $alarm['tower']['penghantar']['name'] }}</p>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4"><strong>Nama APP:</strong>
                                    {{ $alarm['tower']['penghantar']['apps']['name'] }}</p>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4"><strong>Nama Unit Induk:</strong>
                                    {{ $alarm['tower']['penghantar']['apps']['unitInduk']['name'] }}</p>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4"><strong>Direktorat:</strong>
                                    {{ $alarm['tower']['penghantar']['apps']['unitInduk']['direktorat']['name'] }}</p>
                            </li>
                        </ul>
                    </div>

                    <div class="w-full mt-4">
                        <button wire:click="shutAlert"
                            class="w-full bg-[#101040] rounded-lg text-white py-[12px] px-[25px] text-[16px] relative bottom-0 mb-2 over:bg-violet-600 active:bg-black focus:outline-none focus:ring focus:ring-gray-300 transition-all">Shut
                            Alarm</button>
                        {{-- <span>Click and hold button for 3 seconds</span> --}}
                    </div>
                </div>

                <!-- Location Information -->
                <div class="rounded-xl hidden md:block p-4 pt-8 text-base leading-7 shadow bg-white">
                    <div class="overflow-x-auto">
                        <h3 class="text-xl font-semibold mb-4">Detil Lokasi</h3>
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                            <tbody>
                                <tr class="border-t">
                                    <td class="py-2 px-4 font-medium text-gray-600">Alamat Tower</td>
                                    <td class="py-2 px-4">{{ $alarm['tower']['alamat'] }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="py-2 px-4 font-medium text-gray-600">Latitude</td>
                                    <td class="py-2 px-4">{{ $alarm['tower']['latitude'] }}</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="py-2 px-4 font-medium text-gray-600">Longitude</td>
                                    <td class="py-2 px-4">{{ $alarm['tower']['longitude'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('script')
        <script>
            document.addEventListener("livewire:init", () => {
                var handleUI, alertSound, channelString = "{{ $channelString }}";
                console.log(channelString)

                const alertElement = document.querySelector('body div#tower-alert')

                var channel = pusher.subscribe(`${channelString}`)
                channel.bind('tower-alert-processed', function(data) {
                    console.log(data);

                    Livewire.dispatch('new-tower-alarm', {
                        data: data?.towerAlert?.id
                    })
                    handleUI = alertUI(alertElement)
                    handleUI.show();

                    alertSound = sound();
                    alertSound.play();

                    notify(`Anomali terekam di tower ${data?.towerAlert.tower.name} no ${data?.towerAlert.tower.no}`,
                        `{{ url('/') }}`)
                })

                Livewire.on('tower-alarm-deleted', () => {
                    if (alertSound) {
                        alertSound.stop();
                        alertSound = null; // Reset alertSound
                    }
                    if (handleUI) {
                        handleUI.hide();
                        handleUI = null; // Reset handleUI
                    }
                });

                // Debug Pusher connection
                pusher.connection.bind('connected', function() {
                    console.log('Pusher connected successfully');
                });

                pusher.connection.bind('error', function(err) {
                    console.error('Pusher error:', err);
                });
            })
        </script>
    @endpush
</div>
