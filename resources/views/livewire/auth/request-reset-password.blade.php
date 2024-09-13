<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <h2>Reset Access Key</h2>
        </div>
    </div>
    <div class="row w-75">
        <!-- Left Section (Buttons and Form) -->
        <div class="col-md-6 d-flex align-items-center justify-content-center flex-column">
            <div class="form-group toggle-button-group">
                <button id="emailToggle" class="toggle-button {{ $is_email ? 'active' : '' }}" wire:click="toggleMethod('email')">Email</button>
                <button id="mobileToggle" class="toggle-button {{ !$is_email ? 'active' : '' }}" wire:click="toggleMethod('mobile')">Mobile Number</button>
            </div>
            <form wire:submit.prevent="requestReset" class="w-100" style="max-width: 400px;">
                @csrf
                <div class="form-group">
                    <label id="inputLabel" for="contact_input">{{ $is_email ? 'Email Address' : 'Mobile Phone' }}</label>
                    <input type="text" id="contact_input" wire:model.lazy="contact_input" class="form-control"
                        placeholder="{{ $is_email ? 'admin@mail.com' : '+62 8765432123' }}" required>
                    @error('contact_input')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="btn btn-primary w-100 mt-4">Send OTP</button>
                </div>
            </form>
        </div>
        <!-- Right Section (Image) -->
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center card-right">
            <div class="circular-card"></div>
            <img src="{{ asset('images/electricians-2.png') }}" alt="Reset Image" class="img-fluid">
        </div>
    </div>
</div>
