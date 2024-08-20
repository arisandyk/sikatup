<div class="row">
    <div class="col-md-4">
        <div class="card about">
            <div class="card-body">
                <div class="list-group">
                    <div class="list">
                        <h4>About</h4>
                        <ul>
                            <li>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    </svg>
                                </i>
                                <strong>Full Name:</strong> {{ Auth::user()->name }}
                            </li>
                            <li>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                </i>
                                <strong>Status:</strong> {{ ucfirst(Auth::user()->account_status) }}
                            </li>
                            <li>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-crown">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z" />
                                    </svg>
                                </i>
                                <strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}
                            </li>
                            <li>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-id-badge-2">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 12h3v4h-3z" />
                                        <path
                                            d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" />
                                        <path
                                            d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                        <path d="M14 16h2" />
                                        <path d="M14 12h4" />
                                    </svg>
                                </i>
                                <strong>NIP:</strong> 2021010024001
                            </li>
                            <li>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-map">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13" />
                                        <path d="M9 4v13" />
                                        <path d="M15 7v13" />
                                    </svg>
                                </i>
                                @php
                                    $workplace = Auth::user()->current_workplace;
                                    $unitInduk = explode(',', $workplace)[0];
                                    $unitInduk = str_replace('Unit Induk ', '', $unitInduk);
                                    $app = explode(',', $workplace)[1];
                                    $app = str_replace('App ', '', $app);
                                @endphp
                                <strong>Unit Induk:</strong> {{ $unitInduk }}
                            </li>
                            <li>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-buildings">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 21v-15c0 -1 1 -2 2 -2h5c1 0 2 1 2 2v15" />
                                        <path d="M16 8h2c1 0 2 1 2 2v11" />
                                        <path d="M3 21h18" />
                                        <path d="M10 12v0" />
                                        <path d="M10 16v0" />
                                        <path d="M10 8v0" />
                                        <path d="M7 12v0" />
                                        <path d="M7 16v0" />
                                        <path d="M7 8v0" />
                                        <path d="M17 12v0" />
                                        <path d="M17 16v0" />
                                    </svg>
                                </i>

                                <strong>App:</strong> {{ $app }}
                            </li>

                        </ul>
                    </div>

                    <div class="list contact">
                        <h4>Contact</h4>
                        <ul>
                            <li>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-address-book">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                                        <path d="M10 16h6" />
                                        <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M4 8h3" />
                                        <path d="M4 12h3" />
                                        <path d="M4 16h3" />
                                    </svg>
                                </i>
                                <strong>Contact:</strong> {{ Auth::user()->mobile_number }}
                            </li>
                            <li>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                        <path d="M3 7l9 6l9 -6" />
                                    </svg>
                                </i>
                                <strong>Email:</strong> {{ Auth::user()->email }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Activity Timelines</h4>
                        <div class="timeline">
                            <ul>
                                <li class="timeline-item design">
                                    <div class="timeline-content">
                                        <strong>Completed the redesign of the company's main website.</strong>
                                        <span class="timeline-date">July 2024</span>
                                    </div>
                                </li>
                                <li class="timeline-item development">
                                    <div class="timeline-content">
                                        <strong>Led a team of 5 designers in the development of a new mobile
                                            application.</strong>
                                        <span class="timeline-date">May 2024</span>
                                    </div>
                                </li>
                                <li class="timeline-item conference">
                                    <div class="timeline-content">
                                        <strong>Attended and spoke at UX Conference in New York.</strong>
                                        <span class="timeline-date">February 2024</span>
                                    </div>
                                </li>
                                <li class="timeline-item promotion">
                                    <div class="timeline-content">
                                        <strong>Promoted to Senior UX Designer.</strong>
                                        <span class="timeline-date">October 2023</span>
                                    </div>
                                </li>
                                <li class="timeline-item join">
                                    <div class="timeline-content">
                                        <strong>Joined the design team at ABC Corporation.</strong>
                                        <span class="timeline-date">April 2023</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
