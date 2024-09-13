document.getElementById('select-all').addEventListener('change', function(e) {
    let checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
});

function handleDelete(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        // Mengirim permintaan delete menggunakan Livewire
        Livewire.emit('deleteUser', userId);
    }
}

function handleView(userId) {
    // Mengarahkan ke halaman detail pengguna
    window.location.href = `/users/${userId}`;
}

function handleEdit(userId) {
    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();

    // Pastikan event ini mengirim userId yang benar ke Livewire
    Livewire.emit('loadUserForEdit', userId);
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.edit-user-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var userId = this.dataset.userId;
            Livewire.emit('loadUserForEdit', userId);
        });
    });
});


document.getElementById('editUserForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const userId = document.getElementById('userId').value; // Pastikan userId sudah ada dalam form
    const formData = new FormData(this);

    fetch(`/users/${userId}/update`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Menangani kesuksesan (misalnya, memperbarui tabel, menampilkan pesan sukses)
            alert('User updated successfully.');
            window.location.reload(); // Atau perbarui tabel secara langsung
        } else {
            // Menangani kesalahan
            alert('Failed to update user.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

console.log(document.getElementById('select-all')); // Harus tidak null
console.log(Livewire); // Harus terdefinisi


Livewire.on('copyUsers', function(event) {
    const users = event.users;
    const formattedUsers = users.map(user => `${user.name}\t${user.email}\t${user.role}`).join('\n');
    navigator.clipboard.writeText(formattedUsers).then(() => {
        alert('Users copied to clipboard.');
    });
});

Livewire.on('printUsers', function(event) {
    const users = event.users;
    let printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Print Users</title></head><body>');
    printWindow.document.write('<table border="1"><thead><tr><th>Name</th><th>Email</th><th>Role</th></tr></thead><tbody>');
    users.forEach(user => {
        printWindow.document.write(`<tr><td>${user.name}</td><td>${user.email}</td><td>${user.role}</td></tr>`);
    });
    printWindow.document.write('</tbody></table></body></html>');
    printWindow.document.close();
    printWindow.print();
});


document.addEventListener('livewire:load', function () {
    Livewire.on('print-data', event => {
        const newWindow = window.open('', '_blank');
        newWindow.document.write(event.content);
        newWindow.print();
    });
    
    Livewire.on('copy-to-clipboard', event => {
        const textArea = document.createElement("textarea");
        textArea.value = event.content;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("copy");
        document.body.removeChild(textArea);
        alert('Data copied to clipboard');
    });
});
