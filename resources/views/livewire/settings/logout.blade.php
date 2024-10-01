<div id="logoutModal" class="logout-container hidden">
    <div class="modal-content">
        <div class="flex flex-column items-center">
            <img src="{{ asset('images/user.png') }}" alt="User Image" class="profile-img rounded-circle">
            <h5 class="text-lg font-semibold mt-2">{{ Auth::user()->name }}</h5>
        </div>
        <p class="text-center">Are you sure you want to log out?</p>
        <div class="flex justify-between">
            <button id="cancelLogout" class="btn btn-danger">No</button>
            <button id="confirmLogout" class="btn btn-secondary">Yes</button>
        </div>
    </div>
</div>
