<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    @if (session()->has('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative my-5 overflow-x-scroll">
        <div class="flex items-center sm:justify-center">
            <table class="w-full border-collapse bg-white rounded-3xl shadow-lg mb-5">
                <thead>
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
                                        wire:click="showAddModal">
                                        Tambah Penghantar
                                    </button>

                                    <!-- Offcanvas -->
                                    <div class="relative">
                                        <!-- Overlay -->
                                        <div class="fixed inset-0 bg-black bg-opacity-25 z-40 transition-opacity duration-300 {{ $isAddModalOpen ? 'opacity-100 visible' : 'opacity-0 invisible' }}"
                                            wire:click="hideAddModal">
                                        </div>

                                        <!-- Offcanvas Modal -->
                                        <div
                                            class="fixed top-0 right-0 w-full md:w-1/3 h-full bg-white shadow-lg z-50 transform transition-transform duration-300 ease-in-out {{ $isAddModalOpen ? 'translate-x-0' : 'translate-x-full' }}">
                                            <div class="p-6 text-sm h-full overflow-y-auto">
                                                <!-- Header -->
                                                <div class="flex justify-between items-center mb-6">
                                                    <h3 class="text-xl font-semibold">Tambah Penghantar Baru</h3>
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
                                                                wire:change="$refresh"
                                                                class="form-control w-full p-2 border rounded-md">
                                                                <option value="">Select Unit Induk</option>
                                                                @foreach ($unitInduks as $unitInduk)
                                                                    <option value="{{ $unitInduk->id }}">
                                                                        {{ $unitInduk->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="error">
                                                                @error('selectedUnitInduk')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- APP -->
                                                        <div>
                                                            <label for="app"
                                                                class="block text-sm font-medium mb-1">APP</label>
                                                            <select id="app" wire:model="newApp"
                                                                class="form-control w-full p-2 border rounded-md">
                                                                <option value="">Select APP</option>
                                                                @foreach ($apps as $app)
                                                                    <option value="{{ $app->id }}">
                                                                        {{ $app->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="error">
                                                                @error('newApp')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Nama Penghantar -->
                                                         <div>
                                                            <label class="block text-sm font-medium mb-1">Nama Penghantar</label>
                                                            <input type="text" wire:model="newNamaPenghantar"
                                                                class="w-full p-2 border rounded-md">
                                                            <div class="error">
                                                                @error('newNamaPenghantar')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
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
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Unit Induk</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">App</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Nama Penghantar</th>
                        <th class="text-lg p-5 text-center bg-[#fffdc3]">Action</th>
                        <!-- Tambahkan ini -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penghantars as $penghantar)
                        <tr>
                            <td class="td-class text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="td-class">{{ $penghantar->unitInduk->name }}</td>
                            <td class="td-class">{{ $penghantar->apps->name }}</td>
                            <td class="td-class">{{ $penghantar->name }}</td>
                            </td>
                            <td class="td-class">
                                <div class="flex justify-center gap-3">
                                    <!-- Tombol Edit -->
                                    <button wire:click="showEditModal({{ $penghantar->id }})" class="btn-action">
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
                                    <button wire:click="confirmDelete({{ $penghantar->id }})" class="btn-action">
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
        {{ $penghantars->links() }}
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
                    <h3 class="text-xl font-semibold">Edit Penghantar</h3>
                    <button wire:click="hideEditModal" class="text-gray-600 hover:text-gray-800 text-2xl">✕</button>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="updateItem">
                    <div class="grid grid-cols-1 gap-4">

                        <!-- Unit Induk -->
                        <div>
                            <label for="unitInduk"
                                class="block text-sm font-medium mb-1">Unit
                                Induk</label>
                            <select id="unitInduk" wire:model="selectedUnitInduk"
                                wire:change="$refresh"
                                class="form-control w-full p-2 border rounded-md">
                                <option value="">Select Unit Induk</option>
                                @foreach ($unitInduks as $unitInduk)
                                    <option value="{{ $unitInduk->id }}">
                                        {{ $unitInduk->name }}</option>
                                @endforeach
                            </select>
                            <div class="error">
                                @error('selectedUnitInduk')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <!-- APP -->
                        <div>
                            <label for="app"
                                class="block text-sm font-medium mb-1">APP</label>
                            <select id="app" wire:model="newApp"
                                class="form-control w-full p-2 border rounded-md">
                                <option value="">Select APP</option>
                                @foreach ($apps as $app)
                                    <option value="{{ $app->id }}">
                                        {{ $app->name }}</option>
                                @endforeach
                            </select>
                            <div class="error">
                                @error('newApp')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <!-- Nama Penghantar -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Penghantar</label>
                            <input type="text" wire:model="newNamaPenghantar" class="w-full p-2 border rounded-md">
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
    <div class="fixed inset-0 flex items-center justify-center z-[100] {{ $isDeleteModalOpen ? '' : 'hidden' }}">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="p-4">
                <h3 class="text-lg font-medium">Confirm Deletion</h3>
                <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete this data?</p>
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
