<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-md-7 d-flex align-items-center justify-content-center flex-column p-4">
            <h2 class="text-center mb-4">Verify OTP</h2>
            <div class="text-center mb-4">
                <img src="{{ asset('images/electricians-verify.png') }}" alt="Verify OTP Image" class="img-fluid">
            </div>
            <form wire:submit.prevent="verifyOtp" class="w-100" style="max-width: 400px;">
                @csrf
                <div class="form-group">
                    <label for="otp">Enter OTP</label>
                    <input type="text" id="otp" wire:model.lazy="otp" class="form-control" placeholder="00-00-00" required>
                    @error('otp') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <a href="{{ route('resend-otp') }}" class="d-block mt-2 mb-3 text-primary resend-otp">Don't receive an OTP? Resend it</a>
                <button type="submit" class="btn btn-primary w-100">Verify</button>
            </form>
        </div>
        <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center card-right">
            <div class="text-center px-4">
                <h2 class="mt-5">Verify Your Email!</h2>
                <p>We have sent you an OTP to your email. Please enter the code to verify your email address.</p>
            </div>
        </div>
    </div>
</div>
