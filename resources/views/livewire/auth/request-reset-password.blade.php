<div class="p-0 overflow-hidden bg-white m-0 min-h-screen flex items-center justify-center flex-col">
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
            <button class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close">
                <svg class="fill-current h-6 w-6 text-green-700" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415l-2.933 3.434a1 1 0 01-1.415-1.415L8.585 10l-3.434-2.933a1 1 0 011.415-1.415L10 8.585l2.933-3.434a1 1 0 011.415 1.415L11.415 10l3.434 2.933a1 1 0 010 1.415z" />
                </svg>
            </button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            {{ session('error') }}
            <button class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close">
                <svg class="fill-current h-6 w-6 text-red-700" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415l-2.933 3.434a1 1 0 01-1.415-1.415L8.585 10l-3.434-2.933a1 1 0 011.415-1.415L10 8.585l2.933-3.434a1 1 0 011.415 1.415L11.415 10l3.434 2.933a1 1 0 010 1.415z" />
                </svg>
            </button>
        </div>
    @endif

    <div class="flex">
        <div class="text-center flex items-center justify-center flex-col p-4">
            <h2 class="text-3xl font-semibold">Reset Access Key</h2>
        </div>
    </div>
    <div class="flex flex-col md:flex-row w-3/4">
        <!-- Left Section (Buttons and Form) -->
        <div class="w-full md:w-1/2 flex items-start justify-center flex-col">
            <div class="flex gap-4 mb-4">
                <button id="emailToggle" class="py-2 px-4 text-secondary rounded-lg {{ $is_email ? 'bg-[#fff500]' : 'bg-[#e0e0e0]' }}"
                    wire:click="toggleMethod('email')">Email</button>
                <button id="mobileToggle" class="py-2 px-4 text-secondary rounded-lg {{ !$is_email ? 'bg-[#fff500]' : 'bg-[#e0e0e0]' }}"
                    wire:click="toggleMethod('mobile')">Mobile Number</button>
            </div>
            <form wire:submit.prevent="requestReset" class="w-full space-y-5" style="max-width: 400px;">
                @csrf
                <div class="flex flex-col gap-2">
                    <label id="inputLabel"
                        for="contact_input">{{ $is_email ? 'Email Address' : 'Mobile Phone' }}</label>
                    <input type="text" id="contact_input" wire:model.lazy="contact_input" class="p-4 border-b border-secondary w-full"
                        placeholder="{{ $is_email ? 'admin@mail.com' : '+62 8765432123' }}" required>
                    @error('contact_input')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="p-4 w-full rounded-lg bg-[#F7E43E] text-secondary">Send OTP</button>
                </div>
            </form>
        </div>
        <!-- Right Section (Image) -->
        <div class="w-3/4 hidden md:flex items-center justify-center">
            <div class="fixed -top-[200px] -right-[200px] w-[460px] h-[400px] bg-gradient-to-l from-[#F7E43E] to-[#FFFDC3] rounded-full shadow-lg z-[1000]"></div>
            <img src="{{ asset('images/electricians-2.png') }}" alt="Reset Image" class="img-fluid">
        </div>
    </div>
</div>
