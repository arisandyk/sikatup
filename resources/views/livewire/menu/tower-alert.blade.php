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
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-lg p-5 text-center bg-[#fffdc3]">No</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Direktorat</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Unit Induk</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">App</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Nama Penghantar</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Nama Tower</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">No Tower</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Deskripsi</th>
                        <th rowspan="1" class="text-lg p-5 text-center bg-[#fffdc3]">Dimatikan oleh</th>
                        <!-- Tambahkan ini -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($towerAlerts as $item)
                        <tr>
                            <td class="td-class text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="td-class">{{ $item->tower->penghantar->apps->unitInduk->direktorat->name }}</td>
                            <td class="td-class">{{ $item->tower->penghantar->apps->unitInduk->name }}</td>
                            <td class="td-class">{{ $item->tower->penghantar->apps->name }}</td>
                            <td class="td-class">{{ $item->tower->penghantar->name }}</td>
                            <td class="td-class">{{ $item->tower->name }}</td>
                            <td class="td-class">{{ $item->tower->no }}</td>
                            <td class="td-class">{{ $item->description }}</td>
                            <td class="td-class">{{ $item->user?->name }}</td>
                            </td>
                            {{-- <td class="td-class sr-only md:not-sr-only">
                                <div class="flex justify-center gap-3">
                                    <!-- Tombol Edit -->
                                    <button wire:click="showEditModal({{ $tower->id }})" class="btn-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="stroke-[#007bff] transition ease-out hover:stroke-[#0056b3]">
                                            <path d="M16 3.13a4 4 0 0 1 5 5L6.37 22.5a4 4 0 0 1-5-5z"></path>
                                            <line x1="16" y1="3" x2="22" y2="9">
                                            </line>
                                        </svg>
                                    </button>

                                    <!-- Tombol Delete -->
                                    <button wire:click="confirmDelete({{ $tower->id }})" class="btn-action">
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
                            </td> --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $towerAlerts->links() }}
    </div>
</div>
