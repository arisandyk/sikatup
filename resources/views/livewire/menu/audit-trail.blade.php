<div class="mt-36 lg:mt-24 p-4 lg:ml-[280px]">
    @if (session()->has('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="relative my-5">
        <div class="w-full relative my-5 overflow-x-scroll lg:overflow-auto">
            <!-- Search and Per Page Selection -->
            <div class="flex justify-between items-center mb-5 flex-wrap gap-3">
                <input type="text" wire:model.debounce.300ms="search" wire:change="loadLogs" placeholder="Search..."
                    class="flex-grow p-3 rounded-lg border text-sm min-w-52">
                <select wire:model="perPage" wire:change="loadLogs"
                    class="p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                <select wire:model="day" wire:change="loadLogs"
                    class="p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer">
                    <option value="">Tanggal</option>
                    @for ($i = 1; $i <= 31; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <select wire:model="month" wire:change="loadLogs"
                    class="p-3 rounded-lg border text-sm bg-[#f9f9f9] cursor-pointer">
                    <option value="">Bulan</option>
                    @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $key => $item)
                        <option value="{{ $key + 1 }}">{{ $item }}</option>
                    @endforeach
                </select>
                <input type="number" wire:model.debounce.300ms="year" wire:change="loadLogs" placeholder="Tahun"
                    class="flex-grow p-3 rounded-lg border text-sm min-w-52">
            </div>

            <table class="w-full border-collapse bg-white rounded-3xl shadow-lg mb-5">
                <thead>
                    <tr>
                        <th class="text-lg p-5 text-center bg-[#fffdc3]">No</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Pengguna</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Action Type</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Tanggal dibuat</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Tangggal diupdate</th>
                        <th class="text-lg p-5 text-center bg-[#fffdc3]">Action</th>
                        <!-- Tambahkan ini -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td class="td-class text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="td-class">{{ $log->user->name ?? '-' }}</td>
                            <td class="td-class">{{ $log->action_type }}</td>
                            <td class="td-class">{{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y H:i') }}</td>
                            <td class="td-class">{{ \Carbon\Carbon::parse($log->updated_at)->format('d-m-Y H:i') }}
                            </td>
                            </td>
                            <td class="td-class sr-only md:not-sr-only">
                                <div class="flex justify-center gap-3">
                                    <!-- Tombol Edit -->
                                    <button wire:click="showDetail({{ $log->action_details }})" class="btn-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="stroke-[#007bff] transition ease-out hover:stroke-[#0056b3]">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>

                                    <!-- Tombol Delete -->
                                    <button wire:click="confirmDelete({{ $log->id }})" class="btn-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
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
            {{ $logs->links() }}
        </div>
    </div>

    <div id="detail"
        class="w-full h-screen bg-black/50 fixed top-0 z-[100] left-0 {{ $detail ? 'flex' : 'hidden' }} justify-center items-center p-4">
        <div class="max-w-none md:max-w-screen-md max-h-[80vh] overflow-y-scroll rounded-lg">
            <div
                class="relative h-fit md:h-[600px] lg:h-fit bg-[#FCFBE8] px-6 pb-8 pt-10 shadow-xl ring-1 ring-gray-900/5 mx-auto">
                <code>
                    <pre class="text-wrap">
                        {{ json_encode($actionDetails, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
                    </pre>
                </code>
                <button class="add-button w-full" wire:click="hideDetail">Close</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="fixed inset-0 items-center justify-center z-[1000] {{ $delete ? 'flex' : 'hidden' }}">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="p-4">
                <h3 class="text-lg font-medium">Confirm Deletion</h3>
                <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete this log?</p>
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
