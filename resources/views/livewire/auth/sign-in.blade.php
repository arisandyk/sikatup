<div class="p-0 overflow-hidden bg-white m-0">
    <div class="flex flex-col md:flex-row min-h-screen">
        <div class="text-center flex items-center justify-center flex-col p-4 lg:w-1/2">
            <h2 class="text-3xl text-secondary font-bold mb-4">Sign In</h2>
            <div class="mb-4">
                <img src="{{ asset('images/electricians.png') }}" alt="Sign In Image" class="max-w-full h-auto">
            </div>

            <!-- Flash Messages -->
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    {{ session('status') }}
                    <button class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close">
                        <svg class="fill-current h-6 w-6 text-green-700" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415l-2.933 3.434a1 1 0 01-1.415-1.415L8.585 10l-3.434-2.933a1 1 0 011.415-1.415L10 8.585l2.933-3.434a1 1 0 011.415 1.415L11.415 10l3.434 2.933a1 1 0 010 1.415z" />
                        </svg>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('error') }}
                    <button class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close">
                        <svg class="fill-current h-6 w-6 text-red-700" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415l-2.933 3.434a1 1 0 01-1.415-1.415L8.585 10l-3.434-2.933a1 1 0 011.415-1.415L10 8.585l2.933-3.434a1 1 0 011.415 1.415L11.415 10l3.434 2.933a1 1 0 010 1.415z" />
                        </svg>
                    </button>
                </div>
            @endif
            <!-- End Flash Messages -->

            <form wire:submit.prevent="signIn" class="w-full space-y-4" style="max-width: 400px;">
                @csrf
                <div class="flex flex-col gap-2 text-left">
                    <label for="email">Email</label>
                    <input type="email" id="email" wire:model.lazy="email" class="p-4 border-b border-secondary w-full"
                        placeholder="email@example.com" required>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 text-left">
                    <label for="password">Access Key</label>
                    <input type="password" id="password" wire:model.lazy="password" class="p-4 border-b border-secondary w-full"
                        placeholder="********" required>
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <a href="{{ route('request-reset-password') }}"
                    class="block mt-2 mb-3 text-secondary no-underline">Forget Access Key?</a>
                <button type="submit" class="p-4 w-full rounded-lg bg-secondary text-white">Sign In</button>
            </form>
        </div>
        <div class="hidden md:flex md:w-5/12 lg:w-1/2 md:items-center md:justify-center bg-gradient-to-l from-[#F7E43E] to-[#FFFDC3] text-center rounded-tl-[240px] rounded-bl-[180px] h-auto shadow-lg p-10">
            <div class="text-center px-4">
                <h2 class="mt-5 text-secondary text-4xl font-bold mb-4">Hello, Friends!</h2>
                <p class="text-secondary text-2xl mb-8">Register with your personal details to use all this PLN-PMT Trans JBT features</p>
                <a href="{{ route('sign-up') }}" class="p-4 bg-secondary rounded-lg text-white">Sign Up</a>
            </div>
        </div>
    </div>
</div>
