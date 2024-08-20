<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-md-14 d-flex align-items-center justify-content-center flex-column p-4">
            <div class="circular-card"></div>
            <h2 class="text-center mb-4">Reset Password</h2>
            <div class="text-center mb-4">
                <img src="{{ asset('images/electricians.png') }}" alt="Reset Password Image" class="img-fluid">
            </div>
            <form wire:submit.prevent="resetPassword" class="w-100" style="max-width: 400px;">
                @csrf
                <div class="form-group">
                    <label for="otp">Enter OTP</label>
                    <input type="text" id="otp" wire:model.lazy="otp" class="form-control"
                        placeholder="00-00-00" required>
                    @error('otp')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="new_password">Enter New Access Key</label>
                    <input type="password" id="new_password" wire:model.lazy="new_password" class="form-control"
                        placeholder="********" required>
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <a href="{{ route('resend-otp') }}" class="d-block mt-2 mb-3 text-primary resend-otp">Don’t receive an
                    OTP? Resend it</a>
                <button type="submit" class="btn btn-primary w-100">Verify</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('passwordResetSuccess', function() {
            alert('Password reset successfully. You will be redirected to the sign-in page.');
            window.location.href = "{{ route('sign-in') }}";
        });

        Livewire.on('passwordResetFailed', function() {
            alert('Password reset failed. Please try again.');
        });
    </script>
@endpush
