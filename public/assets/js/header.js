// Select the notification icon and the dropdown menu
const notificationIcon = document.getElementById('notification-icon');
const notificationDropdown = document.querySelector('.notification-dropdown');

// Toggle the visibility of the dropdown on click
notificationIcon.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    notificationDropdown.classList.toggle('open');
});

// Close the dropdown if clicking outside of it
document.addEventListener('click', function(event) {
    if (!notificationIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
        notificationDropdown.classList.remove('open');
    }
});

// Set jumlah notifikasi
const notificationCount = document.querySelector('.notification-count');
const numberOfNotifications = 6; // Ganti dengan jumlah notifikasi yang sebenarnya
if (numberOfNotifications > 0) {
    notificationCount.textContent = numberOfNotifications;
} else {
    notificationCount.style.display = 'none'; // Sembunyikan jika tidak ada notifikasi
}
