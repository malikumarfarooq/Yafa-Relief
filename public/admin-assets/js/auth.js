function togglePassword(fieldId, icon) {
    const passwordField = document.getElementById(fieldId);
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('lni-eye');
        icon.classList.add('lni-emoji-expressionless-flat-eyes');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('lni-emoji-expressionless-flat-eyes');
        icon.classList.add('lni-eye');
    }
}

document.querySelectorAll('.custom-checkbox-card').forEach(card => {
    card.addEventListener('click', (e) => {
        // Prevent double toggle if clicking directly on the input
        if (e.target.tagName !== 'INPUT') {
            const input = card.querySelector('input[type="radio"]');
            input.checked = true;
        }
    });
});