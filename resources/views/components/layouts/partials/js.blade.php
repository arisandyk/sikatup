<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@if (Route::is('sign-in'))
    {{-- <script src="{{ asset('assets/js/sign-in.js') }}"></script> --}}
@elseif (Route::is('sign-up'))
    <script src="{{ asset('assets/js/sign-up.js') }}"></script>
@elseif (Route::is('request-reset-password'))
    <script src="{{ asset('assets/js/request-reset-password.js') }}"></script>
@elseif (Route::is('reset-password'))
    <script src="{{ asset('assets/js/reset-password.js') }}"></script>
@elseif (Route::is('dashboard') ||
        Route::is('users') ||
        Route::is('alarm') ||
        Route::is('control') ||
        Route::is('location') ||
        Route::is('profile'))
    <script src="{{ asset('assets/js/header.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
    @if (Route::is('dashboard'))
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @elseif(Route::is('users'))
        <script src="{{ asset('assets/js/users.js') }}"></script>
    @elseif(Route::is('alarm'))
        <script src="{{ asset('assets/js/alarm.js') }}"></script>
    @elseif(Route::is('control'))
        <script src="{{ asset('assets/js/control.js') }}"></script>
    @elseif(Route::is('location'))
        <script src="{{ asset('assets/js/location.js') }}"></script>
    @elseif(Route::is('profile'))
        <script src="{{ asset('assets/js/profile.js') }}"></script>
    @endif
@endif
