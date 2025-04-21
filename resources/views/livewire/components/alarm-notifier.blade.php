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
                        <h2 class="text-xl font-semibold truncate">Event Detail</h2>
                        <p class="truncate"><strong>Event ID:</strong> {{ $alarm['event_id'] }}</p>
                        <p class="truncate"><strong>Event Type:</strong> {{ $alarm['event_type'] }}</p>

                        <h3 class="mt-4 text-lg font-medium">Bays Detail</h3>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4"><strong>Bays Name:</strong> {{ $alarm['event']['bays']['name'] }}</p>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4"><strong>Trafo Name:</strong>
                                    {{ $alarm['event']['bays']['trafos']['name_plate'] }}</p>
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
                                            {{ $alarm['locations']['gardu_induks']['basecamps']['apps']['unitInduk']['name'] }}
                                        </td>
                                    </tr>
                                    <tr class="border-t">
                                        <td class="py-2 px-4 font-medium text-gray-600">Direktorat</td>
                                        <td class="py-2 px-4">
                                            {{ $alarm['locations']['gardu_induks']['basecamps']['apps']['unitInduk']['direktorat']['name'] }}
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

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            document.addEventListener("livewire:init", () => {
                var alertSound, appId = "{{ $appId }}";

                const alertElement = document.querySelector('body div#alert')

                const sound = (voice) => {
                    const howlSound = new Howl({
                        src: [`${window.location.origin}/assets/audio/${voice}`],
                        loop: true
                    });
                    return {
                        play: () => howlSound.play(),
                        stop: () => howlSound.stop()
                    };
                };

                const alertUI = {
                    show: () => {
                        document.body.style.overflow = 'hidden';
                        alertElement.classList.add('flex');
                        alertElement.classList.remove('hidden');
                        blockPageActions();
                    },
                    hide: () => {
                        document.body.style.overflow = 'auto';
                        alertElement.classList.add('hidden');
                        alertElement.classList.remove('flex');
                        allowPageActions();
                    }
                };

                function notify(message, targetURL) {
                    if (!Notification) {
                        alert('Browser kamu belum mendukung web notifikasi.');
                        return;
                    }

                    if (Notification.permission !== "granted") {
                        Notification.requestPermission();
                    } else {
                        var notifikasi = new Notification("{{ url('/') }}", {
                            body: message,
                        });

                        notifikasi.onclick = function() {
                            window.open(targetURL);
                        };
                        setTimeout(function() {
                            notifikasi.close();
                        }, 10000);
                    }
                }

                var pusher = new Pusher('ab5937f7e0fb0066866e', {
                    cluster: 'ap1',
                    channelAuthorization: {
                        endpoint: "/broadcasting/auth",
                    },
                });

                var channel = pusher.subscribe(`private-alert.${appId}`)
                channel.bind('alert-processed', function(data) {
                    console.log(data);
                    
                    Livewire.dispatch('new-alarm', {
                        data: data?.alarm?.id
                    })
                    alertUI.show();
                    alertSound = sound();
                    alertSound.play();

                    notify(`New event detected from bays ${data.bayName}`, "{{ url('/alarm') }}")
                })

                Livewire.on('alarm-deleted', () => {
                    alertSound.stop();
                    alertUI.hide();
                });
            })
        </script>
    @endpush
</div>
