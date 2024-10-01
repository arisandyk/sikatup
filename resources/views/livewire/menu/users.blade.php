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
                <tr>

                    <div class="row filter-search">
                        <div class="col-md-4">
                            <select wire:model.live="filterRole" class="filter-select">
                                <option value="">Select Role</option>
                                @foreach ($availableRoles as $role)
                                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select wire:model.live="filterUnitInduk" class="filter-select">
                                <option value="">Select Unit Induk</option>
                                @foreach ($availableUnits as $unit)
                                    <option value="{{ $unit }}">{{ $unit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select wire:model.live="filterStatus" class="filter-select">
                                <option value="">Select Status</option>
                                @foreach ($availableStatuses as $status)
                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </tr>
                <tr>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <select wire:model.live="perPage" class="per-page-select">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" wire:model.live.debounce.300ms="search" class="search-box"
                                placeholder="Search User">
                        </div>
                        <livewire:components.export />
                    </div>
                </tr>
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
                    <tr>
                        <td><input type="checkbox" class="user-checkbox"></td>
                        <td>
                            <div class="user-info">
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="user-avatar">
                                <span>{{ $user->name }}</span>
                            </div>
                        </td>
                        <td><span>{{ ucfirst($user->role) }}</span></td>
                        <td><span>{{ $user->unit_name }}</span></td>
                        <td><span>{{ $user->app_name }}</span></td>
                        <td>
                            <span class="status-{{ $user->account_status }}">
                                {{ ucfirst($user->account_status) }}
                            </span>
                        </td>
                        <td>
                            <div class="row action">
                                <button wire:click="triggerDeleteModal({{ $user->id }})"
                                    class="btn btn-danger delete">
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
    <div class="total-records">
        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} records
    </div>
    <livewire:components.delete-user-modal />
</div>
