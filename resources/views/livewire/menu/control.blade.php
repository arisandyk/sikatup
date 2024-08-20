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
            <div class="alert-list">
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
                        <p>Coffee Machine</p>
                        <small>Turned off • Jaquiline</small>
                    </div>
                    <span class="alert-time">09:15</span>
                </div>
            </div>
        </div>
    </div>

    <table class="custom-table">
        <thead>
            <tr class="title-row">
                <th colspan="12" id="title">
                    <div class="row">
                        <div class="col-md-7">
                            <h2>
                                Trans JBT
                                @foreach ($breadcrumb as $item)
                                    -> {{ $item }}
                                @endforeach
                            </h2>
                        </div>
                        <div class="col-md-5 text-right flex-end">
                            <div class="filter-pill">
                                <button class="pill-button">Unit Induk:</button>
                                <select class="pill-dropdown" wire:model="selectedUnitInduk" wire:change='$refresh'>
                                    <option value="">Pilih Unit Induk</option>
                                    @foreach ($unitInduks as $unitInduk)
                                        <option value="{{ $unitInduk->id }}">{{ $unitInduk->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th rowspan="2">
                    @if ($selectedGarduInduk)
                        Bay Name
                    @elseif($selectedBasecamp)
                        Gardu Induk Name
                    @elseif($selectedApp)
                        Basecamp Name
                    @else
                        App Name
                    @endif
                </th>
                <th colspan="9">Kejadian Buka-Tutup (Kali)</th>
                <th rowspan="2">Jumlah</th>
                <th rowspan="2">Kejadian Terakhir</th>
            </tr>
            <tr>
                <th>OBD</th>
                <th>CBD</th>
                <th>OBP</th>
                <th>CBP</th>
                <th>OBR</th>
                <th>CBR</th>
                <th>OBL</th>
                <th>CBL</th>
                <th>UND</th>
            </tr>
        </thead>
        <tbody>
            @if ($currentView === 'apps')
                @foreach ($apps as $app)
                    @foreach ($app->basecamps as $basecamp)
                        @foreach ($basecamp->gardu_induks as $gardu_induk)
                            @foreach ($gardu_induk->bays as $bay)
                                @php
                                    $latestEvent = $bay->events->last();
                                @endphp
                                <tr>
                                    <td class="name">APP {{ $app->name }}</td>
                                    @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'] as $eventType)
                                        <td
                                            class="{{ $latestEvent && $latestEvent->$eventType ? 'highlighted' : '' }}">
                                            {{ $latestEvent->$eventType ?? 0 }}
                                        </td>
                                    @endforeach
                                    <td class="jumlah">
                                        {{ collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'])->sum(fn($eventType) => $latestEvent->$eventType ?? 0) }}
                                    </td>
                                    <td>{{ $latestEvent ? $latestEvent->getDateLogAttribute() : '-' }}</td>
                                </tr>
                                <tr class="total-row">
                                    <td>Total</td>
                                    @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'] as $eventType)
                                        <td class="total-{{ $eventType }}">
                                            {{ collect($apps)->sum(fn($app) => collect($app->basecamps)->sum(fn($basecamp) => collect($basecamp->gardu_induks)->sum(fn($garduInduk) => collect($garduInduk->bays)->sum(fn($bay) => collect($bay->events)->sum($eventType))))) }}
                                        </td>
                                    @endforeach
                                    <td class="total-jumlah">
                                        {{ collect($apps)->sum(fn($app) => collect($app->basecamps)->sum(fn($basecamp) => collect($basecamp->gardu_induks)->sum(fn($garduInduk) => collect($garduInduk->bays)->sum(fn($bay) => collect($bay->events)->sum(fn($event) => collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'])->sum(fn($eventType) => $event->$eventType ?? 0)))))) }}
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            @elseif($currentView === 'basecamps' && $selectedApp)
                @foreach ($selectedApp->basecamps as $basecamp)
                    @foreach ($basecamp->gardu_induks as $gardu_induk)
                        @foreach ($gardu_induk->bays as $bay)
                            @php
                                $latestEvent = $bay->events->last();
                            @endphp
                            <tr>
                                <td class="name">Basecamp {{ $basecamp->name }}</td>
                                @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'] as $eventType)
                                    <td class="{{ $latestEvent && $latestEvent->$eventType ? 'highlighted' : '' }}">
                                        {{ $latestEvent->$eventType ?? 0 }}
                                    </td>
                                @endforeach
                                <td class="jumlah">
                                    {{ collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'])->sum(fn($eventType) => $latestEvent->$eventType ?? 0) }}
                                </td>
                                <td>{{ $latestEvent ? $latestEvent->getDateLogAttribute() : '-' }}</td>
                            </tr>
                            <tr class="total-row">
                                <td>Total</td>
                                @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'] as $eventType)
                                    <td class="total-{{ $eventType }}">
                                        {{ collect($apps)->sum(fn($app) => collect($app->basecamps)->sum(fn($basecamp) => collect($basecamp->gardu_induks)->sum(fn($garduInduk) => collect($garduInduk->bays)->sum(fn($bay) => collect($bay->events)->sum($eventType))))) }}
                                    </td>
                                @endforeach
                                <td class="total-jumlah">
                                    {{ collect($apps)->sum(fn($app) => collect($app->basecamps)->sum(fn($basecamp) => collect($basecamp->gardu_induks)->sum(fn($garduInduk) => collect($garduInduk->bays)->sum(fn($bay) => collect($bay->events)->sum(fn($event) => collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'])->sum(fn($eventType) => $event->$eventType ?? 0)))))) }}
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
                <!-- Kondisi untuk menampilkan data berdasarkan seleksi -->
            @elseif($currentView === 'gardu_induks' && $selectedBasecamp)
                @foreach ($selectedBasecamp->gardu_induks as $gardu_induk)
                    @foreach ($gardu_induk->bays as $bay)
                        @php
                            $latestEvent = $bay->events->last();
                        @endphp
                        <tr>
                            <td>{{ $bay->name }}</td>
                            @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'] as $eventType)
                                <td class="{{ $latestEvent && $latestEvent->$eventType ? 'highlighted' : '' }}">
                                    {{ $latestEvent->$eventType ?? 0 }}
                                </td>
                            @endforeach
                            <td class="jumlah">
                                {{ collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'])->sum(fn($eventType) => $latestEvent->$eventType ?? 0) }}
                            </td>
                            <td>{{ $latestEvent ? $latestEvent->getDateLogAttribute() : '-' }}</td>
                        </tr>
                        <tr class="total-row">
                            <td>Total</td>
                            @foreach (['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'] as $eventType)
                                <td class="total-{{ $eventType }}">
                                    {{ collect($apps)->sum(fn($app) => collect($app->basecamps)->sum(fn($basecamp) => collect($basecamp->gardu_induks)->sum(fn($garduInduk) => collect($garduInduk->bays)->sum(fn($bay) => collect($bay->events)->sum($eventType))))) }}
                                </td>
                            @endforeach
                            <td class="total-jumlah">
                                {{ collect($apps)->sum(fn($app) => collect($app->basecamps)->sum(fn($basecamp) => collect($basecamp->gardu_induks)->sum(fn($garduInduk) => collect($garduInduk->bays)->sum(fn($bay) => collect($bay->events)->sum(fn($event) => collect(['obd', 'cbd', 'obp', 'cbp', 'obr', 'cbr', 'obl', 'cbl', 'und'])->sum(fn($eventType) => $event->$eventType ?? 0)))))) }}
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
            <tr class="total-row">
                <td>Total</td>
                @php
                    $totalObd = $totalCbd = $totalObp = $totalCbp = $totalObr = $totalCbr = $totalObl = $totalCbl = $totalUnd = 0;
                @endphp
                @foreach ($apps as $app)
                    @foreach ($app->basecamps as $basecamp)
                        @foreach ($basecamp->gardu_induks as $gardu_induk)
                            @foreach ($gardu_induk->bays as $bay)
                                @foreach ($bay->events as $event)
                                    @php
                                        $totalObd += $event->obd ?? 0;
                                        $totalCbd += $event->cbd ?? 0;
                                        $totalObp += $event->obp ?? 0;
                                        $totalCbp += $event->cbp ?? 0;
                                        $totalObr += $event->obr ?? 0;
                                        $totalCbr += $event->cbr ?? 0;
                                        $totalObl += $event->obl ?? 0;
                                        $totalCbl += $event->cbl ?? 0;
                                        $totalUnd += $event->und ?? 0;
                                    @endphp
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach

                <td class="total-obd">{{ $totalObd }}</td>
                <td class="total-cbd">{{ $totalCbd }}</td>
                <td class="total-obp">{{ $totalObp }}</td>
                <td class="total-cbp">{{ $totalCbp }}</td>
                <td class="total-obr">{{ $totalObr }}</td>
                <td class="total-cbr">{{ $totalCbr }}</td>
                <td class="total-obl">{{ $totalObl }}</td>
                <td class="total-cbl">{{ $totalCbl }}</td>
                <td class="total-und">{{ $totalUnd }}</td>
                <td class="total-jumlah">
                    {{ $totalObd + $totalCbd + $totalObp + $totalCbp + $totalObr + $totalCbr + $totalObl + $totalCbl + $totalUnd }}
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="legend-grid">
        <div class="row">
            <div class="col-md-2">
                <div class="legend-item-container">
                    <span class="legend-item red-pill">OBD</span>
                    <span class="legend-description">Opened By Device</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="legend-item-container">
                    <span class="legend-item red-pill">OBP</span>
                    <span class="legend-description">Opened By Protection</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="legend-item-container">
                    <span class="legend-item red-pill">OBR</span>
                    <span class="legend-description">Opened By Remote</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="legend-item-container">
                    <span class="legend-item red-pill">OBL</span>
                    <span class="legend-description">Opened By Local</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="legend-item-container">
                    <span class="legend-item red-pill">OBT</span>
                    <span class="legend-description">Opened By Teleporter</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="legend-item-container">
                    <span class="legend-item red-pill">CBD</span>
                    <span class="legend-description">Close By Device</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="legend-item-container">
                    <span class="legend-item red-pill">CBP</span>
                    <span class="legend-description">Close By Protection</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="legend-item-container">
                    <span class="legend-item red-pill">CBR</span>
                    <span class="legend-description">Close By Remote</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="legend-item-container">
                    <span class="legend-item red-pill">CBL</span>
                    <span class="legend-description">Close By Local</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="legend-item-container">
                    <span class="legend-item red-pill">UND</span>
                    <span class="legend-description">Undefined</span>
                </div>
            </div>
        </div>
    </div>
</div>
