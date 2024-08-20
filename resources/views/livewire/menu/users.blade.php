<div class="users-container">
    <div class="users-cards">
        <div class="users-card">
            <div class="card-info">
                <h3>Users</h3>
                <h2>{{ $totalUsers }} <span class="percentage">({{ $totalUsersPercentage }})</span></h2>
                <p>Total Users</p>
            </div>
            <div class="card-icon">
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                </i>
            </div>
        </div>
        <div class="users-card">
            <div class="card-info">
                <h3>Inactive Users</h3>
                <h2>{{ $inactiveUsers }} <span class="percentage">({{ $inactiveUsersPercentage }})</span></h2>
                <p>Last week analytics</p>
            </div>
            <div class="card-icon">
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-x">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                        <path d="M22 22l-5 -5" />
                        <path d="M17 22l5 -5" />
                    </svg>
                </i>
            </div>
        </div>
        <div class="users-card">
            <div class="card-info">
                <h3>Active Users</h3>
                <h2>{{ $activeUsers }} <span class="percentage">({{ $activeUsersPercentage }})</span></h2>
                <p>Last week analytics</p>
            </div>
            <div class="card-icon">
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                        <path d="M15 19l2 2l4 -4" />
                    </svg>
                </i>
            </div>
        </div>
        <div class="users-card">
            <div class="card-info">
                <h3>Pending Users</h3>
                <h2>{{ $pendingUsers }} <span class="percentage">({{ $pendingUsersPercentage }})</span></h2>
                <p>A day ago</p>
            </div>
            <div class="card-icon">
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-search">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5" />
                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M20.2 20.2l1.8 1.8" />
                    </svg>
                </i>
            </div>
        </div>
    </div>

    <!-- User Table -->
    <div class="table-container mt-4">
        <table class="users-table">
            <thead>
                <div class="header-actions">
                    <h2>Filters</h2>
                    <tr>

                        <div class="row filter-search">
                            <!-- Role Filter -->
                            <div class="col-md-4">
                                <select wire:model="filterRole" class="filter-select">
                                    <option value="">Select Role</option>>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <!-- Plan Filter -->
                            <div class="col-md-4">
                                <select wire:model="filterPlan" class="filter-select">
                                    <option value="">Select Plan</option>
                                    <option value="enterprise">Enterprise</option>
                                    <option value="basic">Basic</option>
                                    <option value="team">Team</option>
                                    <option value="company">Company</option>
                                </select>
                            </div>
                            <!-- Status Filter -->
                            <div class="col-md-4">
                                <select wire:model="filterStatus" class="filter-select">
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </tr>
                    <tr>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <select class="filter-select">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-md-4 offset-md-2">
                                <!-- Search Box -->
                                <input type="text" wire:model="search" class="search-box"
                                    placeholder="Search User">
                            </div>
                            <div class="col-md-4 text-right">
                                <div class="action-buttons">
                                    <select name="export-button" id="export-button">
                                        <option value="">Export</option>
                                        <option value="print"><button class="print">Print</button></option>
                                        <option value="csv"><button class="csv">Csv</button></option>
                                        <option value="excel"><button class="excel">Excel</button></option>
                                        <option value="pdf"><button class="pdf">Pdf</button></option>
                                        <option value="copy"><button class="copy">Copy</button></option>
                                    </select>
                                    <button class="add-user-button">+ Add New User</button>
                                </div>
                            </div>
                        </div>
                    </tr>
                </div>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Unit Induk</th>
                    <th>App</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <!-- Example Rows (Replace with dynamic data) -->
                    <tr>
                        <td><input type="checkbox" class="user-checkbox"></td>
                        <td>
                            <div class="user-info">
                                <img src="{{ $user->avatar }}" alt="User Name" class="user-avatar">
                                <span>{{ $user->name }}</span>
                            </div>
                        </td>
                        <td><span>{{ ucfirst($user->role) }}</span></td>
                        <td><span>{{ $user->unit_name }}</span></td>
                        <td><span>{{ $user->app_name }}</span></td>
                        <td>
                            <span
                                class="{{ $user->account_status === 'active'
                                    ? 'status-active'
                                    : ($user->account_status === 'pending'
                                        ? 'status-pending'
                                        : 'status-inactive') }}">
                                {{ ucfirst($user->account_status) }}
                            </span>
                        </td>
                        <td>
                            <div class="row action">
                                {{-- Delete Button --}}
                                <button class="action-button col-md-4" onclick="handleDelete({{ $user->id }})">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </i>
                                </button>
                                {{-- Visible Button --}}
                                <button class="action-button col-md-4" onclick="handleView({{ $user->id }})">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </i>
                                </button>
                                {{-- More Function Button --}}
                                <div class="dropdown col-md-4">
                                    <button class="action-button dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            </svg>
                                        </i>
                                    </button>
                                    {{-- Edit Button --}}
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><button class="dropdown-item edit-user-btn" data-user-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#editModal" >Edit</button></li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $users->links() }}
    </div>
    <livewire:components.edit-user />
</div>

