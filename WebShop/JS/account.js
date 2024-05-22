function validateEmail(email) {
    let re = /\S+@\S+\.\S+/;
    return re.test(email);
}

// Function to validate an email address
document.getElementById('email').addEventListener('input', function() {
    let email = this.value;
    let validationElement = document.getElementById('emailValidation');

    if (validateEmail(email)) {
        // If the email is valid, display a green checkmark
        validationElement.style.color = 'green';
        validationElement.textContent = '✓';
        this.style.backgroundColor = '';
    } else {
        // If the email is not valid, display a red cross
        validationElement.style.color = 'red';
        validationElement.textContent = '✗';
        this.style.backgroundColor = 'rgb(253,178,169)';
        this.style.border = '1px solid rgb(240, 130, 122)';
    }
});