<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    {{-- Segment Buttons --}}
    <ul class="flex gap-4 my-5">
        <li class="cursor-pointer" wire:click="$set('activeTab', 'account')">
            <a
                class="text-[14px] font-bold border-none p-4 rounded transition ease-out @if ($activeTab === 'account') bg-secondary text-white @else bg-white text-secondary @endif">Account</a>
        </li>
        <li class="cursor-pointer" wire:click="$set('activeTab', 'security')">
            <a
                class="text-[14px] font-bold border-none p-4 rounded transition ease-out @if ($activeTab === 'security') bg-secondary text-white @else bg-white text-secondary @endif">Security</a>
        </li>
    </ul>

    {{-- Account Segment --}}
    @if ($activeTab === 'account')
        <div class="w-full mb-5 border-none shadow-lg bg-white p-4 rounded-lg">
            <div class="py-5 text-2xl border-b">
                <h2>Edit Profile</h2>
            </div>
            <div class="py-5">
                <form wire:submit.prevent="saveProfile">
                    <div class="flex flex-col gap-4 lg:grid lg:grid-cols-3">
                        <div class="text-center">
                            <div class="mx-auto mb-3">
                                <img src="{{ 'storage/' . Auth::user()->image }}" alt="User Image"
                                    class="w-full h-full object-cover rounded-lg shadow-lg">
                                <input type="file" id="profilePicture" class="hidden" wire:model="profilePicture">
                            </div>
                            <button type="button"
                                class="bg-secondary p-4 rounded-lg text-white my-3 mx-auto whitespace-nowrap"
                                onclick="document.getElementById('profilePicture').click()">Upload new photo</button>
                            <small class="block mt-2">Allowed JPG, GIF, or PNG. Max size of 800K</small>
                        </div>
                        <div class="flex flex-col gap-4 my-5">
                            <div class="mb-3 flex flex-col gap-y-2">
                                <label for="fullName">Full Name</label>
                                <input type="text" id="fullName" class="border p-4 rounded-lg" wire:model="name">
                            </div>
                            <div class="mb-3 flex flex-col gap-y-2">
                                <label for="nip">NIP</label>
                                <input type="text" id="nip" class="border p-4 rounded-lg" wire:model="nip">
                            </div>
                            <div class="mb-3 flex flex-col gap-y-2">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" class="border p-4 rounded-lg" wire:model="email">
                            </div>
                            <div class="mb-3 flex flex-col gap-y-2">
                                <label for="mobileNumber">Mobile Number</label>
                                <input type="text" id="mobileNumber" class="border p-4 rounded-lg"
                                    wire:model="mobileNumber">
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 my-5">
                            <div class="flex flex-col gap-4">
                                <div class="mb-3 flex flex-col gap-y-2">
                                    <label for="unitInduk">Unit Induk</label>
                                    <select id="unitInduk" class="border p-4 rounded-lg" wire:model="unitInduk"
                                        wire:change="$refresh">
                                        <option value="">{{ $unitIndukName }}</option>
                                        @foreach ($unitInduks as $ui)
                                            <option value="{{ $ui->id }}"
                                                {{ $ui->id == $this->unitInduk ? 'selected' : '' }}>
                                                {{ $ui->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 flex flex-col gap-y-2">
                                    <label for="app">App</label>
                                    <select id="app" class="border p-4 rounded-lg" wire:model="app"
                                        wire:change="$refresh">
                                        <option value="">{{ $appName }}</option>
                                        @foreach ($apps as $a)
                                            <option value="{{ $a->id }}"
                                                {{ $a->id == $this->app ? 'selected' : '' }}>
                                                {{ $a->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col gap-4">
                                <div class="mb-3 flex flex-col gap-y-2">
                                    <label for="basecamp">Basecamp</label>
                                    <select id="basecamp" class="border p-4 rounded-lg" wire:model="basecamp"
                                        wire:change="$refresh">
                                        <option value="">{{ $basecampName }}</option>
                                        @foreach ($basecamps as $bc)
                                            <option value="{{ $bc->id }}"
                                                {{ $bc->id == $this->basecamp ? 'selected' : '' }}>
                                                {{ $bc->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 flex flex-col gap-y-2">
                                    <label for="garduInduk">Gardu Induk</label>
                                    <select id="garduInduk" class="border p-4 rounded-lg" wire:model="garduInduk"
                                        wire:change="$refresh">
                                        <option value="">{{ $garduIndukName }}</option>
                                        @foreach ($garduInduks as $gi)
                                            <option value="{{ $gi->id }}"
                                                {{ $gi->id == $this->garduInduk ? 'selected' : '' }}>
                                                {{ $gi->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-rows-2 lg:grid-rows-none lg:grid-cols-2 gap-2 mt-4">
                        <button type="submit" class="p-4 bg-secondary text-white rounded-lg">Save changes</button>
                        <button type="button" class="p-4 bg-red-500 text-white rounded-lg"
                            wire:click="cancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="w-full mb-5 border-none shadow-lg bg-white p-4 rounded-lg">
            <div class="space-y-4">
                <h4 class="text-red-500 font-medium text-2xl">Delete Account</h4>
                <p class="text-gray-600">Are you sure you want to delete your account? Once you delete your account,
                    there
                    is no going back. Please be certain.</p>
                <div class="form-check">
                    <input type="checkbox" class="w-[15px] h-[15px] border-gray-400" id="confirmDelete" wire:model="confirmDelete">
                    <label class="cursor-pointer" for="confirmDelete">I confirm my account deactivation</label>
                </div>
                <button class="p-4 bg-red-500 rounded-lg text-white w-full cursor-pointer" wire:click="deleteAccount"
                    {{ !$confirmDelete ? 'disabled' : '' }}>Deactivate Account</button>
            </div>
        </div>
    @endif

    {{-- Security Segment --}}
    @if ($activeTab === 'security')
        <div class="w-full mb-5 border-none shadow-lg bg-white p-4 rounded-lg">
            <div class="py-5 text-2xl border-b">
                <h2>Security Settings</h2>
            </div>
            <div class="py-5">
                <form wire:submit.prevent="changePassword" class="space-y-3">
                    <div class="flex flex-col gap-y-2">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" class="border p-4 rounded-lg"
                            wire:model="currentPassword">
                    </div>
                    <div class="flex flex-col gap-y-2">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" class="border p-4 rounded-lg"
                            wire:model="newPassword">
                    </div>
                    <div class="flex flex-col gap-y-2">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" id="confirmPassword" class="border p-4 rounded-lg"
                            wire:model="confirmPassword">
                    </div>
                    <button type="submit" class="p-4 bg-red-500 rounded-lg text-white w-full">Save changes</button>
                </form>
            </div>
        </div>

        <div class="w-full mb-5 border-none shadow-lg bg-white p-4 rounded-lg mt-4">
            <div class="space-y-4">
                <h4 class="font-medium text-2xl">Two-steps verification</h4>
                <p class="text-gray-600">Two-factor authentication is not enabled yet.</p>
                <button class="p-4 bg-secondary rounded-lg text-white w-full" wire:click="enableTwoFactor">Enable Two-Factor
                    Authentication</button>
            </div>
        </div>
    @endif
</div>
