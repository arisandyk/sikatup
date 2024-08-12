<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center card-left">
            <div class="text-center px-4">
                <h2 class="mt-5">Have an Account?</h2>
                <p>Login with your personal details to use all this PLN-PMT Trans JBT features</p>
                <a href="{{ route('sign-in') }}" class="btn btn-primary">Sign In</a>
            </div>
        </div>
        <div class="col-md-7 d-flex align-items-center justify-content-center flex-column p-4">
            <h2 class="text-center mb-4">Sign Up</h2>
            <div class="text-center mb-4">
                <img src="{{ asset('images/electricians.png') }}" alt="Sign Up Image" class="img-fluid">
            </div>
            <form wire:submit.prevent="signUp" class="w-100" style="max-width: 400px;">
                @csrf
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" wire:model.lazy="full_name" class="form-control" placeholder="Your full name" required>
                    @error('full_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" wire:model.lazy="email" class="form-control" placeholder="admin@example.com" required>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" id="mobile_number" wire:model.lazy="mobile_number" class="form-control" placeholder="+62" required>
                    @error('mobile_number') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="access_key">Access Key</label>
                    <input type="password" id="access_key" wire:model.lazy="access_key" class="form-control" placeholder="********" required>
                    @error('access_key') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4">Sign Up</button>
            </form>
        </div>
    </div>
</div>
