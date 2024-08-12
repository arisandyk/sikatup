document.getElementById('select-all').addEventListener('change', function(e) {
    let checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
});