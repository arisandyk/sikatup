<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
</head>

<body>
    <div class="container-fluid {{ $status }}">
        <div class="row min-vh-100">
            <div class="col-md-14 d-flex align-items-center justify-content-center flex-column p-4">
                @if($status === 'success')
                <div class="icon">&#10003;</div> <!-- Checkmark Icon -->
                <div class="title">Email Verified</div>
                <div class="message">Your email address was successfully verified.</div>
                <a href="{{ route('sign-in') }}" class="button">Back to Sign-In</a>
                @elseif($status === 'error')
                <div class="icon">&#10005;</div> <!-- Cross Icon -->
                <div class="title">Email Verification Failed</div>
                <div class="message">We're sorry, something has gone wrong. Please try again.</div>
                <a href="{{ route('sign-up') }}" class="button">Done</a>
                @endif
            </div>
        </div>
    </div>
</body>

</html>