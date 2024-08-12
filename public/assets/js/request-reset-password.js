<script>
    document.getElementById('emailToggle').addEventListener('click', function() {
        document.getElementById('inputLabel').textContent = 'Email Address';
        document.getElementById('contact_input').setAttribute('placeholder', 'admin@mail.com');
        document.getElementById('emailToggle').classList.add('active');
        document.getElementById('mobileToggle').classList.remove('active');
    });

    document.getElementById('mobileToggle').addEventListener('click', function() {
        document.getElementById('inputLabel').textContent = 'Mobile Number';
        document.getElementById('contact_input').setAttribute('placeholder', '+62');
        document.getElementById('mobileToggle').classList.add('active');
        document.getElementById('emailToggle').classList.remove('active');
    });
</script>