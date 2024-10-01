<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-md-7 d-flex align-items-center justify-content-center flex-column p-4">
            <h2 class="text-center mb-4">Sign In</h2>
            <div class="text-center mb-4">
                <img src="{{ asset('images/electricians.png') }}" alt="Sign In Image" class="img-fluid">
            </div>

            <!-- Flash Messages -->
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- End Flash Messages -->

            <form wire:submit.prevent="signIn" class="w-100" style="max-width: 400px;">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" wire:model.lazy="email" class="form-control" placeholder="email@example.com" required>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="password">Access Key</label>
                    <input type="password" id="password" wire:model.lazy="password" class="form-control" placeholder="********" required>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <a href="{{ route('request-reset-password') }}" class="d-block mt-2 mb-3 text-primary forgot-access-key">Forget Access Key?</a>
                <button type="submit" class="btn btn-primary w-100">Sign In</button>
            </form>
        </div>
        <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center card-right">
            <div class="text-center px-4">
                <h2 class="mt-5">Hello, Friends!</h2>
                <p>Register with your personal details to use all this PLN-PMT Trans JBT features</p>
                <a href="{{ route('sign-up') }}" class="btn btn-secondary">Sign Up</a>
            </div>
        </div>
    </div>
</div>