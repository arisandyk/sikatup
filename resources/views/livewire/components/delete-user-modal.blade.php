<div>
    <div id="deleteModal" class="modal-container {{ $showModal ? '' : 'hidden' }}">
        <div class="modal-content">
            <div class="flex flex-column items-center">
                <img src="{{ $userToDelete->avatar ?? asset('images/user.png') }}" alt="User Image" class="profile-img">
                <h5 class="text-lg font-semibold mt-2">{{ $userToDelete->name ?? '' }}</h5>
            </div>
            <p class="text-center mt-4">Are you sure you want to delete this user?</p>
            <div class="actions">
                <button wire:click="closeModal" class="btn btn-danger">No</button>
                <button wire:click="deleteUser" class="btn btn-secondary">Yes</button>
            </div>
        </div>
    </div>
</div>