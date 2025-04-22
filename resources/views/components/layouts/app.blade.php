<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>{{ $title ?? 'Page Title' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/img/sld/SLD.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
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
            'simulator',
            'edit-profile',
            'simulator',
            'log',
            'master-penghantar',
            'tower',
            'tower-alert',
        ];
    @endphp

    @if (in_array(Route::currentRouteName(), $routesWithSidebarAndHeader))
        @include('components.layouts.partials.sidebar')
        @include('components.layouts.partials.header', ['title' => $title ?? 'Default Title'])
    @endif

    @auth
        @if (request()->route()->getName() !== 'edit-profile')
            <div id="alert"
                class="w-full h-screen bg-black/50 fixed top-0 left-0 z-[1000] hidden justify-center items-center p-4">
                <div class="max-w-none md:max-w-screen-xl">
                    <livewire:components.alarm-notifier />
                </div>
            </div>

            <div id="tower-alert"
                class="w-full h-screen bg-black/50 fixed top-0 left-0 z-[1000] hidden justify-center items-center p-4">
                <div class="max-w-none md:max-w-screen-xl">
                    <livewire:components.tower-alert-notifier />
                </div>
            </div>
        @endif
    @endauth


    <div class="{{ in_array(Route::currentRouteName(), $routesWithSidebarAndHeader) ? 'main-content' : '' }}">
        {{ $slot }}
    </div>


    @include('components.layouts.partials.js')
    @livewireScripts

    <script>
        // Function to block page reload and navigation
        function blockPageActions() {
            // Prevent page reload or close
            window.onbeforeunload = function() {
                return "An alert is active. Are you sure you want to leave?";
            };

            // Disable all navigation links
            document.querySelectorAll('a').forEach(link => {
                link.dataset.href = link.href; // Store the original href
                link.href = "javascript:void(0);"; // Disable the link
                link.classList.add('disabled'); // Optional: Add a disabled class for styling
            });
        }

        // Function to allow page reload and navigation
        function allowPageActions() {
            // Allow page reload or close
            window.onbeforeunload = null;

            // Re-enable all navigation links
            document.querySelectorAll('a').forEach(link => {
                if (link.dataset.href) {
                    link.href = link.dataset.href; // Restore the original href
                    link.classList.remove('disabled'); // Remove the disabled class
                }
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
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

        const sound = (voice = "The-purge-siren.mp3") => {
            const howlSound = new Howl({
                src: [`${window.location.origin}/assets/audio/${voice}`],
                loop: true
            });
            return {
                play: () => howlSound.play(),
                stop: () => howlSound.stop()
            };
        };

        const alertUI = (alertElement) => ({
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
        });

        var pusher = new Pusher('ab5937f7e0fb0066866e', {
            cluster: 'ap1',
            channelAuthorization: {
                endpoint: "/broadcasting/auth",
            },
        });
    </script>
    @stack('script')
</body>

</html>
