function validateEmail(email) {
    let re = /\S+@\S+\.\S+/;
    return re.test(email);
}

// Get the register button
let registerButton = document.getElementById('registerButton');
let loginButton = document.getElementById('loginButton');

// Function to validate an email address
document.getElementById('email').addEventListener('input', function() {
    let email = this.value;
    let validationElement = document.getElementById('emailValidation');

    if (validateEmail(email)) {
        // If the email is valid, display a green checkmark and enable the register button
        validationElement.style.color = 'green';
        validationElement.textContent = '✓';
        this.style.backgroundColor = '';
        registerButton.disabled = false;
        loginButton.disabled = false;
    } else {
        // If the email is not valid, display a red cross and disable the register button
        validationElement.style.color = 'red';
        validationElement.textContent = '✗';
        this.style.backgroundColor = 'rgb(253,178,169)';
        this.style.border = '1px solid rgb(240, 130, 122)';
        registerButton.disabled = true;
        loginButton.disabled = true;
    }
});

// to be finished
/*
registerButton.addEventListener('click', function() {
    let email = document.getElementById('email').value;

    if (validateEmail(email)) {
        // If the email is valid, make an AJAX call to mail.php
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../php/mail.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`email=${email}`);
    }
}*/