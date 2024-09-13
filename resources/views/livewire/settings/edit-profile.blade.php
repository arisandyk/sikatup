<div class="profile-edit-container">
    {{-- Segment Buttons --}}
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link @if ($activeTab === 'account') active @endif"
               wire:click="$set('activeTab', 'account')">Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($activeTab === 'security') active @endif"
               wire:click="$set('activeTab', 'security')">Security</a>
        </li>
    </ul>

    {{-- Account Segment --}}
    @if ($activeTab === 'account')
        <div class="card">
            <div class="card-header">
                <h2>Edit Profile</h2>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="saveProfile">
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <div class="profile-image-container mb-3">
                                <img src="{{ asset('images/user.png') }}" alt="User Image" class="profile-img">
                                <input type="file" id="profilePicture" class="upload-input d-none" wire:model="profilePicture">
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm upload" onclick="document.getElementById('profilePicture').click()">Upload new photo</button>
                            <small class="d-block mt-2">Allowed JPG, GIF, or PNG. Max size of 800K</small>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" id="fullName" class="form-control" wire:model="name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nip">NIP</label>
                                    <input type="text" id="nip" class="form-control" wire:model="nip">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email">E-mail</label>
                                    <input type="email" id="email" class="form-control" wire:model="email">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="mobileNumber">Mobile Number</label>
                                    <input type="text" id="mobileNumber" class="form-control" wire:model="mobileNumber">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="unitInduk">Unit Induk</label>
                                    <select id="unitInduk" class="form-control" wire:model="unitInduk" wire:change="$refresh">
                                        <option value="">{{ $unitIndukName }}</option>
                                        @foreach ($unitInduks as $ui)
                                            <option value="{{ $ui->id }}" {{ $ui->id == $this->unitInduk ? 'selected' : '' }}>
                                                {{ $ui->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="app">App</label>
                                    <select id="app" class="form-control" wire:model="app" wire:change="$refresh">
                                        <option value="">{{ $appName }}</option>
                                        @foreach ($apps as $a)
                                            <option value="{{ $a->id }}" {{ $a->id == $this->app ? 'selected' : '' }}>
                                                {{ $a->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="basecamp">Basecamp</label>
                                    <select id="basecamp" class="form-control" wire:model="basecamp" wire:change="$refresh">
                                        <option value="">{{ $basecampName }}</option>
                                        @foreach ($basecamps as $bc)
                                            <option value="{{ $bc->id }}" {{ $bc->id == $this->basecamp ? 'selected' : '' }}>
                                                {{ $bc->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="garduInduk">Gardu Induk</label>
                                    <select id="garduInduk" class="form-control" wire:model="garduInduk" wire:change="$refresh">
                                        <option value="">{{ $garduIndukName }}</option>
                                        @foreach ($garduInduks as $gi)
                                            <option value="{{ $gi->id }}" {{ $gi->id == $this->garduInduk ? 'selected' : '' }}>
                                                {{ $gi->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary btn-lg mr-2">Save changes</button>
                        <button type="button" class="btn btn-secondary btn-lg" wire:click="cancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h4 class="text-danger">Delete Account</h4>
                <p class="text-muted">Are you sure you want to delete your account? Once you delete your account, there is no going back. Please be certain.</p>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="confirmDelete" wire:model="confirmDelete">
                    <label class="form-check-label" for="confirmDelete">I confirm my account deactivation</label>
                </div>
                <button class="btn btn-danger mt-3 btn-lg" wire:click="deleteAccount" {{ !$confirmDelete ? 'disabled' : '' }}>Deactivate Account</button>
            </div>
        </div>
    @endif

    {{-- Security Segment --}}
    @if ($activeTab === 'security')
        <div class="card">
            <div class="card-header">
                <h2>Security Settings</h2>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="changePassword">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" class="form-control" wire:model="currentPassword">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" class="form-control" wire:model="newPassword">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" id="confirmPassword" class="form-control" wire:model="confirmPassword">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Save changes</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h4>Two-steps verification</h4>
                <p>Two-factor authentication is not enabled yet.</p>
                <button class="btn btn-primary btn-lg" wire:click="enableTwoFactor">Enable Two-Factor Authentication</button>
            </div>
        </div>
    @endif
</div>
