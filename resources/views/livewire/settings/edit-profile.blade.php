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
                    <div class="form-group">
                        <label for="profilePicture">Profile Picture</label>
                        <div class="profile-picture-upload">
                            <img src="{{ asset('images/user.png') }}" alt="User Image" class="profile-img">
                            <input type="file" id="profilePicture" class="upload-input" wire:model="profilePicture">
                            <button class="upload-button">Upload new photo</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" class="form-control" wire:model="name">
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" id="nip" class="form-control" wire:model="nip">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" wire:model="email">
                    </div>
                    <div class="form-group">
                        <label for="mobileNumber">Mobile Number</label>
                        <input type="text" id="mobileNumber" class="form-control" wire:model="mobileNumber">
                    </div>
                    <div class="form-group">
                        <label for="unitInduk">Unit Induk</label>
                        <select id="unitInduk" class="form-control" wire:model="unitInduk" wire:change="$refresh">
                            <option value="" disabled>Select Unit Induk</option>
                            @foreach ($unitInduks as $ui)
                                <option value="{{ $ui->id }}" {{ $ui->id == $this->unitInduk ? 'selected' : '' }}>
                                    {{ $ui->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="app">App</label>
                        <select id="app" class="form-control" wire:model="app" wire:change="$refresh">
                            <option value="" disabled>Select App</option>
                            @foreach ($apps as $a)
                                <option value="{{ $a->id }}" {{ $a->id == $this->app ? 'selected' : '' }}>
                                    {{ $a->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="basecamp">Basecamp</label>
                        <select id="basecamp" class="form-control" wire:model="basecamp" wire:change="$refresh">
                            <option value="" disabled>Select Basecamp</option>
                            @foreach ($basecamps as $bc)
                                <option value="{{ $bc->id }}" {{ $bc->id == $this->basecamp ? 'selected' : '' }}>
                                    {{ $bc->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="garduInduk">Gardu Induk</label>
                        <select id="garduInduk" class="form-control" wire:model="garduInduk" wire:change="$refresh">
                            <option value="" disabled>Select Gardu Induk</option>
                            @foreach ($garduInduks as $gi)
                                <option value="{{ $gi->id }}"
                                    {{ $gi->id == $this->garduInduk ? 'selected' : '' }}>
                                    {{ $gi->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" wire:click="cancel">Cancel</button>
                </form>
            </div>
        </div>
        <div class="delete-account">
            <h4>Delete Account</h4>
            <p>Are you sure you want to delete your account? Once you delete your account, there is no going back.
                Please be certain.</p>
            <input type="checkbox" wire:model="confirmDelete"> I confirm my account deactivation
            <button class="btn btn-danger" wire:click="deleteAccount"
                {{ !$confirmDelete ? 'disabled' : '' }}>Deactivate
                Account</button>
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
                        <input type="password" id="confirmPassword" class="form-control"
                            wire:model="confirmPassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h4>Two-steps verification</h4>
                <p>Two-factor authentication is not enabled yet.</p>
                <button class="btn btn-primary" wire:click="enableTwoFactor">Enable Two-Factor Authentication</button>
            </div>
        </div>
    @endif
</div>
