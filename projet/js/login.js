function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var toggleIcon = document.getElementById('toggle-password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.textContent = '🙈'; // Change icon or text accordingly
    } else {
        passwordInput.type = 'password';
        toggleIcon.textContent = '👁️'; // Change icon or text accordingly
    }
}
