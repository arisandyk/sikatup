<div class="dashboard-container">
    <div class="row">
        <!-- Left Column (md-9) -->
        <div class="col-md-9">
            <div class="dashboard-cards">
                <div class="dashboard-card">
                    <div class="card-info">
                        <h3>Users</h3>
                        <h2>{{ $totalUsers }} <span class="percentage">({{ $totalUsersPercentage }})</span></h2>
                        <p>Total Users</p>
                    </div>
                    <div class="card-icon">
                        <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg></i>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="card-info">
                        <h3>Devices</h3>
                        <h2>{{ $devices }} <span class="percentage">({{ $devicesPercentage }})</span></h2>
                        <p>Total Devices</p>
                    </div>
                    <div class="card-icon">
                        <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-devices">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M13 9a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1v-10z" />
                                <path d="M18 8v-3a1 1 0 0 0 -1 -1h-13a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h9" />
                                <path d="M16 9h2" />
                            </svg></i>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="card-info">
                        <h3>Locations</h3>
                        <h2>{{ $locations }} <span class="percentage">({{ $locationsPercentage }})</span></h2>
                        <p>Total Places</p>
                    </div>
                    <div class="card-icon">
                        <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                <path
                                    d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                            </svg></i>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="card-info">
                        <h3>Alarm Log</h3>
                        <h2>{{ $alarms }} <span class="percentage">({{ $alarmsPercentage }})</span></h2>
                        <p>A day ago</p>
                    </div>
                    <div class="card-icon">
                        <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-urgent">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                                <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                                <path
                                    d="M6 16m0 1a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                            </svg></i>
                    </div>
                </div>
            </div>
            <div class="diagram">
                <img src="{{ asset('images/schematic.png') }}" alt="Schematic Diagram">
            </div>
            <div class="map">
                <h2>Location</h2>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509375!2d144.95373631531744!3d-37.81627997975183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf5773c1c3b00b0f!2sDocklands%2C%20VIC%203008%2C%20Australia!5e0!3m2!1sen!2sus!4v1633016171237!5m2!1sen!2sus"
                    allowfullscreen></iframe>
            </div>
        </div>

        <!-- Right Column (md-3) -->
        <div class="col-md-3">
            <div class="user-alerts">
                <!-- Requests Section -->
                <div class="section-header">
                    <h3>Request</h3>
                    <a href="#" class="view-all">View all</a>
                </div>
                <div class="request-list card">
                    <div class="request-item">
                        <img src="{{ asset('images/jaquilline.png') }}" alt="Jaquiline" class="avatar-img">
                        <div class="request-info">
                            <h4>Jaquiline</h4>
                            <p>Ubah Gardu Induk</p>
                        </div>
                    </div>
                    <div class="request-item">
                        <img src="{{ asset('images/sennorita.png') }}" alt="Sennorita" class="avatar-img">
                        <div class="request-info">
                            <h4>Sennorita</h4>
                            <p>Ubah Unit Induk</p>
                        </div>
                    </div>
                    <div class="request-item">
                        <img src="{{ asset('images/firoz.png') }}" alt="Firoz" class="avatar-img">
                        <div class="request-info">
                            <h4>Firoz</h4>
                            <p>Ubah APP</p>
                        </div>
                    </div>
                </div>

                <!-- Alerts Section -->
                <div class="section-header">
                    <h3>Alert</h3>
                    <a href="#" class="view-all">View all</a>
                </div>
                <div class="alert-list">
                    <div class="alert-item">
                        <span class="alert-icon green-dot"></span>
                        <div class="alert-content">
                            <p>Air Conditioner</p>
                            <small>Turned on • Jaquiline</small>
                        </div>
                        <span class="alert-time">03:20</span>
                    </div>
                    <div class="alert-item">
                        <span class="alert-icon green-dot"></span>
                        <div class="alert-content">
                            <p>Refrigerator</p>
                            <small>Turned on • Firoz</small>
                        </div>
                        <span class="alert-time">01:48</span>
                    </div>
                    <div class="alert-item">
                        <span class="alert-icon red-dot"></span>
                        <div class="alert-content">
                            <p>Air Conditioner</p>
                            <small>Turned off • Jaquiline</small>
                        </div>
                        <span class="alert-time">11:36</span>
                    </div>
                    <div class="alert-item">
                        <span class="alert-icon red-dot"></span>
                        <div class="alert-content">
                            <p>Coffee Machine</p>
                            <small>Turned off • Jaquiline</small>
                        </div>
                        <span class="alert-time">09:15</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
