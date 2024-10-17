<div class="control-container">
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <div class="card-info">
                <h3>Users</h3>
                <h2>{{ $totalUsers }} <span class="percentage">({{ $totalUsersPercentage }})</span></h2>
                <p>Total Users</p>
            </div>
            <div class="card-icon">
                <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-users">
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
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-devices">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M13 9a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1v-10z" />
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
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
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
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-urgent">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 16v-4a4 4 0 0 1 8 0v4" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" />
                        <path d="M6 16m0 1a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                    </svg></i>
            </div>
        </div>
        <div class="user-alerts">
            <!-- Alerts Section -->
            <div class="section-header">
                <h3>Alert</h3>
                <a href="#" class="view-all">View all</a>
            </div>

            @if ($recentAlarms->isEmpty())
                <div class="alert-item">
                    <div class="alert-content">
                        <p>No alarms found.</p>
                    </div>
                </div>
            @else
                <div class="alert-list">
                    @foreach ($recentAlarms as $alarm)
                        <div class="alert-item">
                            <span
                                class="alert-icon {{ $alarm->getEventType() === 'open' ? 'green-dot' : ($alarm->getEventType() === 'close' ? 'red-dot' : 'undefined-dot') }}"></span>
                            <div class="alert-content">
                                <p>{{ $alarm->event_type }}</p>
                                <small>
                                    {{ $alarm->events->bays->gardu_induks->name ?? 'Unknown Induk' }} •
                                    {{ $alarm->events->bays->name ?? 'Unknown Bay' }}
                                </small>
                            </div>
                            <span class="alert-time">{{ $alarm->date_log }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <table class="custom-table">
        <thead>
            <tr class="title-row">
                <th colspan="16" id="title">
                    <div class="section-header-table">
                        <div>
                            <h3>
                                Trans JBT
                            </h3>
                        </div>
                        <div class="add-button-container">
                            <button class="add-button" onclick="toggleAddDropdown()">
                                {{-- Add Button --}}
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg></i>
                                <span>Add Bay</span>
                            </button>
                            <div id="addDropdown" class="dropdown-content" style="display: none;">
                                <button wire:click="addNewItem" class="add-option">Add New Item</button>
                                <button wire:click="importFromExcel" class="add-option">Import from Excel</button>
                            </div>
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th rowspan="1">Bay</th>
                <th rowspan="1">Gardu Induk</th>
                <th rowspan="1">Basecamp</th>
                <th rowspan="1">App</th>
                <th rowspan="1">Unit Induk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bays as $bay)
                <tr>
                    <td>{{ $bay->name }}</td>
                    <td>{{ $bay->gardu_induks->name ?? '-' }}</td>
                    <td>{{ $bay->gardu_induks->basecamps->name ?? '-' }}</td>
                    <td>{{ $bay->gardu_induks->basecamps->apps->name ?? '-' }}</td>
                    <td>{{ $bay->gardu_induks->basecamps->apps->unitInduk->name ?? '-' }}</td>
                </tr>
            @endforeach
            {{-- @if ($currentView === 'apps')
                @foreach ($apps as $app)
                    <tr>
                        <td class="name">
                            <a href="javascript:void(0);" wire:click="selectApp({{ $app->id }})">APP
                                {{ $app->name }}</a>
                        </td>
                        @php
                            $appTotals = collect($app->basecamps)->flatMap(function ($basecamp) {
                                return collect($basecamp->gardu_induks)->flatMap(function ($garduInduk) {
                                    return collect($garduInduk->bays)->flatMap(function ($bay) {
                                        return collect($bay->events);
                                    });
                                });
                            });
                            $lastEvent = $appTotals->last();
                        @endphp
                        @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'] as $eventType)
                            <td class="highlighted">{{ $appTotals->sum($eventType) }}</td>
                        @endforeach
                        <td class="jumlah">
                            {{ $appTotals->sum(fn($event) => collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'])->sum(fn($type) => $event->$type ?? 0)) }}
                        </td>
                        <td>{{ $lastEvent ? $lastEvent->getDateLogAttribute() : '-' }}</td>
                    </tr>
                @endforeach
            @elseif($currentView === 'basecamps')
                @foreach ($basecamps as $basecamp)
                    <tr>
                        <td class="name">
                            <a href="javascript:void(0);" wire:click="selectBasecamp({{ $basecamp->id }})">Basecamp
                                {{ $basecamp->name }}</a>
                        </td>
                        @php
                            $basecampTotals = collect($basecamp->gardu_induks)->flatMap(function ($garduInduk) {
                                return collect($garduInduk->bays)->flatMap(function ($bay) {
                                    return collect($bay->events);
                                });
                            });
                            $lastEvent = $basecampTotals->last();
                        @endphp
                        @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'] as $eventType)
                            <td class="highlighted">{{ $basecampTotals->sum($eventType) }}</td>
                        @endforeach
                        <td class="jumlah">
                            {{ $basecampTotals->sum(fn($event) => collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'])->sum(fn($type) => $event->$type ?? 0)) }}
                        </td>
                        <td>{{ $lastEvent ? $lastEvent->getDateLogAttribute() : '-' }}</td>
                    </tr>
                @endforeach
            @elseif($currentView === 'gardu_induks')
                @foreach ($garduInduks as $garduInduk)
                    <tr>
                        <td class="name">
                            <a href="javascript:void(0);" wire:click="selectGarduInduk({{ $garduInduk->id }})">Gardu
                                Induk {{ $garduInduk->name }}</a>
                        </td>
                        @php
                            $garduIndukTotals = collect($garduInduk->bays)->flatMap(function ($bay) {
                                return collect($bay->events);
                            });
                            $lastEvent = $garduIndukTotals->last();
                        @endphp
                        @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'] as $eventType)
                            <td class="highlighted">{{ $garduIndukTotals->sum($eventType) }}</td>
                        @endforeach
                        <td class="jumlah">
                            {{ $garduIndukTotals->sum(fn($event) => collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'])->sum(fn($type) => $event->$type ?? 0)) }}
                        </td>
                        <td>{{ $lastEvent ? $lastEvent->getDateLogAttribute() : '-' }}</td>
                    </tr>
                @endforeach
            @elseif($currentView === 'bays')
                @foreach ($bays as $bay)
                    @php
                        $latestEvent = $bay->events->last();
                    @endphp
                    <tr>
                        <td>{{ $bay->name }}</td>
                        @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'] as $eventType)
                            <td class="{{ $latestEvent && $latestEvent->$eventType ? 'highlighted' : '' }}">
                                {{ $latestEvent->$eventType ?? 0 }}
                            </td>
                        @endforeach
                        <td class="jumlah">
                            {{ collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'obt', 'und'])->sum(fn($eventType) => $latestEvent->$eventType ?? 0) }}
                        </td>
                        <td>{{ $latestEvent ? $latestEvent->getDateLogAttribute() : '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning"
                                wire:click="resetEvent({{ $latestEvent->id }})">Reset</button>
                        </td>
                        <td>
                            {{ $latestEvent && $latestEvent->reset_by ? App\Models\User::find($latestEvent->reset_by)->name : '-' }}
                        </td>
                    </tr>
                @endforeach
            @endif --}}
        </tbody>
    </table>
</div>
