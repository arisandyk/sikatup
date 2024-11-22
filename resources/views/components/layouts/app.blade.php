<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title ?? 'Page Title' }}</title>

    @include('components.layouts.partials.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @php
        // Define the routes that require the sidebar and header
        $routesWithSidebarAndHeader = [
            'dashboard',
            'users',
            'devices',
            'control',
            'alarm',
            'location',
            'profile',
            'edit-profile',
        ];
    @endphp

    @if (in_array(Route::currentRouteName(), $routesWithSidebarAndHeader))
        @include('components.layouts.partials.sidebar')
        @include('components.layouts.partials.header', ['title' => $title ?? 'Default Title'])
    @endif

    <div id="alert"
        class="w-full h-screen bg-black/50 overflow-hidden fixed top-0 z-50 hidden justify-center items-center p-4">
        <div class="max-w-screen-xl w-full">
            <livewire:components.alarm-notifier />
        </div>
    </div>

    <div class="{{ in_array(Route::currentRouteName(), $routesWithSidebarAndHeader) ? 'main-content' : '' }}">
        {{ $slot }}
    </div>


    @include('components.layouts.partials.js')
    @livewireScripts

    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
    <script>
        function monitorAlert() {
            const alertElement = document.getElementById('alert');
            let interval;
            let previousAlert = JSON.parse(localStorage.getItem('alert')) || null;

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
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            async function shutAlert(id) {
                try {
                    const response = await fetch(`{{ url('/alarm/${id}') }}`, {
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

            window.onload = () => {
                const channel = Echo.channel('channel-reverb');
                channel.listen("AlarmTriggered", (data) => handleAlert(data.alarm));
            };

            function notify(message, targetURL, alertSound = null) {
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

                    if (alertSound) alertSound.play()

                    notifikasi.onclick = function() {
                        window.open(targetURL);
                    };
                    setTimeout(function() {
                        notifikasi.close();
                    }, 10000);
                }
            }

            function handleAlert(alertData) {
                if (alertData.id !== previousAlert.id || alertData.deleted_at == null && previousAlert.deleted_at == null) {
                    previousAlert = alertData;
                    localStorage.setItem('alert', JSON.stringify({
                        alarm: alertData
                    }));

                    const alertSound = sound(alertData.voice);
                    alertUI.show();
                    // alertSound.play();

                    notify(`New event detected from bays ${alertData.event.bays.name}`, "{{ url('/alarm') }}", alertSound)

                    Livewire.dispatch('new-alarm', {
                        data: alertData
                    });


                    let holdTimeout;

                    document.body.addEventListener('mousedown', function(e) {
                        if (e.target && e.target.id === 'shut-button') {
                            e.preventDefault();

                            holdTimeout = setTimeout(() => {
                                shutAlert(alertData.id);
                                alertUI.hide();
                                alertSound.stop();
                                interval = setInterval(checkAlert, 5000);
                            }, 3000);
                        }
                    });

                    document.body.addEventListener('mouseup', function(e) {
                        if (e.target && e.target.id === 'shut-button') {
                            clearTimeout(holdTimeout);
                        }
                    });

                    document.body.addEventListener('mouseleave', function(e) {
                        if (e.target && e.target.id === 'shut-button') {
                            clearTimeout(holdTimeout);
                        }
                    });

                    document.body.addEventListener('touchstart', function(e) {
                        if (e.target && e.target.id === 'shut-button') {
                            e.preventDefault();

                            holdTimeout = setTimeout(() => {
                                shutAlert(alertData.id);
                                alertUI.hide();
                                alertSound.stop();
                                interval = setInterval(checkAlert, 5000);
                            }, 3000);
                        }
                    });

                    document.body.addEventListener('touchend', function(e) {
                        if (e.target && e.target.id === 'shut-button') {
                            clearTimeout(holdTimeout);
                        }
                    });
                } else {
                    console.log('No new alert');
                }
            }

            interval = setInterval(checkAlert, 5000);
        }

        monitorAlert();
    </script>
</body>

</html>
