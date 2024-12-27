<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @php
            $labels = [
                [
                    'h3' => 'Users',
                    'h2' => $totalUsers,
                    'p' => 'Total Users',
                    'span' => $totalUsersPercentage,
                    'bg' => 'bg-[#e9e3ff]',
                ],
                [
                    'h3' => 'Devices',
                    'h2' => $devices,
                    'p' => 'Total Devices',
                    'span' => $devicesPercentage,
                    'bg' => 'bg-[#ffdede]',
                ],
                [
                    'h3' => 'Locations',
                    'h2' => $locations,
                    'p' => 'Total Places',
                    'span' => $locationsPercentage,
                    'bg' => 'bg-[#cef5de]',
                ],
                [
                    'h3' => 'Alarm Log',
                    'h2' => $alarms,
                    'p' => 'A day ago',
                    'span' => $alarmsPercentage,
                    'bg' => 'bg-[#ffefcc]',
                ],
            ];
        @endphp
        @foreach ($labels as $item)
            <div
                class="bg-white rounded-lg p-5 shadow-md w-full flex flex-row items-center justify-between gap-4 ease-out duration-100 hover:-translate-y-1 hover:shadow-lg">
                <div class="flex flex-col items-start gap-3">
                    <h3 class="text-lg m-0 text-[#7A7A7A]">{{ $item['h3'] }}</h3>
                    <h2 class="text-2xl m-0 text-secondary">{{ $item['h2'] }} <span
                            class="text-green-500 text-sm ml-1">({{ $item['span'] }})</span></h2>
                    <p class="text-sm m-0 text-[#7A7A7A]">{{ $item['p'] }}</p>
                </div>
                <div class="w-14 h-14 rounded-lg flex justify-center items-center shrink-0 {{ $item['bg'] }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-7 stroke-secondary">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
            </div>
        @endforeach
    </div>

    <div class="relative my-5">
        <div class="flex items-center sm:justify-center">
            <table class="w-full border-collapse bg-white rounded-3xl shadow-lg mb-5">
                <thead class="sr-only md:not-sr-only">
                    <tr class="title-row">
                        <th colspan="16" id="title" class="text-lg p-5 text-center bg-[#fffdc3] rounded-t-3xl">
                            <div class="flex justify-between items-center mt-3 relative">
                                <div>
                                    <h3 class="text-2xl text-secondary m-0">
                                        Trans JBT
                                    </h3>
                                </div>
                                <div class="absolute right-0 -top-[10px]">
                                    <!-- Add Dropdown -->
                                    <button class="add-button text-white px-4 py-2 rounded-md"
                                        onclick="toggleAddDropdown()">
                                        Add Bay
                                    </button>
                                    <div id="addDropdown"
                                        class="hidden dropdown-content absolute right-0 mt-2 bg-white shadow-lg rounded-md">
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
                                            class="fixed top-0 right-0 w-1/3 h-full bg-white shadow-lg z-50 transform transition-transform duration-300 ease-in-out {{ $isAddModalOpen ? 'translate-x-0' : 'translate-x-full' }}">
                                            <div class="p-6 text-sm h-full overflow-y-auto">
                                                <!-- Header -->
                                                <div class="flex justify-between items-center mb-6">
                                                    <h3 class="text-xl font-semibold">Add New Bay</h3>
                                                    <button wire:click="hideAddModal"
                                                        class="text-gray-600 hover:text-gray-800 text-2xl">✕</button>
                                                </div>

                                                <!-- Form -->
                                                <form wire:submit.prevent="addNewItem">
                                                    <div class="grid grid-cols-1 gap-4">

                                                        <!-- Unit Induk -->
                                                        <div>
                                                            <label for="unitInduk"
                                                                class="block text-sm font-medium mb-1">Unit
                                                                Induk</label>
                                                            <select id="unitInduk" wire:model="selectedUnitInduk"
                                                                class="form-control w-full p-2 border rounded-md">
                                                                <option value="">Select Unit Induk</option>
                                                                @foreach ($unitInduks as $unitInduk)
                                                                    <option value="{{ $unitInduk->id }}">
                                                                        {{ $unitInduk->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- APP -->
                                                        <div>
                                                            <label for="app"
                                                                class="block text-sm font-medium mb-1">APP</label>
                                                            <select id="app" wire:model="selectedApp"
                                                                class="form-control w-full p-2 border rounded-md">
                                                                <option value="">Select APP</option>
                                                                @foreach ($apps as $app)
                                                                    <option value="{{ $app->id }}">
                                                                        {{ $app->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Basecamp -->
                                                        <div>
                                                            <label for="basecamp"
                                                                class="block text-sm font-medium mb-1">Basecamp</label>
                                                            <select id="basecamp" wire:model="selectedBasecamp"
                                                                class="form-control w-full p-2 border rounded-md">
                                                                <option value="">Select Basecamp</option>
                                                                @foreach ($basecamps as $basecamp)
                                                                    <option value="{{ $basecamp->id }}">
                                                                        {{ $basecamp->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Gardu Induk -->
                                                        <div>
                                                            <label for="garduInduk"
                                                                class="block text-sm font-medium mb-1">Gardu
                                                                Induk</label>
                                                            <select id="garduInduk" wire:model="selectedGarduInduk"
                                                                class="form-control w-full p-2 border rounded-md">
                                                                <option value="">Select Gardu Induk</option>
                                                                @foreach ($garduInduks as $garduInduk)
                                                                    <option value="{{ $garduInduk->id }}">
                                                                        {{ $garduInduk->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Bay Name -->
                                                        <div>
                                                            <label class="block text-sm font-medium mb-1">Bay
                                                                Name</label>
                                                            <input type="text" wire:model="newBayName"
                                                                class="w-full p-2 border rounded-md">
                                                        </div>

                                                        <!-- Status -->
                                                        <div>
                                                            <label class="block text-sm font-medium mb-1">Status</label>
                                                            <input type="text" wire:model="newBayStatus"
                                                                class="w-full p-2 border rounded-md">
                                                        </div>

                                                        <!-- Tanggal Operasi -->
                                                        <div>
                                                            <label class="block text-sm font-medium mb-1">Tanggal
                                                                Operasi</label>
                                                            <input type="date" wire:model="newBayTanggalOperasi"
                                                                class="w-full p-2 border rounded-md">
                                                        </div>

                                                        <!-- Tegangan -->
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium mb-1">Tegangan</label>
                                                            <select wire:model="newBayTeganganId"
                                                                class="w-full p-2 border rounded-md">
                                                                <option value="">Select Tegangan</option>
                                                                @foreach ($tegangans as $tegangan)
                                                                    <option value="{{ $tegangan->id }}">
                                                                        {{ $tegangan->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Trafo -->
                                                        <div>
                                                            <label class="block text-sm font-medium mb-1">Trafo</label>
                                                            <select wire:model="newBayTrafoId"
                                                                class="w-full p-2 border rounded-md">
                                                                <option value="">Select Trafo</option>
                                                                @foreach ($trafos as $trafo)
                                                                    <option value="{{ $trafo->id }}">
                                                                        {{ $trafo->name_plate }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Nomor Series -->
                                                        <div>
                                                            <label class="block text-sm font-medium mb-1">Nomor
                                                                Series</label>
                                                            <input type="text" wire:model="newBayNomorSeries"
                                                                class="w-full p-2 border rounded-md">
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium mb-1">Keterangan</label>
                                                            <textarea wire:model="newBayKeterangan" class="w-full p-2 border rounded-md"></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- Submit and Cancel -->
                                                    <div class="flex justify-end mt-6">
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-[#101041] text-white text-sm rounded-md hover:bg-opacity-90 transition">
                                                            Submit
                                                        </button>
                                                        <button type="button" wire:click="hideAddModal"
                                                            class="ml-3 px-4 py-2 bg-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-400 transition">
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
                        <th class="text-lg p-5 text-center bg-[#fffdc3]">No</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Bay</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Gardu Induk</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Basecamp</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">App</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Unit Induk</th>
                        <th class="text-lg p-5 text-center bg-[#fffdc3]">Action</th>
                        <!-- Tambahkan ini -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bays as $bay)
                        <tr class="tr-class">
                            <td class="td-class text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="td-class">{{ $bay->name }}</td>
                            <td class="td-class">{{ $bay->gardu_induks->name ?? '-' }}</td>
                            <td class="td-class">{{ $bay->gardu_induks->basecamps->name ?? '-' }}</td>
                            <td class="td-class">{{ $bay->gardu_induks->basecamps->apps->name ?? '-' }}</td>
                            <td class="td-class">{{ $bay->gardu_induks->basecamps->apps->unitInduk->name ?? '-' }}
                            </td>
                            <td class="td-class sr-only md:not-sr-only">
                                <div class="flex justify-center gap-3">
                                    <!-- Tombol Edit -->
                                    <button wire:click="showEditModal({{ $bay->id }})" class="btn-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="stroke-[#007bff] transition ease-out hover:stroke-[#0056b3]">
                                            <path d="M16 3.13a4 4 0 0 1 5 5L6.37 22.5a4 4 0 0 1-5-5z"></path>
                                            <line x1="16" y1="3" x2="22" y2="9">
                                            </line>
                                        </svg>
                                    </button>

                                    <!-- Tombol Delete -->
                                    <button wire:click="confirmDelete({{ $bay->id }})" class="btn-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="stroke-[#ff4f4f] transition ease-out hover:stroke-[#d32f2f]">
                                            <path d="M3 6h18"></path>
                                            <path d="M6 6v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6"></path>
                                            <path d="M9 10v6"></path>
                                            <path d="M15 10v6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Offcanvas -->
    <div class="relative">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-25 z-40 transition-opacity duration-300 {{ $isEditModalOpen ? 'opacity-100 visible' : 'opacity-0 invisible' }}"
            wire:click="hideEditModal">
        </div>

        <!-- Offcanvas Modal -->
        <div
            class="fixed top-0 right-0 w-1/3 h-full bg-white shadow-lg z-50 transform transition-transform duration-300 ease-in-out {{ $isEditModalOpen ? 'translate-x-0' : 'translate-x-full' }}">
            <div class="p-6 text-sm h-full overflow-y-auto">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold">Edit Bay</h3>
                    <button wire:click="hideEditModal" class="text-gray-600 hover:text-gray-800 text-2xl">✕</button>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="updateItem">
                    <div class="grid grid-cols-1 gap-4">

                        <!-- Unit Induk -->
                        <div>
                            <label for="unitIndukEdit" class="block text-sm font-medium mb-1">Unit Induk</label>
                            <select id="unitIndukEdit" wire:model="selectedUnitInduk" wire:change="$refresh"
                                class="form-control w-full p-2 border rounded-md">
                                <option value="">Select Unit Induk</option>
                                @foreach ($unitInduks as $unitInduk)
                                    <option value="{{ $unitInduk->id }}">{{ $unitInduk->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- APP -->
                        <div>
                            <label for="appEdit" class="block text-sm font-medium mb-1">APP</label>
                            <select id="appEdit" wire:model="selectedApp" wire:change="$refresh"
                                class="form-control w-full p-2 border rounded-md"
                                {{ !$selectedUnitInduk ? 'disabled' : '' }}>
                                <option value="">Select APP</option>
                                @foreach ($apps as $app)
                                    <option value="{{ $app->id }}">{{ $app->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Basecamp -->
                        <div>
                            <label for="basecampEdit" class="block text-sm font-medium mb-1">Basecamp</label>
                            <select id="basecampEdit" wire:model="selectedBasecamp" wire:change="$refresh"
                                class="form-control w-full p-2 border rounded-md"
                                {{ !$selectedApp ? 'disabled' : '' }}>
                                <option value="">Select Basecamp</option>
                                @foreach ($basecamps as $basecamp)
                                    <option value="{{ $basecamp->id }}">{{ $basecamp->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Gardu Induk -->
                        <div>
                            <label for="garduIndukEdit" class="block text-sm font-medium mb-1">Gardu Induk</label>
                            <select id="garduIndukEdit" wire:model="selectedGarduInduk" wire:change="$refresh"
                                class="form-control w-full p-2 border rounded-md"
                                {{ !$selectedBasecamp ? 'disabled' : '' }}>
                                <option value="">Select Gardu Induk</option>
                                @foreach ($garduInduks as $garduInduk)
                                    <option value="{{ $garduInduk->id }}">{{ $garduInduk->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bay Name -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Bay Name</label>
                            <input type="text" wire:model="newBayName" class="w-full p-2 border rounded-md">
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Status</label>
                            <input type="text" wire:model="newBayStatus" class="w-full p-2 border rounded-md">
                        </div>

                        <!-- Tanggal Operasi -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Tanggal Operasi</label>
                            <input type="date" wire:model="newBayTanggalOperasi"
                                class="w-full p-2 border rounded-md">
                        </div>

                        <!-- Tegangan -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Tegangan</label>
                            <select wire:model="newBayTeganganId" class="w-full p-2 border rounded-md">
                                <option value="">Select Tegangan</option>
                                @foreach ($tegangans as $tegangan)
                                    <option value="{{ $tegangan->id }}">{{ $tegangan->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Trafo -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Trafo</label>
                            <select wire:model="newBayTrafoId" class="w-full p-2 border rounded-md">
                                <option value="">Select Trafo</option>
                                @foreach ($trafos as $trafo)
                                    <option value="{{ $trafo->id }}">{{ $trafo->name_plate }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nomor Series -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Nomor Series</label>
                            <input type="text" wire:model="newBayNomorSeries"
                                class="w-full p-2 border rounded-md">
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Keterangan</label>
                            <textarea wire:model="newBayKeterangan" class="w-full p-2 border rounded-md"></textarea>
                        </div>
                    </div>

                    <!-- Submit and Cancel -->
                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="px-4 py-2 bg-[#101041] text-white text-sm rounded-md hover:bg-opacity-90 transition">
                            Update
                        </button>
                        <button type="button" wire:click="hideEditModal"
                            class="ml-3 px-4 py-2 bg-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-400 transition">
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
