<div class="container">
    <div class="header-section">
        <div class="profile-header">
            <div class="profile-background"></div>
            <div class="profile-content">
                <div class="profile-info">
                    <img src="{{ asset('images/user.png') }}" alt="User Image" class="profile-img">
                    <div class="profile-details">
                        <h1>Ari Sandy K</h1>
                        <p>
                            <span>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase-2">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 9a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9z" />
                                        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                </i>
                            </span>
                            UX Designer
                            <span>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                        <path
                                            d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                                    </svg>
                                </i>
                            </span>
                            Karawang City
                            <span>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M11 15h1" />
                                        <path d="M12 15v3" />
                                    </svg>
                                </i>
                            </span>
                            Joined April 2021
                        </p>
                    </div>
                </div>
                <button class="btn-connect">Edit</button>
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link @if ($activeTab === 'profile') active @endif"
                            wire:click="$set('activeTab', 'profile')">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($activeTab === 'request') active @endif"
                            wire:click="$set('activeTab', 'request')">Request</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="tab-content">
                @if ($activeTab === 'profile')
                    <livewire:components.profile />
                @elseif($activeTab === 'request')
                    <livewire:components.request />
                @endif
            </div>
        </div>
    </div>
</div>
