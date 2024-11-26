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
                                    {{ $alarm->controls->bays->gardu_induks->name ?? 'Unknown Induk' }} •
                                    {{ $alarm->controls->bays->name ?? 'Unknown Bay' }}
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
                        <div class="add-button-container relative">
                            <!-- Add Dropdown -->
                            <button class="add-button text-white px-4 py-2 rounded-md" onclick="toggleAddDropdown()">
                                Add Bay
                            </button>
                            <div id="addDropdown"
                                class="dropdown-content absolute right-0 mt-2 bg-white shadow-lg rounded-md hidden">
                                <button wire:click="showAddModal"
                                    class="add-option block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Add New Item
                                </button>
                                <button wire:click="importFromExcel"
                                    class="add-option block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Import from Excel
                                </button>
                            </div>

                            <!-- Offcanvas -->
                            <div class="relative">
                                <!-- Overlay -->
                                <div class="fixed inset-0 bg-black bg-opacity-25 z-40 transition-opacity duration-300 {{ $isAddModalOpen ? 'opacity-100 visible' : 'opacity-0 invisible' }}"
                                    wire:click="hideAddModal">
                                </div>

                                <!-- Offcanvas Modal -->
                                <div
                                    class="fixed top-0 right-0 w-1/4 h-full bg-white shadow-lg z-50 transform transition-transform duration-300 ease-in-out {{ $isAddModalOpen ? 'translate-x-0' : 'translate-x-full' }}">
                                    <div class="p-4 text-sm">
                                        <!-- Header -->
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-base font-semibold">Add New Bay</h3>
                                            <button wire:click="hideAddModal"
                                                class="text-gray-600 hover:text-gray-800 text-lg">✕</button>
                                        </div>

                                        <!-- Form -->
                                        <form wire:submit.prevent="addNewItem">

                                            <!-- Unit Induk -->
                                            <div class="mb-3">
                                                <label for="unitInduk" class="block text-sm font-medium">Unit
                                                    Induk</label>
                                                <select id="unitInduk" wire:model="selectedUnitInduk"
                                                    wire:change="$refresh" class="form-control text-sm">
                                                    <option value="">Select Unit Induk</option>
                                                    @foreach ($unitInduks as $unitInduk)
                                                        <option value="{{ $unitInduk->id }}">{{ $unitInduk->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- APP -->
                                            <div class="mb-3">
                                                <label for="app" class="block text-sm font-medium">APP</label>
                                                <select id="app" wire:model="selectedApp"
                                                    wire:change="$refresh" class="form-control text-sm"
                                                    {{ !$selectedUnitInduk ? 'disabled' : '' }}>
                                                    <option value="">Select APP</option>
                                                    @foreach ($apps as $app)
                                                        <option value="{{ $app->id }}">{{ $app->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Basecamp -->
                                            <div class="mb-3">
                                                <label for="basecamp"
                                                    class="block text-sm font-medium">Basecamp</label>
                                                <select id="basecamp" wire:model="selectedBasecamp"
                                                    wire:change="$refresh" class="form-control text-sm"
                                                    {{ !$selectedApp ? 'disabled' : '' }}>
                                                    <option value="">Select Basecamp</option>
                                                    @foreach ($basecamps as $basecamp)
                                                        <option value="{{ $basecamp->id }}">{{ $basecamp->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Gardu Induk -->
                                            <div class="mb-3">
                                                <label for="garduInduk" class="block text-sm font-medium">Gardu
                                                    Induk</label>
                                                <select id="garduInduk" wire:model="selectedGarduInduk"
                                                    wire:change="$refresh" class="form-control text-sm"
                                                    {{ !$selectedBasecamp ? 'disabled' : '' }}>
                                                    <option value="">Select Gardu Induk</option>
                                                    @foreach ($garduInduks as $garduInduk)
                                                        <option value="{{ $garduInduk->id }}">{{ $garduInduk->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Bay Name -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-medium">Bay Name</label>
                                                <input type="text" wire:model="newBayName"
                                                    class="w-full p-1 border rounded-md text-sm">
                                            </div>

                                            <!-- Status -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-medium">Status</label>
                                                <input type="text" wire:model="newBayStatus"
                                                    class="w-full p-1 border rounded-md text-sm">
                                            </div>

                                            <!-- Tanggal Operasi -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-normal">Tanggal Operasi</label>
                                                <input type="date" wire:model="newBayTanggalOperasi"
                                                    class="w-full p-1 border rounded-md text-sm">
                                            </div>

                                            <!-- Tegangan -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-normal">Tegangan</label>
                                                <select wire:model="newBayTeganganId"
                                                    class="w-full p-1 border rounded-md text-sm">
                                                    <option value="">Select Tegangan</option>
                                                    @foreach ($tegangans as $tegangan)
                                                        <option value="{{ $tegangan->id }}">{{ $tegangan->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Trafo -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-normal">Trafo</label>
                                                <select wire:model="newBayTrafoId"
                                                    class="w-full p-1 border rounded-md text-sm">
                                                    <option value="">Select Trafo</option>
                                                    @foreach ($trafos as $trafo)
                                                        <option value="{{ $trafo->id }}">{{ $trafo->name_plate }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Nomor Series -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-medium">Nomor Series</label>
                                                <input type="text" wire:model="newBayNomorSeries"
                                                    class="w-full p-1 border rounded-md text-sm">
                                            </div>

                                            <!-- Keterangan -->
                                            <div class="mb-3">
                                                <label class="block text-sm font-medium">Keterangan</label>
                                                <textarea wire:model="newBayKeterangan" class="w-full p-1 border rounded-md text-sm"></textarea>
                                            </div>

                                            <!-- Submit and Cancel -->
                                            <div class="flex justify-end mt-3">
                                                <button type="submit"
                                                    class="px-2 py-1 bg-[#101041] text-white text-sm rounded-md hover:bg-opacity-90 transition">
                                                    Submit
                                                </button>
                                                <button type="button" wire:click="hideAddModal"
                                                    class="ml-2 px-2 py-1 bg-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-400 transition">
                                                    Cancel
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
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
                <th>Action</th> <!-- Tambahkan ini -->
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
                    <td>
                        <div class="action-buttons">
                            <!-- Tombol Edit -->
                            <button wire:click="showEditModal({{ $bay->id }})" class="btn-action edit-button">
                                <i class="icon-edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 3.13a4 4 0 0 1 5 5L6.37 22.5a4 4 0 0 1-5-5z"></path>
                                        <line x1="16" y1="3" x2="22" y2="9"></line>
                                    </svg>
                                </i>
                            </button>
                    
                            <!-- Tombol Delete -->
                            <button wire:click="confirmDelete({{ $bay->id }})" class="btn-action delete-button">
                                <i class="icon-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"></path>
                                        <path d="M6 6v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6"></path>
                                        <path d="M9 10v6"></path>
                                        <path d="M15 10v6"></path>
                                    </svg>
                                </i>
                            </button>
                        </div>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Edit Offcanvas -->
    <div class="relative">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-25 z-40 transition-opacity duration-300 {{ $isEditModalOpen ? 'opacity-100 visible' : 'opacity-0 invisible' }}"
            wire:click="hideEditModal">
        </div>

        <!-- Offcanvas Modal -->
        <div
            class="fixed top-0 right-0 w-1/4 h-full bg-white shadow-lg z-50 transform transition-transform duration-300 ease-in-out {{ $isEditModalOpen ? 'translate-x-0' : 'translate-x-full' }}">
            <div class="p-4 text-sm">
                <!-- Header -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base font-semibold">Edit Bay</h3>
                    <button wire:click="hideEditModal" class="text-gray-600 hover:text-gray-800 text-lg">✕</button>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="updateItem">

                    <!-- Unit Induk -->
                    <div class="mb-3">
                        <label for="unitIndukEdit" class="block text-sm font-medium">Unit Induk</label>
                        <select id="unitIndukEdit" wire:model="selectedUnitInduk" wire:change="$refresh"
                            class="form-control text-sm">
                            <option value="">Select Unit Induk</option>
                            @foreach ($unitInduks as $unitInduk)
                                <option value="{{ $unitInduk->id }}">{{ $unitInduk->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- APP -->
                    <div class="mb-3">
                        <label for="appEdit" class="block text-sm font-medium">APP</label>
                        <select id="appEdit" wire:model="selectedApp" wire:change="$refresh"
                            class="form-control text-sm" {{ !$selectedUnitInduk ? 'disabled' : '' }}>
                            <option value="">Select APP</option>
                            @foreach ($apps as $app)
                                <option value="{{ $app->id }}">{{ $app->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Basecamp -->
                    <div class="mb-3">
                        <label for="basecampEdit" class="block text-sm font-medium">Basecamp</label>
                        <select id="basecampEdit" wire:model="selectedBasecamp" wire:change="$refresh"
                            class="form-control text-sm" {{ !$selectedApp ? 'disabled' : '' }}>
                            <option value="">Select Basecamp</option>
                            @foreach ($basecamps as $basecamp)
                                <option value="{{ $basecamp->id }}">{{ $basecamp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gardu Induk -->
                    <div class="mb-3">
                        <label for="garduIndukEdit" class="block text-sm font-medium">Gardu Induk</label>
                        <select id="garduIndukEdit" wire:model="selectedGarduInduk" wire:change="$refresh"
                            class="form-control text-sm" {{ !$selectedBasecamp ? 'disabled' : '' }}>
                            <option value="">Select Gardu Induk</option>
                            @foreach ($garduInduks as $garduInduk)
                                <option value="{{ $garduInduk->id }}">{{ $garduInduk->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bay Name -->
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Bay Name</label>
                        <input type="text" wire:model="newBayName" class="w-full p-1 border rounded-md text-sm">
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Status</label>
                        <input type="text" wire:model="newBayStatus" class="w-full p-1 border rounded-md text-sm">
                    </div>

                    <!-- Tanggal Operasi -->
                    <div class="mb-3">
                        <label class="block text-sm font-normal">Tanggal Operasi</label>
                        <input type="date" wire:model="newBayTanggalOperasi"
                            class="w-full p-1 border rounded-md text-sm">
                    </div>

                    <!-- Tegangan -->
                    <div class="mb-3">
                        <label class="block text-sm font-normal">Tegangan</label>
                        <select wire:model="newBayTeganganId" class="w-full p-1 border rounded-md text-sm">
                            <option value="">Select Tegangan</option>
                            @foreach ($tegangans as $tegangan)
                                <option value="{{ $tegangan->id }}">{{ $tegangan->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Trafo -->
                    <div class="mb-3">
                        <label class="block text-sm font-normal">Trafo</label>
                        <select wire:model="newBayTrafoId" class="w-full p-1 border rounded-md text-sm">
                            <option value="">Select Trafo</option>
                            @foreach ($trafos as $trafo)
                                <option value="{{ $trafo->id }}">{{ $trafo->name_plate }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nomor Series -->
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Nomor Series</label>
                        <input type="text" wire:model="newBayNomorSeries"
                            class="w-full p-1 border rounded-md text-sm">
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Keterangan</label>
                        <textarea wire:model="newBayKeterangan" class="w-full p-1 border rounded-md text-sm"></textarea>
                    </div>

                    <!-- Submit and Cancel -->
                    <div class="flex justify-end mt-3">
                        <button type="submit"
                            class="px-2 py-1 bg-[#101041] text-white text-sm rounded-md hover:bg-opacity-90 transition">
                            Update
                        </button>
                        <button type="button" wire:click="hideEditModal"
                            class="ml-2 px-2 py-1 bg-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-400 transition">
                            Cancel
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="fixed inset-0 flex items-center justify-center z-50 {{ $isDeleteModalOpen ? '' : 'hidden' }}">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="p-4">
                <h3 class="text-lg font-medium">Confirm Deletion</h3>
                <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete this bay?</p>
                <div class="mt-4 flex justify-end">
                    <button wire:click="deleteItem"
                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 transition">
                        Delete
                    </button>
                    <button wire:click="hideDeleteModal"
                        class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-400 transition">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
