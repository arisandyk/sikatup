document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.querySelector('.toggle-btn');
    const sidebar = document.querySelector('.sidebar');
    const logoutLink = document.getElementById('logoutLink');
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogoutButton = document.getElementById('cancelLogout');
    const confirmLogoutButton = document.getElementById('confirmLogout');
    const modalContent = document.querySelector('.modal-content');

    // Sidebar toggle functionality
    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
    });

    // Pastikan modal tersembunyi ketika halaman dimuat
    logoutModal.classList.add('hidden');

    // Logout link click handler
    logoutLink.addEventListener('click', function (e) {
        e.preventDefault();
        logoutModal.classList.remove('hidden'); // Tampilkan modal
    });

    // Cancel logout button handler
    cancelLogoutButton.addEventListener('click', function () {
        logoutModal.classList.add('hidden'); // Sembunyikan modal
    });

    // Confirm logout button handler
    confirmLogoutButton.addEventListener('click', function () {
        window.location.href = "logout"; // Redirect to logout route
    });

    logoutModal.addEventListener('click', function (e) {
        if (!modalContent.contains(e.target)) {
            logoutModal.classList.add('hidden'); // Sembunyikan modal jika klik di luar modal
        }
    });
});
