<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-md-14 d-flex align-items-center justify-content-center flex-column p-4">
            <div class="circular-card"></div>
            <h2 class="text-center mb-4">Reset Password</h2>
            <div class="text-center mb-4">
                <img src="{{ asset('images/electricians.png') }}" alt="Reset Password Image" class="img-fluid">
            </div>
            @if($message)
            <div class="alert alert-{{ $messageType }} w-100" style="max-width: 400px;">
                {{ $message }}
            </div>
            @endif
            <form wire:submit.prevent="resetPassword" class="w-100" style="max-width: 400px;">
                @csrf
                <div class="form-group mt-3">
                    <label for="otp">Enter OTP</label>
                    <input type="text" id="otp" wire:model.defer="otp" class="form-control" required>
                    @error('otp') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="new_password">Enter New Access Key</label>
                    <input type="password" id="new_password" wire:model.defer="new_password" class="form-control" required>
                    @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Reset Password</button>
            </form>
        </div>
    </div>
</div>
