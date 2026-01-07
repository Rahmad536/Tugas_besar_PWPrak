document.getElementById('registrationForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const alertContainer = document.getElementById('alertContainer');

    let errors = [];

    if (!email.includes('@')) {
        errors.push('Email tidak valid');
    }

    if (username.length < 3) {
        errors.push('Username minimal 3 karakter');
    }

    if (password.length < 6) {
        errors.push('Password minimal 6 karakter');
    }

    if (errors.length > 0) {
        let html = '<div class="alert alert-danger"><ul class="alert-list">';
        errors.forEach(err => html += `<li>${err}</li>`);
        html += '</ul></div>';
        alertContainer.innerHTML = html;
    } else {
        alertContainer.innerHTML =
            '<div class="alert alert-success">Registrasi berhasil! Silakan login.</div>';

        setTimeout(() => {
            this.reset();
            alertContainer.innerHTML = '';
        }, 2000);
    }

    alertContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
});
