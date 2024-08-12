<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

@if (Route::is('sign-in'))
    <link href="{{ asset('assets/css/sign-in.css') }}" rel="stylesheet">
@elseif(Route::is('sign-up'))
    <link href="{{ asset('assets/css/sign-up.css') }}" rel="stylesheet">
@elseif(Route::is('request-reset-password'))
    <link href="{{ asset('assets/css/request-reset-password.css') }}" rel="stylesheet">
@elseif(Route::is('verify-email'))
    <link href="{{ asset('assets/css/verify-email.css') }}" rel="stylesheet">
@elseif(Route::is('reset-password'))
    <link href="{{ asset('assets/css/reset-password.css') }}" rel="stylesheet">
@elseif(Route::is('dashboard') ||
        Route::is('users') ||
        Route::is('alarm') ||
        Route::is('control') ||
        Route::is('location') ||
        Route::is('profile'))
    <link href="{{ asset('assets/css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/header.css') }}" rel="stylesheet">
    @if (Route::is('dashboard'))
        <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
    @elseif(Route::is('users'))
        <link href="{{ asset('assets/css/users.css') }}" rel="stylesheet">
    @elseif(Route::is('alarm'))
        <link href="{{ asset('assets/css/alarm.css') }}" rel="stylesheet">
    @elseif(Route::is('control'))
        <link href="{{ asset('assets/css/control.css') }}" rel="stylesheet">
    @elseif(Route::is('location'))
        <link href="{{ asset('assets/css/location.css') }}" rel="stylesheet">
    @elseif(Route::is('profile'))
        <link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet">
    @endif
@endif
