<div id="logoutModal" class="modal-content w-full h-screen bg-black/50 overflow-hidden fixed top-0 z-50 hidden justify-center items-center p-4">
    <div class="max-w-md w-full">
        <div class="relative bg-white px-6 pb-8 pt-10 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:rounded-lg sm:px-10 space-y-4">
            <div class="flex gap-4 items-center">
                <img src="{{ 'storage/' . Auth::user()->image }}" alt="User Image" class="w-1/4 h-1/4 rounded-lg">
                <h5 class="text-lg font-semibold mt-2">{{ Auth::user()->name }}</h5>
            </div>
            <p class="text-center md:text-left text-sm md:text-base">Are you sure you want to log out?</p>
            <div class="flex justify-end gap-4">
                <button id="confirmLogout" class="py-2 px-4 text-white rounded-lg bg-secondary">Yes</button>
                <button id="cancelLogout" class="py-2 px-4 text-white rounded-lg bg-red-500">No</button>
            </div>
        </div>
    </div>
</div>
