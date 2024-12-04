<div
    class="w-full lg:w-auto fixed top-0 left-0 lg:left-[280px] lg:right-0 p-4 lg:p-0 lg:pt-5 lg:pr-5 lg:pl-5 flex flex-col md:flex-row gap-2 justify-normal md:justify-between items-start md:items-center z-40 bg-primary backdrop-blur-md bg-opacity-95 border-none lg:border-b">
    <div class="absolute inset-x-0 top-0 bottom-1/2 bg-inherit z-[-1] pointer-events-none"></div>
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="flex justify-between md:justify-normal md:gap-x-4 items-center w-full">
        <button class="p-1 bg-secondary rounded-lg block lg:hidden" id="btn-toggle-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-8 stroke-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
        <h2 class="text-[36px] m-0 text-secondary font-medium">{{ $title }}</h2>
    </div>
    <div class="w-full flex items-center bg-white rounded-lg py-3 px-4 shadow-lg space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
        @livewire('components.header-search')
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>

@push('script')
    <script>
        function monitorAlert() {
            const alertElement = document.querySelector('body div#alert')
            let interval;
            let previousAlert = JSON.parse(localStorage.getItem('alert')) || null;
            let alertData;
            let alertSound;

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
                    clearInterval(interval);
                    document.body.style.overflow = 'hidden';
                    alertElement.classList.add('flex');
                    alertElement.classList.remove('hidden');
                },
                hide: () => {
                    document.body.style.overflow = 'auto';
                    alertElement.classList.add('hidden');
                    alertElement.classList.remove('flex');
                }
            };            

            async function checkAlert() {
                try {
                    const response = await fetch("{{ url('send') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                    if (!response.ok) throw new Error('Failed to fetch alert');
                    
                    const data = await response.json();
                    if(data.success) {
                        alertData = data.alarm
                        handleAlert()
                    }
                } catch (error) {
                    console.error('Error:', error);
                    clearInterval(interval);
                }
            }

            async function shutAlert() {
                try {
                    const response = await fetch(`{{ url('/alarm/${alertData.id}') }}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                    if (!response.ok) {
                        throw new Error('Failed to fetch alert')
                    } else {
                        notify("Alarm shut successfully", "{{ url('/alarm') }}")
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }

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

            function handleAlert() {
                if (alertData.id !== previousAlert?.id || alertData.deleted_at == null && previousAlert?.deleted_at == null) {
                    previousAlert = alertData;
                    localStorage.setItem('alert', JSON.stringify({
                        alarm: alertData
                    }));

                    alertSound = sound(alertData.voice);
                    alertUI.show();
                    alertSound.play();

                    notify(`New event detected from bays ${alertData.event.bays.name}`, "{{ url('/alarm') }}")

                    Livewire.dispatch('new-alarm', {
                        data: alertData
                    });

                } else {
                    console.log('No new alert');
                }
            }

            document.body.addEventListener('click', function(e) {
                if (e.target && e.target.id === 'shut-button') {
                    e.preventDefault();

                    shutAlert()
                    alertUI.hide();
                    alertSound.stop();
                    interval = setInterval(checkAlert, 5000);
                }
            });

            interval = setInterval(checkAlert, 5000);
        }

        monitorAlert();
    </script>
@endpush
