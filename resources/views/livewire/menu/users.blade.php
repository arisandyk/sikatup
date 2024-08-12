<div class="users-container">
    <div class="users-cards">
        <div class="users-card">
            <div class="card-info">
                <h3>Users</h3>
                <h2>213 <span class="percentage">(+29%)</span></h2>
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
                <h3>Inacttive Users</h3>
                <h2>53 <span class="percentage">(+18%)</span></h2>
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
                <h2>160 <span class="percentage">(+14%)</span></h2>
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
                <h2>17 <span class="percentage">(+42%)</span></h2>
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


    <!-- Filters, Search, and Actions -->






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
                                <select id="filter-role" name="filter-role" class="filter-select">
                                    <option value="">Select Role</option>
                                    <option value="maintainer">Maintainer</option>
                                    <option value="subscriber">Subscriber</option>
                                    <option value="editor">Editor</option>
                                    <option value="author">Author</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <!-- Plan Filter -->
                            <div class="col-md-4">
                                <select id="filter-plan" name="filter-plan" class="filter-select">
                                    <option value="">Select Plan</option>
                                    <option value="enterprise">Enterprise</option>
                                    <option value="basic">Basic</option>
                                    <option value="team">Team</option>
                                    <option value="company">Company</option>
                                </select>
                            </div>
                            <!-- Status Filter -->
                            <div class="col-md-4">
                                <select id="filter-status" name="filter-status" class="filter-select">
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
                                <select id="filter-row" name="filter-row" class="filter-select">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-md-4 offset-md-2">
                                <!-- Search Box -->
                                <input type="text" id="search" name="search" class="search-box"
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
                    <th>Plan</th>
                    <th>Billing</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Rows (Replace with dynamic data) -->
                <tr>
                    <td><input type="checkbox" class="user-checkbox"></td>
                    <td>
                        <div class="user-info">
                            <img src="{{ asset('images/user.png') }}" alt="User Name" class="user-avatar">
                            <span>Ari Sandy K.</span>
                        </div>
                    </td>
                    <td>Developer</td>
                    <td>Enterprise</td>
                    <td>Auto Debit</td>
                    <td><span class="status-active">Active</span></td>
                    <td>
                        <div class="row action">


                            <button class="action-button col-md-4">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
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
                            <button class="action-button col-md-4">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                </i>
                            </button>
                            <button class="action-button col-md-4">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                    </svg>
                                </i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Repeat rows for each user -->
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $users->links() }}
    </div>
</div>
