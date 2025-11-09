document.addEventListener("DOMContentLoaded", function () {
    // Entire code is for Email Validation
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    let emailInput = document.getElementById('emailInput');
    let errorField = document.getElementById('errorField');
    let submitButton = document.getElementById('submitBtn');
    // Handling the events
    emailInput.addEventListener("input", function () {
        validateEmail();
    });
    function validateEmail() {
        if (emailRegex.test(emailInput.value)) {
            emailInput.classList.remove('border-danger');
            // emailInput.classList.add('border-success');
            errorField.classList.remove('text-secondary');
            errorField.classList.remove('text-danger');
            errorField.classList.add('text-success');
            submitButton.disabled = false;
            errorField.innerHTML = `<i class="bi bi-check"></i> Email Address is Valid`;
        } else {
            // emailInput.classList.remove('');
            emailInput.classList.add('border-danger');
            errorField.classList.remove('text-secondary');
            errorField.classList.add('text-danger');
            errorField.innerHTML = `<i class="bi bi-exclamation-circle-fill"></i> Invalid email format. Please try again.`;
        }
    }
});
