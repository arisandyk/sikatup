<div class="p-0 overflow-hidden bg-white m-0">
    <div class="flex flex-col md:flex-row min-h-screen">
        <div class="hidden md:flex md:w-5/12 lg:w-1/2 md:items-center md:justify-center bg-gradient-to-l from-[#F7E43E] to-[#FFFDC3] text-center rounded-tr-[240px] rounded-br-[180px] h-auto shadow-lg p-10">
            <div class="text-center px-4">
                <h2 class="mt-5 text-secondary text-4xl font-bold mb-4">Have an Account?</h2>
                <p class="text-secondary text-2xl mb-8">Login with your personal details to use all this PLN-PMT Trans JBT features</p>
                <a href="{{ route('login') }}" class="p-4 bg-secondary rounded-lg text-white">Sign In</a>
            </div>
        </div>
        <div class="text-center flex items-center justify-center flex-col p-4 lg:w-1/2">
            <h2 class="text-3xl text-secondary font-bold mb-4">Sign Up</h2>
            <div class="mb-4">
                <img src="{{ asset('images/electricians.png') }}" alt="Sign Up Image" class="max-w-full h-auto">
            </div>
            <form wire:submit.prevent="register" class="w-full space-y-4" style="max-width: 400px;">
                @csrf
                <div class="flex flex-col gap-2 text-left">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="name" wire:model.lazy="name" class="p-4 border-b border-secondary w-full" placeholder="Your full name" required>
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col gap-2 text-left">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" wire:model.lazy="email" class="p-4 border-b border-secondary w-full" placeholder="admin@example.com" required>
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col gap-2 text-left">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" id="mobile_number" wire:model.lazy="mobile_number" class="p-4 border-b border-secondary w-full" placeholder="+62" required>
                    @error('mobile_number') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col gap-2 text-left">
                    <label for="access_key">Access Key</label>
                    <input type="password" id="password" wire:model.lazy="password" class="p-4 border-b border-secondary w-full" placeholder="********" required>
                    @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="p-4 w-full rounded-lg bg-secondary text-white">Sign Up</button>
            </form>
        </div>
    </div>
</div>
