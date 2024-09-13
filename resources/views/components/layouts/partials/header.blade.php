<div class="header">
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h2>{{ $title }}</h2>
    <div class="search-bar">
        <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                <path d="M21 21l-6 -6" />
            </svg></i>
        @livewire('components.header-search')
    </div>

    <div class="notifications">
        <div class="toggle">
            <input type="checkbox" id="toggle-light-dark">
            <label for="toggle-light-dark"></label>
        </div>
        <div class="notification-wrapper">
            <a href="#" id="notification-icon">
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-bell">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                    </svg>
                </i>
                <span class="notification-count">6</span>
            </a>

            <div class="notification-dropdown">
                <h4>Notifications</h4>
                <ul>
                    <li>
                        <div class="notification-item">
                            <p><strong>New Message</strong> from John Doe</p>
                            <small>2 minutes ago</small>
                        </div>
                    </li>
                    <li>
                        <div class="notification-item">
                            <p><strong>Server Alert:</strong> High CPU Usage</p>
                            <small>10 minutes ago</small>
                        </div>
                    </li>
                    <li>
                        <div class="notification-item">
                            <p><strong>Update Available:</strong> Version 2.0</p>
                            <small>30 minutes ago</small>
                        </div>
                    </li>
                </ul>
                <a href="#" class="view-all">View All Notifications</a>
            </div>
        </div>
        <a href="#"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 9v4" />
                    <path d="M12 16v.01" />
                </svg></i></a>
    </div>
</div>
