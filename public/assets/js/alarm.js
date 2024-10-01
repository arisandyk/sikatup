document.addEventListener('DOMContentLoaded', function() {
    const exportButton = document.querySelector('.export-button');
    const dropdownContent = document.querySelector('.dropdown-content');

    // Toggle dropdown saat tombol Export diklik
    exportButton.addEventListener('click', function(event) {
        event.stopPropagation();
        dropdownContent.classList.toggle('show');
    });

    // Tutup dropdown saat klik di luar elemen
    document.addEventListener('click', function(event) {
        if (!exportButton.contains(event.target) && !dropdownContent.contains(event.target)) {
            dropdownContent.classList.remove('show');
        }
    });
});
